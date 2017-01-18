<?php

Route::group(['namespace' => 'User'], function () {
    Route::get('notification', 'NotificationController@index')->name('user.notification.index');
});
