<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        $request->request->add([
            "username" => Str::slug($request->username)
        ]);

        $this->validate($request, [
            "name" => ["required", "max:30"],
            "username" => ["required", "min:3", "max:20", "regex:/^[a-z0-9-]+$/", "unique:users"],
            "email" => ["required", "max:60","email", "unique:users"],
            "password" => ["required", "min:6", "max:30", "confirmed"]
        ]);

        User::create([
            'name' => $request->name,
            "username" => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // auth()->attempt([
        //     'email' => $request->email,
        //     "password" => $request->password
        // ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('post.index', auth()->user()->username);
    }
}
