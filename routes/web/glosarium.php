<?php
Route::group(['namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('kata/kontribusi', 'WordController@contribute')->name('word.contribute');
        Route::get('kata/ajukan', 'WordController@create')->name('word.create');
        Route::post('kata/ajukan', 'WordController@store')->name('word.store');
        Route::get('kata/pesan/{id}', 'WordController@mail')->name('word.mail');
        Route::get('kata/{slug}/sunting', 'WordController@edit')->name('word.edit');
        Route::put('kata/{slug}/sunting', 'WordController@update')->name('word.update');
        Route::get('kata/{slug}/hapus', 'WordController@destroy')->name('word.destroy');
    });

    // sitemap
    Route::get('sitemap.xml', 'SitemapController@index')->name('sitemap.index');
    Route::get('sitemap/{slug}.xml', 'SitemapController@category')->name('sitemap.category');

    // category
    Route::get('kategori', 'CategoryController@index')->name('category.index');
    Route::get('kategori/{slug}', 'CategoryController@show')->name('category.show');

    // word
    Route::get('kata', 'WordController@index')->name('word.index');
    Route::get('{category}/{slug}', 'WordController@show')->name('word.show');
});
