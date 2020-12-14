<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'index']);

// Route::get('auth/register', function () {
//     return view('auth.home');
// });

Route::get('/', function () {
    return view('layouts.app');
});

