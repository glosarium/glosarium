<?php
<<<<<<< HEAD

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {
    // notification
    Route::get('notification', 'NotificationController@index')->name('notification.index');

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
=======
>>>>>>> 4e0d0dba7ef5d116f29f30dfe374ad68d30d3046
