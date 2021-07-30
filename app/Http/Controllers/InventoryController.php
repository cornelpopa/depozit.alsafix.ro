<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\InventoryElement;
use App\Sku;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        ;
        if ($i = Inventory::oldest('inventoryDate')->first()) {
            $oldestInventory = $i->inventoryDate->Format("Y-m-d");
        } else {
            $oldestInventory = date('Y-m-d');
        }
        if ($i = Inventory::latest('inventoryDate')->first()) {
            $newestInventory = $i->inventoryDate->Format("Y-m-d");
        } else {
            $newestInventory = date('Y-m-d');
        }

        $filters[ 'name' ] = request()->has('name') ? request('name') : "";
        $filters[ 'observation' ] = request()->has('observation') ? request('observation') : "";
        $inventoryRange = request()->has('inventoryRange') ? request('inventoryRange') : $oldestInventory." → ".$newestInventory;

        $query = Inventory::query();

        $query->withCount('elements');
        $query->orderBy('inventoryDate', 'DESC');

        foreach ($filters as $key => $value) {
            if ($key != 'page') {
                $query->where($key, 'LIKE', '%'.$value.'%');
            }
        }

        $rangeArray = explode(" → ", $inventoryRange);
        $fromRange = date($rangeArray[ 0 ]." 00:00:00");
        $toRange = date($rangeArray[ 1 ]." 23:59:00");

        $query->whereBetween('inventoryDate', [
            $fromRange,
            $toRange
        ]);

        $invetories = $query->paginate(15);

        return view('inventory.index')->with([
            'inventories'     => $invetories,
            'oldestInventory' => $oldestInventory,
            'newestInventory' => $newestInventory,
            'filters'         => $filters,
            'inventoryRange'  => $inventoryRange,
            'fromRange'       => $fromRange,
            'toRange'         => $toRange
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function create()
    {
        return view('inventory.create');
    }


    /**
     * CheckCSV checks the provided file & data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function checkCSV(Request $request)
    {
        $request->validate([
            'name'       => 'required|min:3',
            'gescomFile' => 'required|file'
        ]);

        $path = $request->file('gescomFile')->getRealPath();

        $newData = $this->processGescomCsvFile($path);

        return view('inventory.checkCSV')->with([
            'formData' => $request,
            'newData'  => $newData
        ]);

    }

    public function processGescomCsvFile(string $path): array
    {
        $rows = array_map(function ($v) { return str_getcsv($v, ";"); }, file($path));

        $skus = Sku::all()->toArray();
        array_unshift($skus, [
            "id"  => 0,
            "sku" => ""
        ]);

        foreach ($rows as $row) {
            if (count($row) == 8 and $row[ 1 ] > "") {

                if ($sku = array_search($row [ 0 ], array_column($skus, 'sku'))) {
                    $row [] = $skus[ $sku ][ 'id' ];
                    $row [] = $skus[ $sku ][ 'productName' ];
                } else {
                    $row[] = 0;
                    $row[] = "";
                }
                $newData[] = $row;
            }
        };

        return $newData;

    }

    /**
     * @param  string  $path
     * @return array
     */
    public function processGescomCsvFileDeprecated(string $path): array
    {
        $rows = array_map(function ($v) { return str_getcsv($v, ";"); }, file($path));

        $newData = array();

        foreach ($rows as $row) {
            if (count($row) == 8 and $row[ 1 ] > "") {
                $skuId = Sku::where('sku', 'LIKE', $row[ 0 ])->firstOr(function () { return "not found"; });
                if (isset($skuId->id)) {
                    $row[] = $skuId->id;
                    $row[] = $skuId->productName;
                } else {
                    $row[] = 0;
                    $row[] = "";
                }
                $newData[] = $row;
            }
        };

        return $newData;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function store(Request $request)
    {

        $attributes = [
            'user_id'       => auth()->user()->id,
            'name'          => $request->name,
            'observation'   => $request->observation ?? "",
            'inventoryDate' => $request->inventoryDate
        ];

        $inventory = new Inventory($attributes);

        $inventory->save();

        $newData = unserialize($request->newData);

        $skuIds = [];

        foreach ($newData as $row) {

            $skuId = false;

            if ($row[ 8 ] == 0) {
                $skuAtributtes = [
                    'sku'         => $row[ 0 ],
                    'productName' => $row[ 1 ],
                    'unit'        => 1,
                    'ean'         => ""
                ];

                $newSku = Sku::create($skuAtributtes);

                $skuId = $newSku->id;
            }

            $newInventoryElementAttributes = [
                'inventory_id'    => $inventory->id,
                'sku_id'          => $skuId ? $skuId : $row[ 8 ],
                'readSku'         => $row[ 0 ],
                'readProductName' => $row[ 1 ],
                'warehouse'       => $row[ 2 ],
                'warehouseName'   => $row[ 3 ],
                'realStock'       => $row[ 4 ],
                'availableStock'  => $row[ 5 ],
                'reservedStock'   => $row[ 7 ]

            ];

            $skuIds [] = $newInventoryElementAttributes[ 'sku_id' ];

            $data[] = $newInventoryElementAttributes;

        }

        InventoryElement::insert($data);

        Sku::whereIn('id', $skuIds)->update(['lastInventory_id' => $inventory->id]);

        return redirect(route('inventories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Inventory $inventory)
    {
        if (request('search') > '') {
            $search = request('search');
            $inventoryElements = $inventory->elements()->where('readSku', 'LIKE', '%'.$search.'%')->paginate(50);
        } else {
            $inventoryElements = $inventory->elements()->paginate(50);
            $search = '';
        }


        return view('inventory.show')->with([
            'inventory'         => $inventory,
            'inventoryElements' => $inventoryElements,
            'search'            => $search,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function getCompareInventory()
    {
        return view('inventory.getInventory4Compare');
    }

    public function compareInventory(Request $request)
    {
        $request->validate([
            'inventoryDate' => 'required',
            'gescomFile'    => 'required|file'
        ]);

        $path = $request->file('gescomFile')->getRealPath();

        $newData = $this->processGescomCsvFile($path);

        #dd( $newData );

        $compareData = [];

        foreach ($newData as $row) {
            $depStock = Sku::find($row[ 8 ])->calculateStock();

            if (intval($row[ 4 ]) != $depStock) {
                $compareData[] = [
                    $row[ 0 ],
                    $row[ 1 ],
                    intval($row[ 4 ]),
                    $depStock,
                    $row[ 9 ],
                    $row[ 8 ]
                ];
            }
        }

        return view('inventory.compareInventory')->with(['compareData' => $compareData]);

    }
}
