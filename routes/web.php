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

Route::get('/tambah-kata', 'WordController@create')->name('word.create');
Route::post('/simpan-kata', 'WordController@store')->name('word.store');
Route::get('/api', 'WordController@api')->name('word.api');
Route::get('/acak', 'WordController@random')->name('word.random');
Route::get('cari', 'WordController@search')->name('word.search');
Route::get('/', 'WordController@index')->name('index');

Route::get('sitemap/{category}.xml', 'SitemapController@category')->name('sitemap.category');
Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');

Route::get('/kategori/{category}', 'WordCategoryController@show')->name('word.category.show');
Route::get('/kategori', 'WordCategoryController@index')->name('word.category');

Route::get('/{category}/{word}', 'WordController@show')->name('word.detail');

Route::get('/{link}', 'LinkController@show')->name('link.show');
