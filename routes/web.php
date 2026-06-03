<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Customer\HomePage;
use App\Livewire\Admin\AdminDashboard;

Route::get('/', HomePage::class)->name('home');
Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


require __DIR__.'/settings.php';
