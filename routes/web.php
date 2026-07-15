<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Customer\HomePage;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\CompanyProfile\CompanyProfile;
use App\Livewire\Admin\Categories\CategoryList;
use App\Livewire\Admin\Categories\AddCategory;
use App\Livewire\Admin\Product\AddProduct;
use App\Livewire\Admin\Product\ProductList;
use App\Livewire\Admin\Product\ProductView;

Route::get('/', HomePage::class)->name('home');

Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
Route::get('/admin/company-profile', CompanyProfile::class)->name('admin.company-profile');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/categories', CategoryList::class)
            ->name('categories.index');

        Route::get('/categories/create', AddCategory::class)
            ->name('categories.create');

        Route::get('/categories/{category}/edit', AddCategory::class)
            ->name('categories.edit');

        Route::get('/product/product-list', ProductList::class)
            ->name('product.index');

        Route::get('/product/add-product', AddProduct::class)
            ->name('product.add-product');

        Route::get('/product/{product}/edit', AddProduct::class)
            ->name('product.edit');

        Route::get('/product/{product}/view', ProductView::class)
            ->name('product.view');
    });


require __DIR__ . '/settings.php';
