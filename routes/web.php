<?php

use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
});

Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('user.register');
    })->name('register');

    Route::post('/', [UserController::class, 'register']);
});

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('user.login');
    })->name('login');

    Route::post('/', [UserController::class, 'login']);
});


Route::post('/process-input', [UrlController::class, 'handleInput'])->name('original_url');

Route::get('/{code}', [UrlController::class, 'redirectUrl']);
