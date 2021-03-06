<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    // dd('here');

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

Route::get('/file', [App\Http\Controllers\FileUploadController::class, 'index'])->name('file.upload');

Route::get('/plugins', [App\Http\Controllers\PluginController::class, 'index'])->name('plugins');
Route::post('/plugins', [App\Http\Controllers\PluginController::class, 'store'])->name('plugins.upload');
Route::delete('/plugins/{plugin}', [App\Http\Controllers\PluginController::class, 'destroy'])->name('plugins.delete');
