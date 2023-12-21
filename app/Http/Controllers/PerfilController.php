<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add([
            "username" => Str::slug($request->username)
        ]);

        $this->validate($request, [
            'username' => [
                "required", 
                "min:3", "max:20", 
                "regex:/^[a-z0-9-]+$/", 
                "unique:users,username," . auth()->user()->id, 
                "not_in:twitter,editar-perfil,posts"
            ],
            'email' => [
                'required',
                "max:60",
                "email",
                "unique:users,email," . auth()->user()->id, 
            ]
        ]);

        if($request->password_actual && !auth()->attempt(['email' => auth()->user()->email, 'password' => $request->password_actual])) {
            return back()->with('password', 'Password Incorrecto');
        }

        if($request->password_actual) {
            $this->validate($request, [
                'password_nuevo' => ["required", "min:6", "max:30"]
            ]);
        }

        $usuario = User::find(auth()->user()->id);

        if($request->imagen) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
        
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);

            if($usuario->imagen) {
                $imagen_path = public_path('perfiles/' . $usuario->imagen);

                if(File::exists($imagen_path)) unlink($imagen_path);   
            }
        }

        $usuario ->username = $request->username;
        $usuario->email = $request->email;
        $usuario->password = $request->password_nuevo ? Hash::make($request->password_nuevo) : $usuario->password;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        return redirect()->route('post.index', $usuario->username);
    }
}