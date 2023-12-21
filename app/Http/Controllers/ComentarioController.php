<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(User $user, Post $post, Request $request) 
    {
        $this->validate($request, [
            'comentario' => 'required|max:400'
        ]);

        $request->user()->comentarios()->create([
            'comentario' => $request->comentario,
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);

        return back()->with('mensaje', 'Comentado Realizado Correctamente');
    }
}
