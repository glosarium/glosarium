<?php
Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // category
    Route::get('kategori', 'CategoryController@index')->name('category.index');
    Route::get('kategori/total', 'CategoryController@total')->name('category.total');
    Route::get('kategori/semua', 'CategoryController@all')->name('category.all');
    Route::get('kategori/{slug}', 'CategoryController@show')->name('category.show');

    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');

    // word
    Route::get('glosarium', 'WordController@index')->name('word.index');
    Route::get('total', 'WordController@total')->name('word.total');
    Route::get('tambah', 'WordController@create')->name('word.create');
    Route::post('simpan', 'WordController@store')->name('word.store');
    Route::post('sama', 'WordController@sameWord')->name('word.same');
    Route::post('terbaru', 'WordController@latest')->name('word.latest');
    Route::get('{category}/{slug}', 'WordController@show')->name('word.show');
});
