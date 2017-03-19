<?php

Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
    Route::get('sitemap/{slug}.xml', 'SitemapController@category')->name('sitemap.category');

    // category
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::get('category/total', 'CategoryController@total')->name('category.total');
    Route::get('category/all', 'CategoryController@all')->name('category.all');
    Route::get('category/paginate', 'CategoryController@paginate')->name('category.paginate');
    Route::get('category/{slug}', 'CategoryController@show')->name('category.show');

    // word
    Route::get('/', 'WordController@index')->name('word.index');
    Route::get('word/paginate', 'WordController@paginate')->name('word.paginate');
    Route::get('word/total', 'WordController@total')->name('word.total');

    // contribute new word
    Route::get('word/propose', 'WordController@create')->name('word.create');
    Route::post('word/store', 'WordController@store')->name('word.store');

    Route::post('word/similar', 'WordController@similar')->name('word.similar');
    Route::post('word/latest', 'WordController@latest')->name('word.latest');
    Route::get('word/category/{slug}', 'WordController@category')->name('word.category');
    Route::get('/{category}/{slug}', 'WordController@show')->name('word.show');
});
