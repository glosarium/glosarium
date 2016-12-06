<?php

/*
|--------------------------------------------------------------------------
| Word Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/api', 'WordController@api')->name('word.api');
Route::get('/acak', 'WordController@random')->name('word.random');
Route::get('cari', 'WordController@search')->name('word.search');
Route::get('/', 'WordController@index')->name('index');

Route::get('sitemap/{category}.xml', 'SitemapController@category')->name('sitemap.category');
Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
