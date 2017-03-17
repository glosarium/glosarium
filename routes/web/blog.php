<?php

Route::group(['prefix' => 'blog', 'as' => 'blog.', 'namespace' => 'Blog'], function () {
    Route::resource('/', 'PostController', [
        'only' => ['index', 'show'],
    ]);
});
