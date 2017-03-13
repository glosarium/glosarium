<?php

// sitemap
Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
Route::get('sitemap/{slug}.xml', 'SitemapController@category')->name('sitemap.category');

Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // category
    Route::get('kategori', 'CategoryController@index')->name('category.index');
    Route::get('kategori/total', 'CategoryController@total')->name('category.total');
    Route::get('kategori/semua', 'CategoryController@all')->name('category.all');
    Route::get('kategori/{slug}', 'CategoryController@show')->name('category.show');

    // category for admin
    Route::get('kategori/{slug}/ubah', 'CategoryController@edit')->name('category.edit');
    Route::put('kategori/{slug}/perbarui', 'CategoryController@update')->name('category.update');

    // word
    Route::get('/', 'WordController@index')->name('word.index');
    Route::get('total', 'WordController@total')->name('word.total');
    Route::get('tambah', 'WordController@create')->name('word.create');
    Route::post('simpan', 'WordController@store')->name('word.store');
    Route::post('sama', 'WordController@sameWord')->name('word.same');
    Route::post('terbaru', 'WordController@latest')->name('word.latest');
    Route::get('/{category}/{slug}', 'WordController@show')->name('word.show');
});

Route::group(['prefix' => 'api/glosarium', 'namespace' => 'Api\Glosarium', 'as' => 'api.'], function () {
    Route::get('category/all', 'CategoryController@all')->name('category.all');
    Route::resource('category', 'CategoryController');

    Route::get('word/category/{slug}', 'WordController@category')->name('glosarium.category');
    Route::resource('word', 'WordController');
});
