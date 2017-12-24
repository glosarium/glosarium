<?php

Auth::routes();
Route::get('masuk', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('daftar', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('konfirmasi', 'Auth\ConfirmationController@confirm')->name('user.confirm');
Route::get('profil/{username}', 'User\ProfileController@show')->name('user.profile.show');

Route::group(['middleware' => 'auth'], function () {
    Route::post('kirim-konfirmasi', 'Auth\ConfirmationController@resend')->name('user.confirmation.resend');
    Route::get('keluar', 'Auth\LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {
    // profile
    Route::get('profil', 'ProfileController@edit')->name('profile.edit');
    Route::put('profil', 'ProfileController@update')->name('profile.update');

    // password
    Route::get('sandi-lewat', 'PasswordController@form')->name('password.edit');
    Route::post('user/password', 'PasswordController@update')->name('password.update');

    Route::get('kontributor', 'UserController@index')->name('index');

    Route::get('glosarium/kategori', 'Glosarium\CategoryController@index')->name('glosarium.category.index');
});
