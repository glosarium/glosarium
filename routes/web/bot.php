<?php

Route::group(['prefix' => 'bot', 'as' => 'bot.', 'namespace' => 'Bot'], function () {
    Route::post('line/hook', 'LineController@hook')->name('line.hook');
});
