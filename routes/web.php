<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/auth/activate', 'Auth\ActivationController')->name('auth.activate');

Route::get('/home', 'HomeController@index')->name('home');
