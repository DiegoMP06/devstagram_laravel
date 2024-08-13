<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        $user->followers()->attach(auth()->user()->id);
        
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Follower $follower)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
