<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::resource('glosarium/word', 'Glosarium\WordController', [
        'only' => ['index', 'edit', 'update', 'create', 'store'],
    ]);

    Route::resource('glosarium/category', 'Glosarium\CategoryController', [
        'only' => ['index', 'edit', 'update', 'destroy'],
    ]);

    Route::get('user/history', 'UserController@history')->name('user.history');
    Route::get('user/{id}/restore', 'UserController@restore')->name('user.restore');
    Route::resource('user', 'UserController', [
        'only' => ['index', 'edit', 'update', 'destroy'],
    ]);
});
