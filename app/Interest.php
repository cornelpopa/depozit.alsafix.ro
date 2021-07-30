<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}
