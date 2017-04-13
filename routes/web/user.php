<?php

Auth::routes();
Route::post('user/email', 'Auth\RegisterController@email')->name('user.email');

Route::any('user', 'UserController@index')
    ->name('user')
    ->middleware('auth');

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {
    // glosarium
    Route::group(['prefix' => 'user/glosarium', 'namespace' => 'Glosarium', 'as' => 'glosarium.'], function () {
        // category
        Route::get('category/all', 'CategoryController@all')->name('category.all');

        // word
        Route::get('word/paginate', 'WordController@paginate')->name('word.paginate');
        Route::get('word/moderation', 'WordController@moderation')->name('word.moderation');
        Route::post('word/store', 'WordController@store')->name('word.store');
        Route::put('word/update', 'WordController@update')->name('word.update');
        Route::get('word/{slug}', 'WordController@show')->name('word.show');
    });

    // notification
    Route::get('notification', 'NotificationController@index')->name('notification.index');
    Route::get('notification/paginate', 'NotificationController@paginate')->name('notification.paginate');
    Route::get('notification/read', 'NotificationController@read')->name('notification.read');

    // account
    Route::get('dashboard', 'AccountController@dashboard')->name('account.dashboard');
    Route::get('account/token', 'AccountController@token')->name('account.token');

    // password
    Route::get('user/password', 'PasswordController@form')->name('password.form');
    Route::put('user/password', 'PasswordController@update')->name('password.update');
});

// user
Route::group(['prefix' => 'user', 'namespace' => 'User', 'as' => 'user.'], function () {
    Route::get('total', 'UserController@total')->name('user.total');
});
