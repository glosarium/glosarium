<?php

Route::group(['prefix' => 'glosarium', 'namespace' => 'Glosarium'], function(){
    // category
    Route::get('category', 'CategoryController@index')->name('glosarium.category.index');
    Route::get('category/{slug}', 'CategoryController@show')->name('glosarium.category.show');

    // word
    Route::get('/', 'WordController@index')->name('glosarium.word.index');
    Route::get('{category}/{slug}', 'WordController@show')->name('glosarium.word.show');
});
