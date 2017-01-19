<?php

Route::group(['prefix' => 'dictionary', 'namespace' => 'Dictionary', 'as' => 'dictionary.'], function () {

    Route::get('/', 'NationalController@index')->name('national.index');
    Route::get('/{keyword?}', 'NationalController@show')->name('national.index');

});
