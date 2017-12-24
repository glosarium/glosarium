<?php

Route::group(['prefix' => 'nawala', 'namespace' => 'Newsletter', 'as' => 'newsletter.'], function () {
    Route::post('langganan', 'SubscriberController@subscribe')->name('subscriber.subscribe');
    Route::get('konfirmasi', 'SubscriberController@confirm')->name('subscriber.confirm');
    Route::get('hentikan', 'SubscriberController@unsubscribe')->name('subscriber.unsubscribe');
});
