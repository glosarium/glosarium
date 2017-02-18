<?php

Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
    Route::post('subscribe', 'SubscriberController@subscribe')->name('newsletter.subscriber.subscribe');
});
