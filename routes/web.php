<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');

    // dd(auth()->user()->posts);
    
    return redirect('posts');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store']);

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'details']);

Route::post('/posts/{id}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::delete('/profile/{post}', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('post.destroy');
Route::put('/profile/{post}', [App\Http\Controllers\ProfileController::class, 'update'])->name('post.update');

// API

Route::post('/api/login', 'App\Http\Controllers\Api\UserController@login');
Route::post('/api/register', 'App\Http\Controllers\Api\UserController@register');

Route::get('/api/home', [App\Http\Controllers\Api\HomeController::class, 'index']);

Route::get('/api/posts', 'App\Http\Controllers\Api\PostController@index');
Route::post('/api/posts', [App\Http\Controllers\Api\PostController::class, 'store']);

Route::get('/api/posts/{id}', [App\Http\Controllers\Api\PostController::class, 'details']);

Route::post('/api/posts/{id}/comments', [App\Http\Controllers\Api\CommentController::class, 'store']);

Route::get('/api/profile', [App\Http\Controllers\Api\ProfileController::class, 'index']);
Route::delete('/api/profile/{post}', [App\Http\Controllers\Api\ProfileController::class, 'destroy']);
Route::put('/api/profile/{post}', [App\Http\Controllers\Api\ProfileController::class, 'update']);
