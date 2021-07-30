<?php


// Normalize line endings.
function normalize($s) {
    // Convert all line-endings to UNIX format.
    $s = str_replace(array("\r\n", "\r", "\n"), "\n", $s);

    // Don't allow out-of-control blank lines.
    $s = preg_replace("/\n{3,}/", "\n\n", $s);
    return $s;
}


use App\Sku;

function getFormattedTotal($number)
{
    return number_format($number, 0, null, ".");
}

function getAttributesBy($key, $value)
{
    $skuData = Sku::where($key, $value)->get([
        'productName',
        'ean',
        'sku',
        'unit'
    ])->first();

    if ($skuData) {
        $attributes = $skuData->toArray();
    } else {
        $attributes[ 'productName' ] = "not found";
        $attributes[ 'ean' ] = ($key == 'ean' ? $value : '');
        $attributes[ 'sku' ] = ($key == 'sku' ? $value : '');
        $attributes[ 'unit' ] = 1;

        if ($attributes[ 'sku' ] == '') {
            return 'Nu exista SKU cu ean: '.$attributes[ 'ean' ]." - trebuie intai creat SKU!";
        }

        $sku = Sku::create($attributes);

        $attributes = $sku->toArray();

    }

    return $attributes;
}
