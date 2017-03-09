<?php

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {
    // notification
    Route::get('notification', 'NotificationController@index')->name('notification.index');
    Route::get('notification/paginate', 'NotificationController@paginate')->name('notification.paginate');
    Route::get('notification/read', 'NotificationController@read')->name('notification.read');

    // password
    Route::get('user/password', 'PasswordController@form')->name('password.form');
    Route::post('user/password', 'PasswordController@update')->name('password.update');

    Route::group(['prefix' => 'user/glosarium', 'namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
        Route::put('update/field', 'CategoryController@updateField')->name('category.updateField');
    });
});

// user
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('total', 'UserController@total')->name('user.total');
});
