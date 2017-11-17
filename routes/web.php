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

Route::group(['middleware' => 'auth'], function(){
    Route::group(['as' => 'contact.'], function(){
        // contact controller
        Route::get('kontak/pesan-masuk', 'ContactController@index')->name('index');
        Route::get('kontak/{id}/hapus', 'ContactController@destroy')->name('destroy');
        Route::get('kontak/{id}/balas', 'ContactController@reply')->name('reply');
        Route::post('kontak/{id}/balas', 'ContactController@submit')->name('submit');
    });

    Route::group(['namespace' => 'Dictionary', 'as' => 'dictionary.'], function(){
        // dictionary
        Route::get('kamus/kata', 'WordController@index')->name('word.index');
        Route::get('kamus/{entry}/ubah', 'WordController@destroy')->name('word.edit');
        Route::put('kamus/{entry}/ubah', 'WordController@update')->name('word.update');
        Route::get('kamus/{entry}/hapus', 'WordController@destroy')->name('word.destroy');
    });
});

// dictionary
Route::get('/kamus/entri/{entry}', 'Dictionary\WordController@show')->name('dictionary.word.show');

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