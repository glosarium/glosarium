<?php

Auth::routes();
Route::post('user/email', 'Auth\RegisterController@email')->name('user.email');

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {
    // notification
    Route::get('notification', 'NotificationController@index')->name('notification.index');
    Route::get('notification/paginate', 'NotificationController@paginate')->name('notification.paginate');
    Route::get('notification/read', 'NotificationController@read')->name('notification.read');

    // account
    Route::get('account/token', 'AccountController@token')->name('account.token');

    // password
    Route::get('user/password', 'PasswordController@form')->name('password.form');
    Route::post('user/password', 'PasswordController@update')->name('password.update');
});

// user
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('total', 'UserController@total')->name('user.total');
});
