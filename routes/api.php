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

/**
 * ALPHA VERSION
 */

Route::group(['namespace' => 'Api\Alpha'], function () {
    // auth
    Route::post('auth', 'AuthController@authenticate');

    Route::group(['middleware' => 'jwt.auth', 'namespace' => 'Glosarium'], function () {
        // category
        Route::get('glosarium/category', 'CategoryController@index');
        Route::get('glosarium/category/search', 'CategoryController@search');
        Route::get('glosarium/category/random', 'CategoryController@random');
        Route::get('glosarium/category/{slug}', 'CategoryController@show');

        // word
        Route::get('glosarium/word', 'WordController@index');
        Route::get('glosarium/word/search', 'WordController@search');
        Route::get('glosarium/word/random', 'WordController@random');
        Route::get('glosarium/word/{slug}', 'WordController@show');
    });
});

/**
 * BETA VERSION
 */

Route::group(['prefix' => 'beta', 'namespace' => 'Api\Beta'], function () {
    // user
    Route::post('user/register', 'UserController@register');
    Route::post('user/login', 'UserController@login');

    Route::group(['middleware' => 'jwt.auth', 'namespace' => 'Glosarium'], function () {
        // category
        Route::get('glosarium/category', 'CategoryController@index');
        Route::get('glosarium/category/search', 'CategoryController@search');
        Route::get('glosarium/category/random', 'CategoryController@random');
        Route::get('glosarium/category/{slug}', 'CategoryController@show');

        // word
        Route::get('glosarium/word', 'WordController@index');
        Route::get('glosarium/word/search', 'WordController@search');
        Route::get('glosarium/word/random', 'WordController@random');
        Route::post('glosarium/word/propose', 'WordController@propose');
        Route::get('glosarium/word/{slug}', 'WordController@show');
    });
});
