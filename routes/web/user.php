<?php

Auth::routes();
Route::get('profile/{username}', 'User\ProfileController@show')->name('user.profile.show');
Route::get('dashboard', 'User\DashboardController')->name('user.dashboard');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// register
Route::get('user/confirm', 'Auth\ConfirmController')->name('user.confirm');

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
