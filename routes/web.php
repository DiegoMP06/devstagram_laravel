<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function() {

    Route::get('/', HomeController::class)
        ->name('home');

    Route::post('/images', [ImageController::class, 'store'])
        ->name('images.store');

    Route::resource('/posts/{post}/likes', LikeController::class)
        ->only(['store', 'destroy'])
        ->names([
            'store' => 'posts.likes.store', 
            'destroy' => 'posts.likes.destroy'
        ]);

    Route::resource('/{user:username}/posts', PostController::class)
        ->except(['show', 'index']);

    Route::post('/{user:username}/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::resource('/{user:username}/followers', FollowerController::class)
        ->only(['store', 'destroy'])
        ->names([
            'store' => 'users.follows.store', 
            'destroy' => 'users.follows.destroy'
        ]);
});

Route::resource('/{user:username}/posts', PostController::class)
    ->only(['show', 'index']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
