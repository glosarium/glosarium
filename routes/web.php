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

Route::get('api', 'ApiController@index')->name('api.index');

Route::get('/contact', 'ContactController@form')->name('contact.form');
Route::post('/contact/send', 'ContactController@send')->name('contact.post');

Route::get('/external', 'LinkController@external')->name('link.external');

Route::get('/{hash}', 'LinkController@redirect')->name('link.redirect')
    ->where('hash', '[A-Za-z0-9]+');
