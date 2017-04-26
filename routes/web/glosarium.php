<?php

Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
    Route::get('sitemap/{slug}.xml', 'SitemapController@category')->name('sitemap.category');

    // favorite
    Route::post('favorite', 'FavoriteController@favorite')->name('favorite.post');

    // description
    Route::post('description/up', 'DescriptionController@up')->name('description.up');
    Route::post('description/down', 'DescriptionController@down')->name('description.down');

    // category
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::get('category/total', 'CategoryController@total')->name('category.total');
    Route::get('glosarium/category/all', 'CategoryController@all')->name('category.all');
    Route::get('glosarium/category/paginate', 'CategoryController@paginate')->name('category.paginate');
    Route::get('glosarium/category/show', 'CategoryController@show')->name('category.show');

    // word
    Route::get('/', 'WordController@index')->name('word.index');
    Route::get('glosarium/word/paginate', 'WordController@paginate')->name('word.paginate');
    Route::get('word/total', 'WordController@total')->name('word.total');

    // contribute new word
    Route::get('word/propose', 'WordController@create')->name('word.create');
    Route::post('word/store', 'WordController@store')->name('word.store');

    Route::get('glosarium/word/similar', 'WordController@similar')->name('word.similar');
    Route::get('glosarium/word/latest', 'WordController@latest')->name('word.latest');
    Route::get('glosarium/word/show', 'WordController@show')->name('word.show');
    Route::get('word/category/{slug}', 'WordController@category')->name('word.category');
});
