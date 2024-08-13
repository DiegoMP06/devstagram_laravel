<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', [
            "user" => $user,
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:500'],
            'image' => ['required'],
        ], [
            'title.required' => 'El tiúlo es obligatorio.',
            'title.max' => 'El tiúlo no debe superar los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no debe superar los 500 caracteres.',
            'image.required' => 'La imagen es obligatoria.',
        ]);


        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image
        ]);

        return redirect()->route('posts.index', auth()->user());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Post $post)
    {
        $image = $post->image;
        $post->delete();
        Storage::delete('uploads/'. $image);
        
        return redirect()->route('posts.index', auth()->user());
    }
}
