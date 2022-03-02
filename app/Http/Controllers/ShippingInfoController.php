<?php

namespace App\Http\Controllers;

use App\Dispatch;
use App\ShippingInfo;

class ShippingInfoController extends Controller
{

    /**
     * Display shipping notification create page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Dispatch $dispatch)
    {
        $shipping_info = $dispatch->shipping_info;

        if (is_null($shipping_info)) {
            $shipping_info = new ShippingInfo();
        }

        return view('shipping_info.show')->with([
            'dispatch'      => $dispatch,
            'shipping_info' => $shipping_info,
        ]);
    }

}
