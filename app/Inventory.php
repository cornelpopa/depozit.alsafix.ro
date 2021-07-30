<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Inventory
 *
 * @mixin Eloquent
 */

class Inventory extends Model
{

    protected $guarded = [];

    protected $dates = ['inventoryDate'];


    public function user()
    {
        $this->belongsTo( User::class );
    }

    public function elements()
    {
        return $this->hasMany( InventoryElement::class );
    }

}
