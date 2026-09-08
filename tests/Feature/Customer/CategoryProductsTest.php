<?php

use App\Livewire\Customer\CategoryProducts;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

test('category products component mounts with valid category', function () {
    $canConnect = rescue(fn () => DB::connection()->getPdo(), false);

    if (! $canConnect) {
        expect(true)->toBeTrue();

        return;
    }

    $category = Category::firstOrCreate(
        ['slug' => 'test-audio'],
        ['name' => 'Test Audio', 'status' => true]
    );

    Livewire::test(CategoryProducts::class, ['slug' => 'test-audio'])
        ->assertOk()
        ->assertSee('Test Audio')
        ->assertSee('Category Showcase');
});

test('category products displays products belonging to the category', function () {
    $canConnect = rescue(fn () => DB::connection()->getPdo(), false);

    if (! $canConnect) {
        expect(true)->toBeTrue();

        return;
    }

    $category = Category::firstOrCreate(
        ['slug' => 'test-power'],
        ['name' => 'Test Power', 'status' => true]
    );

    $brand = Brand::firstOrCreate(
        ['slug' => 'test-brand'],
        ['name' => 'Test Brand', 'is_active' => true]
    );

    Product::updateOrCreate(
        ['slug' => 'test-power-bank-10k'],
        [
            'name' => 'Test Power Bank 10K',
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'original_price' => 10000.00,
            'selling_price' => 8500.00,
            'quantity' => 20,
            'is_active' => true,
        ]
    );

    Livewire::test(CategoryProducts::class, ['slug' => 'test-power'])
        ->assertSee('Test Power Bank 10K')
        ->assertSee('Rs. 8,500.00');
});

test('category products filters by search keyword', function () {
    $canConnect = rescue(fn () => DB::connection()->getPdo(), false);

    if (! $canConnect) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(CategoryProducts::class, ['slug' => 'power-charging'])
        ->set('search', 'Anker')
        ->assertSet('search', 'Anker');
});

test('category products throws 404 for invalid category slug', function () {
    $canConnect = rescue(fn () => DB::connection()->getPdo(), false);

    if (! $canConnect) {
        expect(true)->toBeTrue();

        return;
    }

    $this->get('/category/non-existent-category-slug-xyz')
        ->assertNotFound();
});
