<?php

namespace App\Http\Controllers;

use App\Dispatch;
use App\DispatchElement;
use App\Rules\GescomBlExportFileExists;
use App\Sku;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;


class DispatchController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $search = $request['search'] ?? "";

        $query = Dispatch::query();

        $query->where('name', 'like', '%'.$search.'%')
              ->orWhere('gescomClientName', 'like', '%'.$search.'%');

        $query->orderByDesc('updated_at');

        $dispatches = $query->paginate(15);

        return view('dispatches.index')->with([
            'dispatches' => $dispatches,
            'search'     => $search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('dispatches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'name' => [
                'required',
                new GescomBlExportFileExists
            ]
        ]);

        $checkDispatch = Dispatch::where('name', $attributes['name'])
                                 ->first();

        if ($checkDispatch) {
            return redirect(route('dispatches.show', $checkDispatch));
        }


        $storagePath = Storage::disk('local')
                              ->getDriver()
                              ->getAdapter()
                              ->getPathPrefix().'dispatchesCSV\\'.Str::substr($attributes['name'], 0, 4)."\\";

        $oldFile = 'C:/BL/'.$attributes['name'].'.csv';
        $newFile = $storagePath.$attributes['name'].'.csv';
        copy($oldFile, $newFile);

        $rows = array_map(function ($v) {
            return str_getcsv($v, ";");
        }, file($newFile));

        //array_shift($rows);

        if (count($rows)) {
            $dispatch = new Dispatch;
            $dispatch->user_id = auth()->id();
            $dispatch->name = (int) $rows[0][0];
            $dispatch->dispatchDate = DateTime::createFromFormat('Ymd', $rows[0][1])
                                              ->format('Y-m-d');
            $dispatch->gescomCodeClient = (int) $rows[0][2];
            $dispatch->gescomClientName = mb_convert_encoding($rows[0][3], 'US-ASCII', 'UTF-8');
            $dispatch->gescomCity = $rows[0][4];
            $dispatch->agent_id = (int) $rows[0][5];
            $dispatch->gescomReferenceOrder = mb_convert_encoding($rows[0][6], 'US-ASCII', 'UTF-8');

            $dispatch->save();

            foreach ($rows as $row) {
                $dispatchElement = new DispatchElement;
                $dispatchElement->sku = $row[7];
                $dispatchElement->qtyOrdered = $row[8];
                $dispatchElement->qtyDelivered = $row[9];
                $dispatchElement->qtyRemaining = $row[10];
                $dispatchElement->qty = 0;
                $dispatchElement->price = $row[11];

                $sku = Sku::findBySku($dispatchElement->sku);

                if ($sku->sku == "") {
                    $errorMessage = 'SKU '.$dispatchElement->sku.' nu există în baza de date! Trebuie creat!';
                    $dispatch->elements()
                             ->delete();
                    $dispatch->delete();

                    return view('error')->with([
                        'errorMessage' => $errorMessage,
                    ]);

                }

                $dispatchElement->ean = $sku->ean;
                $dispatchElement->unit = $sku->unit;
                $dispatchElement->productName = $sku->productName;

                $dispatch->elements()
                         ->save($dispatchElement);
            }

        }

        return redirect()->action('DispatchElementController@edit', $dispatch);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dispatch  $dispatch
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function show(Dispatch $dispatch)
    {
        return redirect()->action('DispatchElementController@index', $dispatch);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispatch $dispatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispatch $dispatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dispatch  $dispatch
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Dispatch $dispatch)
    {

        $dispatch->elements()
                 ->delete();

        $dispatch->delete();

        return redirect()->route('dispatches.index');
    }

    /**
     * Updates the unit field from SKU table.
     *
     * @param  \App\Dispatch  $dispatch
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function updateSkuUnit(Dispatch $dispatch)
    {
        $dispatchElements = $dispatch->elements;

        foreach ($dispatchElements as $dispatchElement) {
            $sku = Sku::where('sku', 'like', $dispatchElement->sku)
                      ->first();

            //dd($dispatchElement, $sku);

            $dispatchElement->unit = $sku->unit;
            $dispatchElement->update();
        }

        return redirect()->back();
    }

    public function name(string $name)
    {
        $dispatch = Dispatch::firstWhere('name', $name);

        return redirect()->route('dispatches.show', $dispatch);
    }

}
