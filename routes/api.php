<?php

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

Route::group(['namespace' => 'Api\V1'], function() {
    Route::group(['namespace' => 'Glosarium', 'prefix' => 'glosarium'], function(){
        Route::get('word/search', 'WordController@search');
    });
});