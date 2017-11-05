<?php
Auth::routes();
Route::get('masuk', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('daftar', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('profil/{username}', 'User\ProfileController@show')->name('user.profile.show');
Route::get('keluar', 'Auth\LoginController@logout')->name('logout');

// register
Route::get('user/confirm', 'Auth\ConfirmController')->name('user.confirm');

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {    
    // profile
    Route::get('profil', 'ProfileController@edit')->name('profile.edit');
    Route::put('profil', 'ProfileController@update')->name('profile.update');

    // password
    Route::get('sandi-lewat', 'PasswordController@form')->name('password.edit');
    Route::post('user/password', 'PasswordController@update')->name('password.update');
});
