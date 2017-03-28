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

// user
Route::post('user/register', 'Api\UserController@register');
Route::post('user/login', 'Api\UserController@login');

Route::group(['prefix' => 'glosarium', 'namespace' => 'Api\Glosarium', 'middleware' => 'jwt.auth'], function () {
    // category
    Route::get('category', 'CategoryController@index');
    Route::get('category/search', 'CategoryController@search');
    Route::get('category/random', 'CategoryController@random');
    Route::get('category/{slug}', 'CategoryController@show');

    // word
    Route::get('word', 'WordController@index');
    Route::get('word/search', 'WordController@search');
    Route::get('word/random', 'WordController@random');
    Route::post('word/propose', 'WordController@propose');
    Route::get('word/{slug}', 'WordController@show');
});
