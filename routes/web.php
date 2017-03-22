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
Route::get('/home', 'PostController@index')->name('home');
Route::get('/', 'PostController@index');
Route::post('/e/p', 'WebhookController@handle');
Route::post('post/like', 'LikeController@handlePost');
Route::post('comment/like', 'LikeController@handleComment');




