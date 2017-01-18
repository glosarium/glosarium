<?php

Route::group(['namespace' => 'User'], function () {
    // notification
    Route::get('notification', 'NotificationController@index')->name('user.notification.index');

    // password
    Route::get('user/password', 'PasswordController@form')->name('user.password.form');
    Route::post('user/password', 'PasswordController@update')->name('user.password.update');
});
