<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Brands\AddBrand;
use App\Livewire\Admin\Brands\BrandList;
use App\Livewire\Admin\Categories\AddCategory;
use App\Livewire\Admin\Categories\CategoryList;
use App\Livewire\Admin\CompanyProfile\CompanyProfile;
use App\Livewire\Admin\Orders\OrderList;
use App\Livewire\Admin\Orders\OrderView;
use App\Livewire\Admin\Product\AddProduct;
use App\Livewire\Admin\Product\ProductList;
use App\Livewire\Admin\Product\ProductView;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Customer\AboutUs;
use App\Livewire\Customer\Cart;
use App\Livewire\Customer\CategoryProducts;
use App\Livewire\Customer\Checkout;
use App\Livewire\Customer\ContactUs;
use App\Livewire\Customer\FaqPage;
use App\Livewire\Customer\HomePage;
use App\Livewire\Customer\MyAccount;
use App\Livewire\Customer\OrderCancel;
use App\Livewire\Customer\OrderSuccess;
use App\Livewire\Customer\OrderTracking;
use App\Livewire\Customer\PrivacyPolicy;
use App\Livewire\Customer\ProductDetail;
use App\Livewire\Customer\ShippingReturns;
use App\Livewire\Customer\ShopPage;
use App\Livewire\Customer\TermsPage;
use App\Livewire\Customer\WarrantyPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Customer Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/category/{slug}', CategoryProducts::class)->name('category.products');
Route::get('/products/{slug}', ProductDetail::class)->name('product.detail');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');
Route::get('/checkout/success/{order}', OrderSuccess::class)->name('checkout.success');
Route::get('/checkout/cancel/{order}', OrderCancel::class)->name('checkout.cancel');

// Information & Footer Public Pages
Route::get('/about', AboutUs::class)->name('about');
Route::get('/contact', ContactUs::class)->name('contact');
Route::get('/order-tracking', OrderTracking::class)->name('order.tracking');
Route::get('/faq', FaqPage::class)->name('faq');
Route::get('/shipping-returns', ShippingReturns::class)->name('shipping.returns');
Route::get('/warranty-policy', WarrantyPolicy::class)->name('warranty.policy');
Route::get('/privacy', PrivacyPolicy::class)->name('privacy');
Route::get('/terms', TermsPage::class)->name('terms');

// Guest Authentication Routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Authenticated Customer Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-account', MyAccount::class)->name('customer.account');
});

// Authenticated Administrator Routes
Route::middleware(['auth', 'admin'])
    ->prefix('/admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', AdminDashboard::class)
            ->name('dashboard');

        Route::get('/company-profile', CompanyProfile::class)
            ->name('company-profile');

        Route::get('/categories', CategoryList::class)
            ->name('categories.index');

        Route::get('/categories/create', AddCategory::class)
            ->name('categories.create');

        Route::get('/categories/{category}/edit', AddCategory::class)
            ->name('categories.edit');

        Route::get('/brands', BrandList::class)
            ->name('brands.index');

        Route::get('/brands/create', AddBrand::class)
            ->name('brands.create');

        Route::get('/brands/{brand}/edit', AddBrand::class)
            ->name('brands.edit');

        Route::get('/product/product-list', ProductList::class)
            ->name('product.index');

        Route::get('/product/add-product', AddProduct::class)
            ->name('product.add-product');

        Route::get('/product/{product}/edit', AddProduct::class)
            ->name('product.edit');

        Route::get('/product/{product}/view', ProductView::class)
            ->name('product.view');

        Route::get('/orders', OrderList::class)
            ->name('orders.index');

        Route::get('/orders/{order}/view', OrderView::class)
            ->name('orders.view');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
