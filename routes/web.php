<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobOfferPdfController;
use App\Livewire\OfferCreate;
use App\Livewire\OfferIndex;
use App\Livewire\OfferShow;
use App\Livewire\ProfileEdit;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'dashboard');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])->name('google.callback');

Route::middleware(['auth'])->group(function () {

    Route::get('dashboard', DashboardController::class)
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/offers', OfferIndex::class)->name('offers.index');
    Route::get('/offers/create', OfferCreate::class)->name('offers.create');

    Route::get('/offers/{offer}', OfferShow::class)->name('offers.show');
    Route::get('/offers/{offer}/download/{type}', [JobOfferPdfController::class, 'download'])->name('offers.download');
    Route::post('/job-offers/{offer}/generate-pdf', [JobOfferPdfController::class, 'generate'])->name('job-offers.generate-pdf');

    Route::get('/profile-edit', ProfileEdit::class)->name('profile.edit');

});

require __DIR__.'/auth.php';
