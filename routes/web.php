<?php

use App\Post;
use Illuminate\Http\Request;

Auth::routes();
Route::resource('posts', 'PostController');
Route::post('search', function (Request $request) {
	$posts = Post::where('title', 'LIKE', '%' . request('search') . '%')
		->orWhere('directions', 'LIKE', '%' . request('search') . '%')
		->paginate(10);
	return view('posts.search', compact('posts'));
});
Route::post('posts/{post}/comments', 'CommentController@store');
Route::get('posts/tags/{tag}', 'TagController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('home');
});
Route::post('/e/p', 'WebhookController@handle');




