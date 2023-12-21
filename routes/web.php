<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name("register");
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name("login");
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('post.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('post.likes.destroy');

Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::get('/posts/{user:username}', [PostController::class , 'index'])->name('post.index'); 
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/posts/{user:username}/{post}', [PostController::class, 'show'])->name('post.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

Route::post('/posts/{user:username}/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follows.store');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.follows.destroy');