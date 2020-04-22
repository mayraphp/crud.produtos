<?php

use App\Product;
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

Route::namespace('Api')->prefix('products')->group(function(){

    Route::post('/import', 'ProductController@import')->name('import');
    Route::post('/show', 'ProductController@show')->name('show');
    Route::get('/destroy/{product}', 'ProductController@destroy')->name('destroy');

});

