<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;


/**
 * InventoryElement
 *
 * @mixin Eloquent
 */

class InventoryElement extends Model
{

    protected $guarded = [];

    public function inventory()
    {
        return $this->belongsTo( Inventory::class );
    }

    public function sku()
    {
        return $this->belongsTo( Sku::class );
    }
}
