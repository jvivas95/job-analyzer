<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::view('/dashboard', 'welcome');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])->name('google.callback');

Route::middleware(['auth'])->group(function(){

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

});

require __DIR__.'/auth.php';
