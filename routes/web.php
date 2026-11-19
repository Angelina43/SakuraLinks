<?php

use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.main');
})->name('home');

Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('user.register');
    })->name('register.index');

    Route::post('/', [UserController::class, 'register'])->name('register');
});

Route::prefix('login')->group(function () {
    Route::get('/', function () {
        return view('user.login');
    })->name('login.index');

    Route::post('/', [UserController::class, 'login'])->name('login');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/process-input', [UrlController::class, 'handleInput'])->name('original_url');

Route::get('/{code}', [UrlController::class, 'redirectUrl']);
