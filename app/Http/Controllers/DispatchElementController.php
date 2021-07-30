<?php

namespace App\Http\Controllers;

use App\Dispatch;
use App\DispatchElement;
use App\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DispatchElementController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Dispatch $dispatch)
    {
        $dispatchElements = $dispatch->elements;

        return view('dispatchElements.index')->with([
            'dispatch'         => $dispatch,
            'dispatchElements' => $dispatchElements
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request, Dispatch $dispatch)
    {

        if ($request['eanSend'] > "") {
            $attributes = $request->validate(['ean' => 'required|gtin']);
            $ean = $attributes['ean'];
            $attributes = $request->validate([
                'ean' => Rule::exists('skus')
                             ->where(function ($query) use ($ean) {
                                 $query->where('ean', 'LIKE', $ean);
                             })
            ]);

            $skuObj = Sku::findByEan($ean);
            $sku = $skuObj->sku;

            $attributes = $request->validate([
                'ean' => Rule::exists('dispatch_elements')
                             ->where(function ($query) use ($dispatch, $sku) {
                                 $query->where('dispatch_id', $dispatch->id)
                                       ->where('sku', 'LIKE', $sku);
                             })
            ]);

        } else {

            $attributes = request()->validate(['sku' => 'required']);
            $sku = $attributes['sku'];
            $attributes = request()->validate([
                'sku' => Rule::exists('dispatch_elements')
                             ->where(function ($query) use ($dispatch, $sku) {
                                 $query->where('dispatch_id', $dispatch->id)
                                       ->where('sku', 'LIKE', $sku);
                             })
            ]);

            $skuObj = Sku::findBySku($attributes['sku']);

        }

        $dispatchElement = $dispatch->elements()
                                    ->where('sku', 'LIKE', $skuObj->sku)
                                    ->first();
        $dispatchElement->qty = $dispatchElement->qty + 1;
        $dispatchElement->update();

        return redirect()
            ->action('DispatchElementController@edit', $dispatch->id)
            ->with(['dispatch' => $dispatch]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DispatchElement  $dispatchElement
     * @return \Illuminate\Http\Response
     */
    public function show(DispatchElement $dispatchElement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DispatchElement  $dispatchElement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Dispatch $dispatch)
    {
        $dispatchElements = $dispatch->elements;

        return view('dispatchElements.edit')->with([
            'dispatch'         => $dispatch,
            'dispatchElements' => $dispatchElements
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DispatchElement  $dispatchElement
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Dispatch $dispatch, DispatchElement $dispatchElement)
    {
        if ((int) request('qty') >= 0) {
            $dispatchElement->qty = (int) request('qty');
            $dispatchElement->save();
        }

        return redirect(route('DispatchElementsEdit', $dispatch));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DispatchElement  $dispatchElement
     * @return \Illuminate\Http\Response
     */
    public function destroy(DispatchElement $dispatchElement)
    {
        //
    }


    public function more(Dispatch $dispatch, DispatchElement $dispatchElement)
    {

        $dispatchElement->qty += 1;
        $dispatchElement->save();

        return redirect(route('DispatchElementsEdit', $dispatch));
    }

    public function less(Dispatch $dispatch, DispatchElement $dispatchElement)
    {

        if ($dispatchElement->qty >= 1) {
            $dispatchElement->qty -= 1;
            $dispatchElement->save();
        }

        return redirect(route('DispatchElementsEdit', $dispatch));
    }

    public function updatePrice(Dispatch $dispatch)
    {

        $dispatchElements = $dispatch->elements;

        $storagePath = Storage::disk('local')
                              ->getDriver()
                              ->getAdapter()
                              ->getPathPrefix().'dispatchesCSV\\'.Str::substr($dispatch->name, 0, 4)."\\";

        $file = $storagePath.$dispatch->name.".csv";

        $rows = array_map(function ($v) {
            return str_getcsv($v, ";");
        }, file($file));

        if (count($rows)) {
            foreach ($rows as $row) {
                $dispatchElement = $dispatchElements->where('sku', $row[7])
                                                    ->first();
                $sku = $dispatchElement->skuD;
                $dispatchElement->price = $row['11'];
                $dispatchElement->sale_unit_id = $sku->sale_unit_id;
            }
        }

        return response()->json(['result' => true]);
    }
}
