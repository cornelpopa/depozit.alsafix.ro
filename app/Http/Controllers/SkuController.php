<?php

namespace App\Http\Controllers;

use App\Dispatch;
use App\DispatchElement;
use App\Interest;
use App\Inventory;
use App\ReceptionElement;
use App\SaleUnit;
use App\sku;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SkuController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {

        $filters['sku'] = request()->has('sku') ? request('sku') : "";
        $filters['productName'] = request()->has('productName') ? request('productName') : "";
        $filters['ean'] = request()->has('ean') ? request('ean') : "";

        $query = Sku::query();
        $query->with([
            'interest',
            'sale_unit'
        ]);
        $query->where('id', '>', 0);
        foreach ($filters as $key => $value) {
            if ($key != 'page') {
                $query->where($key, 'LIKE', '%'.$value.'%');
            }
        }
        $filters['interest'] = request()->has('interest') ? request('interest') : 0;
        if ($filters['interest'] > 0) {
            $query->where('interest_id', $filters['interest']);
        }

        $skus = $query->paginate(15);

        return view('skus.index')->with([
            'skus'    => $skus,
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $sku = new Sku();

        return view('skus.create')->with(['sku' => $sku]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'sku'         => 'required|unique:skus|min:3',
            'productName' => 'required|min:3',
            'ean'         => 'sometimes|required',
            'unit'        => 'required|numeric',
            'interest_id' => 'required'
        ]);

        $sku = Sku::create($attributes);

        return redirect(route('skus.show', $sku->id));

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|Response|View
     */
    public function show($id)
    {

        $sku = Sku::withTrashed()
                  ->find($id);

        $inventoryQuantity = 0;

        if ($sku->lastInventory_id > 0) {
            $referenceInventory = Inventory::find($sku->lastInventory_id);
            $inventoryQuantity = $referenceInventory->elements()
                                                    ->where('sku_id', $sku->id)
                                                    ->first()->realStock;
        } else {
            $referenceInventory = Inventory::oldest('inventoryDate')
                                           ->first();
        }

        $inMovements = ReceptionElement::where('sku', 'LIKE', $sku->sku)
                                       ->where('created_at', ">=",
                                           (isset($referenceInventory) ? $referenceInventory->inventoryDate->format("Y-m-d 00:00:00") : "2019-01-01 00:00:00"))
                                       ->get();

        $stock = $inventoryQuantity;
        foreach ($inMovements as $movement) {
            $stock += $movement->qty * $movement->unit;
        }

        $outMovements = DispatchElement::where('sku', 'LIKE', $sku->sku)
                                       ->where('created_at', ">=",
                                           (isset($referenceInventory) ? $referenceInventory->inventoryDate->format("Y-m-d 00:00:00") : "2019-01-01 00:-0:00"))
                                       ->with('dispatch')
                                       ->get();

        foreach ($outMovements as $movement) {
            $stock -= $movement->qty * $movement->unit;
        }

        $cInMovements = collect($inMovements);
        $allMovements = $cInMovements->merge($outMovements);

        return view('skus.show')->with([
            'sku'                => $sku,
            'referenceInventory' => $referenceInventory,
            'inventoryQuantity'  => $inventoryQuantity,
            'inMovements'        => $inMovements,
            'outMovements'       => $outMovements,
            'allMovements'       => $allMovements,
            'stock'              => $stock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|Response|View
     */
    public function edit($id)
    {
        $sku = Sku::find($id);

        return view('skus.edit')->with(['sku' => $sku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {

        $attributes = $request->validate([
            'sku'         => 'required|min:3',
            'productName' => 'required|min:3',
            'ean'         => 'sometimes|required',
            'unit'        => 'required|numeric',
            'interest_id' => 'required'
        ]);


        $sku = Sku::find($id);
        $sku->update($attributes);

        return redirect(route('skus.show', $id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $sku = Sku::withTrashed()
                  ->find($id);

        if ($sku->trashed()) {
            $sku->restore();
        } else {
            $sku->delete();
        }

        return redirect(route('skus.index'));
    }


    public function withDeleted()
    {
        $filters['sku'] = request()->has('sku') ? request('sku') : "";
        $filters['productName'] = request()->has('productName') ? request('productName') : "";
        $filters['ean'] = request()->has('ean') ? request('ean') : "";

        $skus = Sku::onlyTrashed()
                   ->paginate(15);

        return view('skus.withDeleted')->with([
            'skus'    => $skus,
            'filters' => $filters
        ]);
    }


    /**
     * Show the form for editing the exceptional movement for SKU.
     *
     * @param  sku  $sku
     * @return Application|Factory|View
     */
    public function exceptional(Sku $sku)
    {
        return view('skus.exceptional')->with([
            'sku' => $sku
        ]);
    }

    /**
     * Saves the exceptional movement for SKU.
     *
     * @param  sku  $sku
     * @return string
     */
    public function saveExceptional(Request $request, Sku $sku)
    {

        $attributes = $request->validate([
            'note' => 'required',
            'unit' => 'required|numeric',
            'qty'  => 'required|numeric',
        ]);

        $dispatch = new Dispatch();
        $dispatch->user_id = auth()->user()->id;
        $dispatch->name = Dispatch::where('name', '>', '9020000000')
                                  ->max('name') + 1;
        if ($dispatch->name == '1') {
            $dispatch->name = "90".date('y')."000001";
        }
        $dispatch->dispatchDate = date("Y-m-d");
        $dispatch->gescomCodeClient = auth()->user()->id;
        $dispatch->gescomClientName = auth()->user()->name.': '.$attributes['note'];
        $dispatch->gescomCity = "Brasov";
        $dispatch->agent_id = auth()->user()->id;
        $dispatch->gescomReferenceOrder = "Internal";

        $dispatchElement = new DispatchElement();
        $dispatchElement->sku = $sku->sku;
        $dispatchElement->ean = $sku->ean;
        $dispatchElement->unit = $attributes['unit'];
        $dispatchElement->productName = $sku->productName;
        $dispatchElement->qty = -($attributes['qty']);
        $dispatchElement->qtyOrdered = -($attributes['unit'] * $attributes['qty']);
        $dispatchElement->qtyDelivered = -($attributes['unit'] * $attributes['qty']);
        $dispatchElement->qtyRemaining = 0;

        $dispatch->save();
        $dispatch->elements()
                 ->save($dispatchElement);

        return redirect(route('skus.show', $sku));
    }

    public function importSkuCat()
    {
        return view('skus.importSkuCat');
    }

    public function processSkuCat(Request $request)
    {
        $initial = ini_get("auto_detect_line_endings");
        ini_set("auto_detect_line_endings", true);

        $request->validate([
            'csv_file' => 'required|file'
        ]);

        $path = $request->file('csv_file')
                        ->getRealPath();

        $rows = array_map(function ($v) {
            return str_getcsv($v, ",");
        }, file($path));

        array_shift($rows);

        $total = count($rows);
        $processed = [];
        $skipped = [];

        foreach ($rows as $row) {
            $sku = Sku::findBySku($row[1]);
            if ($sku->id > 0) {
                $sku->interest_id = $row[0];
                $sku->save();
                $processed[] = $sku;
            } else {
                $skipped[] = $row[1];
            }

        }

        ini_set("auto_detect_line_endings", $initial);

        return view('skus.processResult')->with([
            'processed' => $processed,
            'skipped'   => $skipped,
            'total'     => $total,
            'interests' => Interest::all(),
        ]);
    }

    public function importSkuUM()
    {
        return view('skus.importSkuUM');
    }

    public function processSkuUM(Request $request)
    {
        $initial = ini_get("auto_detect_line_endings");
        ini_set("auto_detect_line_endings", true);

        $request->validate([
            'csv_file' => 'required|file'
        ]);

        $path = $request->file('csv_file')
                        ->getRealPath();

        $rows = array_map(function ($v) {
            return str_getcsv($v, ",");
        }, file($path));

        array_shift($rows);

        $total = count($rows);
        $processed = [];
        $skipped = [];

        $saleUnits = SaleUnit::all();

        foreach ($rows as $row) {
            $sku = Sku::findBySku($row[1]);
            if ($sku->id > 0) {
                $saleUnit = $saleUnits->where('name', 'LIKE', $row[0])
                                      ->first();
                $sku->sale_unit_id = $saleUnit->id;
                $sku->save();
                $processed[] = $sku;
            } else {
                $skipped[] = $row[1];
            }

        }

        ini_set("auto_detect_line_endings", $initial);

        return view('skus.processResultUM')->with([
            'processed'  => $processed,
            'skipped'    => $skipped,
            'total'      => $total,
            'sale_units' => SaleUnit::all(),
        ]);
    }

    public function slowMoving()
    {

        $months = (request()->has('months') ? request('months') : 6);
        $interest_id = (request()->has('interest_id') ? request('interest_id') : 1);

        $reference = now()->subMonths($months);

        if ($interest_id > 0) {
            $query = "SELECT s.id, s.sku, s.lastInventory_id,  s.productName, GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00')) AS created_at FROM skus s 
                LEFT JOIN dispatch_elements de ON s.sku = de.sku AND de.created_at = (SELECT MAX(created_at) FROM dispatch_elements WHERE sku = de.sku) 
                LEFT JOIN reception_elements re ON s.sku = re.sku AND re.created_at = (SELECT MAX(created_at) FROM reception_elements WHERE sku = re.sku) 
                WHERE s.interest_id = $interest_id AND GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00')) < '"
                     .$reference->toDateTimeString()."'
                ORDER BY GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00'))";
        } else {
            $query = "SELECT s.id, s.sku, s.lastInventory_id,  s.productName, GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00')) AS created_at FROM skus s 
                LEFT JOIN dispatch_elements de ON s.sku = de.sku AND de.created_at = (SELECT MAX(created_at) FROM dispatch_elements WHERE sku = de.sku) 
                LEFT JOIN reception_elements re ON s.sku = re.sku AND re.created_at = (SELECT MAX(created_at) FROM reception_elements WHERE sku = re.sku) 
                WHERE GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00')) < '"
                     .$reference->toDateTimeString()."' 
                ORDER BY GREATEST(COALESCE(de.created_at, '2020-06-05 00:00:00'), COALESCE(re.created_at, '2020-06-05 00:00:00'))";
        }

        $data = DB::select($query);

        $skus = Sku::hydrate($data);

        /*$skus = Sku::limit(100)
                   ->get();*/

        $skus = $skus->filter(function ($item) {
            $stock = $item->calculateStock();
            if (intval($stock) > 0) {
                $item->stock = $stock;

                return $item;
            }
        });


        return view('skus.slowMoving')->with([
            'skus'        => $skus,
            'months'      => $months,
            'interest_id' => $interest_id
        ]);
    }
}
