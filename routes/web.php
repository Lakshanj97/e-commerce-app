<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Customer\HomePage;

Route::get('/', HomePage::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
