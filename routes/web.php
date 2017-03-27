<?php

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

Route::get('api', 'PageController@api')->name('page.api.index');

Route::get('/contact', 'ContactController@form')->name('contact.form');
Route::post('/contact/send', 'ContactController@send')->name('contact.post');

Route::get('/external', 'LinkController@external')->name('link.external');

Route::get('/{hash}', 'LinkController@redirect')->name('link.redirect')
    ->where('hash', '[A-Za-z0-9]+');
