<?php

namespace App\Http\Controllers;

use App\Reception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceptionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        $search = request()->has( 'search' ) ? request( 'search' ) : "";

        $query = Reception::query();

        if ( $search > "" ) {
            $query->where( 'name', 'LIKE', "%".$search."%" );
        }

        if ( Reception::count() > 0 ) {
            $max = max( array_map( function ( $a ) { return intval( substr( $a, 0, 10 ) ); },
                    Reception::where( 'name', '>', '' )->pluck( 'name' )->toArray() ) ) + 1;
        } else {
            $max = "";
        }

        $query->orderBy( 'updated_at', 'DESC' );

        $receptions = $query->paginate( 15 );

        if ( $search > "" ) {
            return view( 'receptions.index' )->with( [ 'receptions' => $receptions,
                                                       'max'        => $max,
                                                       'search'     => $search,
            ] );
        } else {
            return view( 'receptions.index' )->with( [ 'receptions' => $receptions,
                                                       'max'        => $max
            ] );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {

        if ( Reception::count() > 0 ) {
            $max = max( array_map( function ( $a ) { return intval( substr( $a, 0, 10 ) ); },
                    Reception::where( 'name', '>', '' )->pluck( 'name' )->toArray() ) ) + 1;
        } else {
            $max = "";
        }

        return view( 'receptions.create' )->with(['max' => $max]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse|Response
     */
    public function store( Request $request )
    {
        $attributes = request()->validate( [ 'name' => 'required' ] );
        $attributes[ 'name' ] .= request()->input( 'name2' );

        $attributes[ 'user_id' ] = auth()->id();

        $newReception = Reception::create( $attributes );

        return redirect()->action( 'ReceptionElementsController@initial', [ 'reception' => $newReception ] );

    }

    /**
     * Display the specified resource.
     *
     * @param  Reception  $reception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show( Reception $reception )
    {

        $receptionElements = $reception->elements->sortBy('sku');

        return view( 'receptions.show' )->with( [ 'reception'         => $reception,
                                                  'receptionElements' => $receptionElements
        ] );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reception  $reception
     * @return Response
     */
    public function edit( Reception $reception )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Reception  $reception
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function update( Request $request, Reception $reception )
    {

        $attributes = $request->validate( [ 'name' => 'required|min:3' ] );

        $reception->name = $attributes[ 'name' ];

        $reception->save();

        return view( 'receptions.show' )->with( [ 'reception' => $reception ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reception  $reception
     * @return Response
     */
    public function destroy( Reception $reception )
    {
        //
    }

    public function export( Reception $reception )
    {
        $receptionElements = $reception->elements;
        $receptionName = $reception->name;

        $subset = $receptionElements->map( function ( $receptionElement ) use ( $receptionName ) {
            return [ 'sku'           => $receptionElement->sku,
                     'qty'           => $receptionElement->qty * $receptionElement->unit,
                     'receptionName' => $receptionName,
            ];
        } );

        $csv = \League\Csv\Writer::createFromFileObject( new \SplTempFileObject() );
        $csv->setNewline( "@\r\n" );

        foreach ( $subset as $receptionElement ) {
            $csv->insertOne( ( $receptionElement ) );
        }

        $csv->output( $reception->name.".csv" );

        return;
    }
}
