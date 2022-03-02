<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes( [ "register" => false ] );

Route::group( [ 'middleware' => 'auth' ], function () {

    Route::get('/search', 'SearchController@search')->name('search');

    Route::redirect( '/', '/reports' );

    Route::get( 'skus/withDeleted/', 'SkuController@withDeleted' )->name( 'skus.withDeleted' );
    Route::get( 'skus/importSkuCat/', 'SkuController@importSkuCat' )->name( 'skus.importSkuCat' );
    Route::post( 'skus/importSkuCat/', 'SkuController@processSkuCat' )->name( 'skus.importSkuCat' );
    Route::get( 'skus/importSkuUM/', 'SkuController@importSkuUM' )->name( 'skus.importSkuUM' );
    Route::post( 'skus/importSkuUM/', 'SkuController@processSkuUM' )->name( 'skus.importSkuUM' );
    Route::get('skus/{sku}/exceptional', 'SkuController@exceptional')->name('skus.exceptional')->middleware('admin');
    Route::post('skus/{sku}/exceptional', 'SkuController@saveExceptional')->name('skus.saveExceptional')->middleware('admin');
    Route::get( 'skus/slowMoving', 'SkuController@slowMoving' )->name( 'skus.slowMoving' );
    Route::resource( 'skus', 'SkuController' );

    Route::get( '/receptions/{reception}/elements',
        'ReceptionElementsController@initial' )->name( 'addReceptionElements' );
    Route::post( '/receptions/{reception}/elements', 'ReceptionElementsController@store' );
    Route::get( '/receptions/{reception}/export', 'ReceptionController@export' )->name( 'exportReception' );
    Route::get( '/receptions/{reception}/more/{receptionElement}',
        'ReceptionElementsController@more' )->name( 'plusReceptionElement' );
    Route::get( '/receptions/{reception}/less/{receptionElement}',
        'ReceptionElementsController@less' )->name( 'minusReceptionElement' );
    Route::post( '/receptions/{reception}/update/{receptionElement}',
        'ReceptionElementsController@update' )->name( 'updateReceptionElement' );

    Route::resource( 'receptions', 'ReceptionController' );

    Route::resource( 'forwarders', 'ForwarderController' );


    Route::get('/dispatches/{dispatch}/index', 'DispatchElementController@index')->name('DispatchElementsIndex');
    Route::post('/dispatches/{dispatch}/index', 'DispatchElementController@store')->name('DispatchElementsIndex');
    Route::get('/dispatches/{dispatch}/edit', 'DispatchElementController@edit')->name('DispatchElementsEdit');
    Route::post('/dispatches/{dispatch}/edit', 'DispatchElementController@store')->name('DispatchElementsEdit');
    Route::get('/dispatches/{dispatch}/more/{dispatchElement}',
        'DispatchElementController@more')->name('moreDispatchElement');
    Route::get('/dispatches/{dispatch}/less/{dispatchElement}',
        'DispatchElementController@less')->name('lessDispatchElement');
    Route::post('/dispatches/{dispatch}/update/{dispatchElement}',
        'DispatchElementController@update')->name('updateDispatchElement');

    Route::get('/dispatches', 'DispatchController@index')->name('dispatches.index');
    Route::get('/dispatches/{dispatch}/updateSkuUnit', 'DispatchController@updateSkuUnit')->name('dispatches.updateSkuUnit');
    Route::get('/dispatches/create', 'DispatchController@create')->name('dispatches.create');
    Route::get('/dispatches/{dispatch}', 'DispatchController@show')->name('dispatches.show');
    Route::post('/dispatches', 'DispatchController@store')->name('dispatches.store');
    Route::delete('/dispatches/{dispatch}', 'DispatchController@destroy')->name('dispatches.destroy')->middleware('admin');
    Route::get('/dispatches/name/{name}', 'DispatchController@name')
         ->name('dispatches.name');


    Route::get( '/inventories/compareInventory',
        'InventoryController@getCompareInventory' )->name( 'getCompareInvetory' );
    Route::post( '//inventories/compareInventory',
        'InventoryController@compareInventory' )->name( 'compareInventory' );
    Route::resource( 'inventories', 'InventoryController' );
    Route::post( 'inventories/checkCSV', 'InventoryController@checkCSV' )->name( 'checkCSV' );

    Route::get( '/logs', 'LogController@index' )->name( 'logs' );

    Route::get( '/logout', 'Auth\LoginController@logout' );

    Route::get( '/reports', "ReportsController@index" );

    Route::get('/shipping_info/{dispatch}', 'ShippingInfoController@show')->name('shipping_info');

} );

Route::get('/api/skuData', 'ApiController@skuData');
Route::get('/dispatches/{dispatch}/updatePrice', 'DispatchElementController@updatePrice')->name('DispatchElementsUpdatePrice');
Route::get('/dispatches/importBL/{name}', 'DispatchController@importBL')->name('importBL');

