<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Dispatch
 *
 * @mixin Eloquent
 */
class Dispatch extends Model
{

    public function getElementsCountAttribute()
    {
        return $this->elements()->count();
    }


    public function elements()
    {
        return $this->hasMany(DispatchElement::class);
    }

    public function shipping_info()
    {
        return $this->hasOne(ShippingInfo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['A' => 'B']);
    }

}
