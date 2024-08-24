<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('post', compact('posts'));
    }

    public function view()
    {
        $posts = Post::all();
        return view('allPosts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = Post::all();
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post -> title = $request -> title;
        $post -> body = $request -> body;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = Storage::putFile('public/images', $request -> file('image'));
            $new_path = str_replace('public/', '', $path);
            $post -> image_url = $new_path;
        }
        else{
            $post -> image_url = null;
        }
        $post -> save();
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if($post->image_url){
            Storage::delete('public/'.$post->image_url);
        }
        $post -> delete();
        return redirect()->route('posts.index');
    }
}