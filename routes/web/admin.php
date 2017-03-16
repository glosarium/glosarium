<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::resource('glosarium/word', 'Glosarium\WordController', [
        'only' => ['index', 'edit', 'update'],
    ]);

    Route::resource('glosarium/category', 'Glosarium\CategoryController', [
        'only' => ['index', 'edit'],
    ]);

    Route::resource('user', 'UserController', [
        'only' => ['index'],
    ]);
});
