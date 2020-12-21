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
