<?php

namespace App\Http\Controllers;

use App\Sku;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function skuData(Request $request)
    {
        $sku = Sku::where('sku', 'like', $request[ 'sku' ])->first(['sku','productName','unit']);

        return $sku;
    }
}
