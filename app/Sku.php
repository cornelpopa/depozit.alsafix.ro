<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Post
 *
 * @mixin Eloquent
 */
class Sku extends Model
{

    protected $guarded = [];

    use SoftDeletes;

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function sale_unit()
    {
        return $this->belongsTo(SaleUnit::class);
    }

    public static function findBySku($sku)
    {
        $skuObj = Sku::where('sku', 'LIKE', $sku)->firstOrNew();

        return $skuObj;
    }

    public static function findByEan($ean)
    {
        $skuObj = Sku::where('ean', 'LIKE', $ean)->firstOr(function () use ($ean) { dd($ean, " not found!!!"); });

        return $skuObj;
    }

    public function calculateStock($date = null)
    {
        $inventoryQuantity = 0;

        if (!isset($date)) {


            if ($this->lastInventory_id > 0) {
                $referenceInventory = Inventory::find($this->lastInventory_id);
                $inventoryQuantity = $referenceInventory->elements()->where('sku_id', $this->id)->first()->realStock;
            } else {
                $referenceInventory = Inventory::oldest('inventoryDate')->first();
            }

            $inMovements = ReceptionElement::where('sku', 'LIKE', $this->sku)->where('created_at', ">=",
                (isset($referenceInventory) ? $referenceInventory->inventoryDate->format("Y-m-d 00:00:00") : "2019-01-01 00:00:00"))->get();

            foreach ($inMovements as $movement) {
                $inventoryQuantity += $movement->qty * $movement->unit;
            }

            $outMovements = DispatchElement::where('sku', 'LIKE', $this->sku)->where('created_at', ">=",
                (isset($referenceInventory) ? $referenceInventory->inventoryDate->format("Y-m-d 00:00:00") : "2019-01-01 00:-0:00"))->get();

            foreach ($outMovements as $movement) {
                $inventoryQuantity -= $movement->qty * $movement->unit;
            }

        }

        return $inventoryQuantity;
    }

    public function path()
    {
        return '/skus/'.$this->id;
    }
}
