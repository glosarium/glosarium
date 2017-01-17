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

Route::get('kbbi/{word}', function($word){
    $dictionary = new App\Libraries\Dictionary($word);

    dd($dictionary->spell(), $dictionary->descriptions());
});

Route::get('attach/{category}', function($category){
    \App\Glosarium\Word::select('locale')->whereCategoryId($category)->chunk(1000, function($glosariums){
        foreach ($glosariums as $glosarium) {
            $locales = array_map(function ($word) {
                return trim(strtolower($word));
            }, preg_split("/[\s,\/;\(\)]+/", $glosarium->locale));

            dispatch(new \App\Jobs\Glosarium\Dictionary($locales, 'id'));
            // echo sprintf('Dispatching %s...', $glosarium->locale);
        }
    });

    return ['ok'];
});

Auth::routes();

Route::get('contact', 'ContactController@form')->name('contact.form');
Route::post('contact', 'ContactController@send')->name('contact.post');

Route::get('/{link}', 'LinkController@redirect')->name('link.redirect');

Route::get('/', 'PageController@index')->name('index');
