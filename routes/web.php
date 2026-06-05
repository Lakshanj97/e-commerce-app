<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Customer\HomePage;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\CompanyProfile\CompanyProfile;

Route::get('/', HomePage::class)->name('home');

Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
Route::get('/admin/company-profile', CompanyProfile::class)->name('admin.company-profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});


require __DIR__.'/settings.php';
