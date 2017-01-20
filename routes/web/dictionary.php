<?php

Route::group(['prefix' => 'dictionary', 'namespace' => 'Dictionary', 'as' => 'dictionary.'], function () {

    Route::get('/', 'NationalController@index')->name('national.index');
    Route::post('search', 'NationalController@search')->name('national.search');
    Route::get('latest', 'NationalController@latest')->name('national.latest');

    Route::get('/{word}', 'NationalController@show')->name('national.show');

});
