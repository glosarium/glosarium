<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */
Route::get('link', function () {
    $word = \App\Dictionary\Word::whereSlug('meme')->first();

    $hash = \Hashids::connection('dictionary')->encode($word->id);

    $link = \App\Link::whereType('dictionary')->whereHash($hash)->first();

    if (empty($link)) {
        $now = \Carbon\Carbon::now();

        $link = \App\Link::create([
            'hash'       => $hash,
            'type'       => 'dictionary',
            'url'        => route('dictionary.national.index', [$word->slug]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
});

Auth::routes();

Route::get('kontak', 'ContactController@form')->name('contact.form');
Route::post('kontak', 'ContactController@send')->name('contact.post');

Route::get('/{link}', 'LinkController@redirect')->name('link.redirect');

Route::get('/', 'PageController@index')->name('index');
