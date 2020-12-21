<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return 'ok';
});
Auth::routes();
// API

Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('/register', [App\Http\Controllers\UserController::class, 'register']);

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->middleware('auth:api');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'details']);

Route::post('/posts/{id}/comments', [App\Http\Controllers\CommentController::class, 'store'])->middleware('auth:api');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->middleware('auth:api');
Route::delete('/profile/{post}', [App\Http\Controllers\ProfileController::class, 'destroy'])->middleware('auth:api');
Route::put('/profile/{post}', [App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth:api');
