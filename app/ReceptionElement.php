<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;


/**
 * ReceptionElement
 *
 * @mixin Eloquent
 */

class ReceptionElement extends Model
{

    protected $touches = [ 'reception' ];

    protected $guarded = [];


    public function increaseReceptionElementQty()
    {
        echo $this->attributes[ 'qty' ];
        $this->attributes[ 'qty' ] += 1;
        $this->save();
    }


    public function reception()
    {
        return $this->belongsTo( 'App\Reception' );
    }
}


