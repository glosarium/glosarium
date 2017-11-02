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

Route::get('/', 'HomeController')->name('home');

// contact controller
Route::get('kontak', 'ContactController@form')->name('contact.form');
Route::get('kontak/pesan/{id}', 'ContactController@show')->name('contact.show');
Route::post('kontak/kirim', 'ContactController@send')->name('contact.post');

// static pages
Route::get('tentang-kami', 'PageController@about')->name('page.about');