<?php

namespace App\Http\Controllers;

use Alert;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->filter(request(['month', 'year']))->paginate(10);
        $comments = Comment::all();
        return view('posts.index', compact('posts', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['title'] = strtolower(request('title'));
        $this->validate($request, [
            'title' => 'required|unique:posts|max:100',
            'ingredients' => 'required',
            'directions' => 'required',
            'image' => 'file|max:40000|mimes:jpeg,gif,png,svg,bmp',
        ]);
        $path = empty(request('image')) ? null : $request->file('image')->store(auth()->id(), 's3');
        Post::create([
            'title' => request('title'),
            'ingredients' => request('ingredients'),
            'directions' => request('directions'),
            'slug' => str_slug($request->title, '-'),
            'user_id' => auth()->id(),
            'image' => $path,
        ])->tags()->attach($request->tag);
        Alert::success('Recipe has been published');
        // session()->flash('success', 'Recipe has been published');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request['title'] = strtolower(request('title'));
        $this->validate($request, [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($post->id),
                'max:100',
            ],
            'ingredients' => 'required',
            'directions' => 'required',
            'image' => 'file|max:40000|mimes:jpeg,gif,png,svg,bmp',
        ]);
        if (!empty(request('image'))) {
            if(!is_null($post->image)) {
                $file = $post->image;
                Storage::disk('s3')->delete($file);
            }
            $path = $request->file('image')->store(auth()->id(), 's3');
            $post->image = $path;
        }
            $post->title = request('title');
            $post->ingredients = request('ingredients');
            $post->directions = request('directions');
            $post->slug = str_slug($request->title, '-');
            $post->tags()->detach();
            $post->tags()->attach($request->tag);
            $post->save();

        Alert::success('Recipe successfully updated');      
        // session()->flash('success', 'Recipe updates successful');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        Alert::success('Recipe successfully deleted');  
        return redirect()->route('posts.index');
    }
}
