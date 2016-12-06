<?php

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/kategori/{category}', 'WordCategoryController@show')->name('word.category.show');
Route::get('/kategori', 'WordCategoryController@index')->name('word.category');
