<?php

Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter', 'as' => 'newsletter.'], function () {
    Route::post('subscribe', 'SubscriberController@subscribe')->name('subscriber.subscribe');
    Route::get('subscribe/confirm', 'SubscriberController@confirm')->name('subscriber.confirm');
    Route::get('unsubscribe', 'SubscriberController@unsubscribe')->name('subscriber.unsubscribe');
});
