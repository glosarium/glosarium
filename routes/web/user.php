<?php
Auth::routes();
Route::get('profil/{username}', 'User\ProfileController@show')->name('user.profile.show');
Route::get('keluar', 'Auth\LoginController@logout')->name('logout');

// register
Route::get('user/confirm', 'Auth\ConfirmController')->name('user.confirm');

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'as' => 'user.'], function () {    
    // profile
    Route::get('edit-profile', 'ProfileController@edit')->name('profile.edit');
    Route::put('update-profile', 'ProfileController@update')->name('profile.update');

    // password
    Route::get('user/password', 'PasswordController@form')->name('password.form');
    Route::post('user/password', 'PasswordController@update')->name('password.update');
});
