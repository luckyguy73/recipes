<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function handlePost()
    {
        $post = Post::find(request('post'));
        $post->like();
        return response(count($post->likes));
    }

    public function handleComment()
    {
        $comment = Comment::find(request('comment'));
        $comment->like();
        return response(count($comment->likes));
    }
}
