<?php

Route::group(['prefix' => 'dictionary', 'namespace' => 'Dictionary'], function(){
    Route::get('/', 'NationalController@getIndex')->name('dictionary.national.index');
});
