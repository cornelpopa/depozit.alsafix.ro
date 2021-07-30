<?php

namespace App\Http\Controllers;

use App\Reception;
use App\ReceptionElement;

class ReceptionElementsController extends Controller
{

    public function index()
    {
        echo "TEst";
    }


    public function initial( Reception $reception )
    {
        $receptionElements = $reception->elements->sortByDesc( 'created_at' );
        $lastModifiedElement = $reception->elements->sortByDesc( 'updated_at' )->first();

        if ( $lastModifiedElement ) {
            $lastModified = $lastModifiedElement->id;
        } else {
            $lastModified = 0;
        }

        $addForm = true;

        return view( 'receptionsElements.initial' )->with( [ 'reception'         => $reception,
                                                             'receptionElements' => $receptionElements,
                                                             'lastModified'      => $lastModified,
                                                             'addForm'           => $addForm
        ] );
    }

    public function store( Reception $reception )
    {

        if ( request( 'SkuSend' ) > "" ) {
            $attributes = request()->validate( [ 'sku' => 'required|min:3' ] );
            $reception->addElementBy( 'sku', $attributes[ 'sku' ] );

        } else {
            $attributes = request()->validate( [ 'ean' => 'required|gtin' ] );
            $result = $reception->addElementBy( 'ean', $attributes[ 'ean' ] );

            if (! isset($result->id)) {
                return view('error')->with([
                    'errorMessage' => $result,
                ]);
            }

        }

        return redirect()->action( 'ReceptionElementsController@initial',
            $reception->id )->with( [ 'reception' => $reception ] );

    }

    public function update( Reception $reception, ReceptionElement $receptionElement )
    {
        if ( request( 'qty' ) > "" ) {
            $receptionElement->qty = request( 'qty' );


            if ( $receptionElement->qty > 0 ) {
                $receptionElement->save();
            } else {
                try {
                    $receptionElement->delete();
                } catch ( \Exception $e ) {
                    die ( "Here!.$e" );
                }
            }
        }

        return redirect( route( 'addReceptionElements', $reception ) );
    }

    public function more( Reception $reception, ReceptionElement $receptionElement )
    {

        $receptionElement->qty += 1;
        $receptionElement->save();

        return redirect( route( 'addReceptionElements', $reception ) );
    }

    public function less( Reception $reception, ReceptionElement $receptionElement )
    {

        if ( $receptionElement->qty > 1 ) {
            $receptionElement->qty -= 1;
            $receptionElement->save();
        }

        return redirect( route( 'addReceptionElements', $reception ) );
    }

}
