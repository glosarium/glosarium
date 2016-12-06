<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tambah-kata', 'WordController@create')->name('word.create');
    Route::post('/simpan-kata', 'WordController@store')->name('word.store');
});

Route::get('/{category}/{word}', 'WordController@show')->name('word.detail');

Route::get('/{hash}', 'LinkController@show')->name('link.show');
