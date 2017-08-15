<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/auth/activate', 'Auth\ActivationController')->name('auth.activate');
Route::get('/auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');
Route::post('/auth/activate/resend', 'Auth\ActivationResendController@resend')->name('auth.activate.resend');

Route::get('/home', 'HomeController@index')->name('home');
