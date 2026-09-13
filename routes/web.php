<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;

use App\Livewire\OfferIndex;
use App\Livewire\OfferCreate;
use App\Livewire\OfferShow;

use App\Http\Controllers\JobOfferPdfController;



Route::redirect('/', 'dashboard');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])->name('google.callback');

Route::middleware(['auth'])->group(function(){

    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/offers', OfferIndex::class)->name('offers.index');
    Route::get('/offers/create', OfferCreate::class)->name('offers.create');

    Route::get('/offers/{offer}', OfferShow::class)->name('offers.show');
    Route::get('/offers/{offer}/download/{type}', [JobOfferPdfController::class, 'download'])->name('offers.download');

});

require __DIR__.'/auth.php';
