<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('stock')->group(function() {
	
	Route::post('add', 'StockController@add');

	// Route::post('edit/{id}', 'StockController@edit');

	Route::post('update/{id}', 'StockController@update');

	Route::get('item/{id}', 'StockController@show');

	Route::get('all', 'StockController@all');

	Route::post('delete', 'StockController@delete');

});
