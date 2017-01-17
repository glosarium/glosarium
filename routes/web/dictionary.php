<?php

Route::group(['prefix' => 'dictionary', 'namespace' => 'Dictionary'], function(){
    Route::get('/', 'NationalController@index')->name('dictionary.national.index');
    Route::get('/national/{word}', 'NationalController@show')->name('dictionary.national.show');
});
