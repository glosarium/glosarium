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

Route::get('/group', function () {
    $words = \App\Glosarium\Word::select('origin', 'locale', 'category_id')
        ->where('origin', 'LIKE', request('q') . '%')
        ->orWhere('locale', 'LIKE', request('q') . '%')
    // ->sort(request('q'))
        ->with('category')
        ->groupBy('locale')
        ->take(10)
        ->get();

    $words->makeHidden('url')
        ->makeHidden('short_url')
        ->makeHidden('edit_url')
        ->makeHidden('updated_diff');

    return $words;

    return view('user.password.form')->withTitle('ok');
});

Route::get('api', 'ApiController@index')->name('api.index');

Route::get('/contact', 'ContactController@form')->name('contact.form');
Route::post('/contact/send', 'ContactController@send')->name('contact.post');

Route::get('/external', 'LinkController@external')->name('link.external');

Route::get('/{hash}', 'LinkController@redirect')->name('link.redirect')
    ->where('hash', '[A-Za-z0-9]+');
