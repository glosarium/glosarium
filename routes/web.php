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
Route::group(['middleware' => 'auth', 'as' => 'contact.'], function(){
    Route::get('kontak/pesan-masuk', 'ContactController@index')->name('index');
    Route::get('kontak/{id}/hapus', 'ContactController@destroy')->name('destroy');
    Route::get('kontak/{id}/balas', 'ContactController@reply')->name('reply');
    Route::post('kontak/{id}/balas', 'ContactController@submit')->name('submit');
});
Route::get('kontak', 'ContactController@form')->name('contact.form');
Route::get('kontak/pesan/{id}', 'ContactController@show')->name('contact.show');
Route::post('kontak/kirim', 'ContactController@send')->name('contact.post');

// static pages
Route::get('tentang-kami', 'PageController@about')->name('page.about');

// blog
Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');

Horizon::auth(function ($request) {
    if (\Auth::check()) {
        return \Auth::user()->type === 'admin';
    }

    return false;
});