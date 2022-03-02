<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingInfo extends Model
{
    use HasFactory;

    public function dispatch(): BelongsTo
    {
        return $this->belongsTo(Dispatch::class);
    }
}
