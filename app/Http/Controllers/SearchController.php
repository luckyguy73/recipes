<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request, Post $post)
    {
        $posts = Post::where('title', 'LIKE', '%' . request('search') . '%')
            ->orWhere('directions', 'LIKE', '%' . request('search') . '%')
            ->paginate(10);
        return view('posts.search', compact('posts'));
    }
}
