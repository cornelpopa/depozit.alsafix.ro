<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @mixin Eloquent
 * @property mixed elements
 * @property mixed name
 */
class Reception extends Model
{

    protected $guarded = [];

    public function path()
    {
        return route('receptions.show', $this->id);
    }

    public function elementsCount()
    {
        return $this->hasMany(ReceptionElement::class)->sum('qty');
    }

    public function addElementBy($key, $value)
    {


        $receptionElement = ReceptionElement::where($key, $value)->where('reception_id', $this->id)->first();

        if ($receptionElement === null) {

            $attributes = getAttributesBy($key, $value);

            if (!isset($attributes[ 'sku' ])) {

                return $attributes;

            } else {
                unset($attributes["id"]);
                return $this->elements()->create($attributes);
            }

        } else {
            $receptionElement->increaseReceptionElementQty();

            return $receptionElement = ReceptionElement::where($key, $value)->where('reception_id', $this->id)->first();
        }

    }

    public function elements()
    {
        return $this->hasMany('App\ReceptionElement');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(['A' => 'B']);
    }

}
