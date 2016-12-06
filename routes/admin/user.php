<?php

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User (Admin) routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your API!
|
 */

Route::resource('user', 'UserController', [
    'names' => [
        'index'   => 'admin.user.index',
        'create'  => 'admin.user.create',
        'store'   => 'admin.user.store',
        'show'    => 'admin.user.show',
        'edit'    => 'admin.user.edit',
        'update'  => 'admin.user.update',
        'destroy' => 'admin.user.destroy',
    ],
]);

Route::get('password', 'PasswordController@form')->name('admin.user.password.form');
Route::post('password', 'PasswordController@update')->name('admin.user.password.update');
