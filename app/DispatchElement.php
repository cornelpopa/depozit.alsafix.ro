<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * DispatchElement
 *
 * @mixin Eloquent
 */
class DispatchElement extends Model
{

    protected $touches = ['dispatch'];

    protected $with = ['skuD'];

    public function dispatch()
    {
        return $this->belongsTo(Dispatch::class);
    }

    public function skuD()
    {
        return $this->belongsTo(Sku::class, 'sku', 'sku');
    }

    public function sale_unit()
    {
        return $this->belongsTo(SaleUnit::class);
    }
}
