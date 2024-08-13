<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Post $post, Request $request)
    {
        $request->validate([
            'comment' => 'required|max:400'
        ], [
            'comment.required' => 'El campo comentario es obligatorio',
            'comment.max' => 'El campo comentario no debe superar los 400 caracteres'
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'post_id' => $post->id
        ]);

        return back()->with('message', 'Comentado Realizado Correctamente');
    }
}
