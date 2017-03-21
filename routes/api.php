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

Route::post('auth', 'Api\AuthController@authenticate');

Route::group(['prefix' => 'glosarium', 'namespace' => 'Api\Glosarium'], function () {
    // category
    Route::get('category', 'CategoryController@index');
    Route::get('category/search', 'CategoryController@search');
    Route::get('category/{slug}', 'CategoryController@show');

    // word
    Route::get('word', 'WordController@index');
    Route::get('word/search', 'WordController@search');
    Route::get('word/{slug}', 'WordController@show');
});
