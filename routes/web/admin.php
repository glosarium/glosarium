<?php

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('glosarium/word/moderation', 'Glosarium\WordController@moderation')->name('word.moderation');
    Route::resource('glosarium/word', 'Glosarium\WordController', [
        'only' => ['index', 'edit', 'update', 'create', 'store'],
    ]);

    Route::get('glosarium/category/paginate', 'Glosarium\CategoryController@paginate')->name('glosarium.category.paginate');
    Route::resource('glosarium/category', 'Glosarium\CategoryController', [
        'only' => ['index', 'edit', 'update', 'destroy'],
    ]);

    Route::get('user/paginate', 'UserController@paginate')->name('user.paginate');
    Route::get('user/history', 'UserController@history')->name('user.history');
    Route::get('user/{id}/restore', 'UserController@restore')->name('user.restore');
    Route::resource('user', 'UserController', [
        'only' => ['index', 'edit', 'update', 'destroy'],
    ]);

    Route::get('bot/keyword/paginate', 'Bot\KeywordController@paginate')->name('bot.keyword.paginate');
    Route::resource('bot/keyword', 'Bot\KeywordController', [
        'except' => ['show'],
    ]);
});
