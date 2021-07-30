<?php

namespace App\Http\Controllers;

use App\DispatchElement;
use App\ReceptionElement;
use App\Sku;

class SearchController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $searchAll = request('searchAll');

        $skus = Sku::where('sku', 'LIKE', '%'.$searchAll.'%')->take(5)->get();

        $receptionElements = ReceptionElement::where('sku', 'LIKE', '%'.$searchAll.'%')->orderBy('created_at',
            'DESC')->with('reception')->take(5)->get();

        $dispatchElements = DispatchElement::where('sku', 'LIKE', '%'.$searchAll.'%')->orderBy('created_at',
            'DESC')->with('dispatch')->take(5)->get();

        return view('search')->with([
            'searchAll'         => $searchAll,
            'skus'              => $skus,
            'receptionElements' => $receptionElements,
            'dispatchElements'  => $dispatchElements

        ]);

    }
}
