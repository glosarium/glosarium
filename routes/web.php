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

Route::get('kontak', 'ContactController@form')->name('contact.form');
Route::post('kontak', 'ContactController@send')->name('contact.post');

Route::get('/', 'PageController@index')->name('index');
