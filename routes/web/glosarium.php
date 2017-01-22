<?php

Route::group(['prefix' => 'glosarium', 'namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // category
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::get('category/total', 'CategoryController@total')->name('category.total');
    Route::get('category/{slug}', 'CategoryController@show')->name('category.show');

    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');

    // word
    Route::get('/', 'WordController@index')->name('word.index');
    Route::get('total', 'WordController@total')->name('word.total');
    Route::get('{category}/{slug}', 'WordController@show')->name('word.show');
});
