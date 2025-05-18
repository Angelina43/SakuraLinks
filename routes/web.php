<?php

use Illuminate\Support\Facades\Route;

//Route::get('/form', function () {
//    return view('form');
//});
//Route::post('/process-input', [\App\Http\Controllers\UrlController::class, 'handleInput'])->name('example');

Route::get('/SakuraLinks', function () {
    return view('SakuraLinks');
});

Route::post('/process-input', [\App\Http\Controllers\UrlController::class, 'handleInput'])->name('original_url');

Route::get('/random-url', [\App\Http\Controllers\UrlController::class, 'randomUrl']);
