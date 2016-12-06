<?php

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth'], function () {
    Route::get('password', 'PasswordController@form')->name('user.password.form');
    Route::post('password', 'PasswordController@update')->name('user.password.update');
});
