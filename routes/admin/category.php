<?php

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Category (Admin) routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "admin" middleware group. Enjoy building your API!
|
 */

Route::resource('category', 'CategoryController', [
    'names' => [
        'index'   => 'admin.category.index',
        'create'  => 'admin.category.create',
        'store'   => 'admin.category.store',
        'show'    => 'admin.category.show',
        'edit'    => 'admin.category.edit',
        'update'  => 'admin.category.update',
        'destroy' => 'admin.category.destroy',
    ],
]);
