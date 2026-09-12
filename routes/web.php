<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

Route::redirect('/', 'dashboard');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])->name('google.callback');

Route::middleware(['auth'])->group(function(){

    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

});

require __DIR__.'/auth.php';
