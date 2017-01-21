<?php

Route::group(['prefix' => 'kamus', 'namespace' => 'Dictionary', 'as' => 'dictionary.'], function () {
    // word route
    Route::post('cari', 'NationalController@search')->name('national.search');
    Route::get('terbaru', 'NationalController@latest')->name('national.latest');
    Route::get('/{word?}', 'NationalController@index')->name('national.index');
});
