<?php

Route::resource('posts', 'PostController');
Route::post('posts/{post}/comments', 'CommentController@store');
Route::get('posts/tags/{tag}', 'TagController@index');
Route::get('/', function () {
    return view('home');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

