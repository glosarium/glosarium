<?php

Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
    Route::get('sitemap/{slug}.xml', 'SitemapController@category')->name('sitemap.category');

    // category
    Route::get('kategori', 'CategoryController@index')->name('category.index');
    Route::get('kategori/{slug}', 'CategoryController@show')->name('category.show');

    // word
    Route::get('/{category}/{slug}', 'WordController@show')->name('word.show');
});
