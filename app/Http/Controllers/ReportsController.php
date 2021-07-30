<?php

namespace App\Http\Controllers;

use App\Sku;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    use SoftDeletes;

    public function index() {

        $skuCount = Sku::count();

        return view( "reports.index" )->with(['skuCount' => $skuCount]);
    }
}
