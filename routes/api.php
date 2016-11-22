<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::get('/', function () {
    return [
        'status'  => true,
        'content' => [
            'name'        => config('app.name'),
            'description' => config('app.description'),
            'author'      => 'Yugo (dedy.yugo.purwanto@gmail.com)',
            'website'     => config('app.url'),
        ],
    ];
});

Route::get('word/search', 'API\WordController@search');
