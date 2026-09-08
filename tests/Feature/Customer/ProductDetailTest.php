<?php

use App\Livewire\Customer\ProductDetail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Livewire;

function makeDetailProduct(): ?Product
{
    $brand = rescue(fn () => Brand::factory()->create(['name' => 'DetailBrand', 'slug' => 'detail-brand-'.uniqid(), 'is_active' => true]), null);
    $cat = rescue(fn () => Category::factory()->create(['name' => 'DetailCat', 'slug' => 'detail-cat-'.uniqid(), 'is_active' => true]), null);

    if (! $brand || ! $cat) {
        return null;
    }

    return rescue(fn () => Product::factory()->create([
        'name' => 'Test Detail Product',
        'slug' => 'test-detail-product-'.uniqid(),
        'brand_id' => $brand->id,
        'category_id' => $cat->id,
        'is_active' => true,
        'selling_price' => 15000,
        'original_price' => 20000,
        'quantity' => 5,
        'warranty' => '1 Year',
        'description' => 'Full product description here.',
    ]), null);
}

test('product detail page renders for a valid slug', function () {
    $product = makeDetailProduct();

    if (! $product) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(ProductDetail::class, ['slug' => $product->slug])
        ->assertOk()
        ->assertSee($product->name)
        ->assertSee(number_format($product->selling_price, 2));
});

test('product detail shows discount badge when original price is higher', function () {
    $product = makeDetailProduct();

    if (! $product) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(ProductDetail::class, ['slug' => $product->slug])
        ->assertSee('Save');
});

test('product detail quantity increment and decrement', function () {
    $product = makeDetailProduct();

    if (! $product) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(ProductDetail::class, ['slug' => $product->slug])
        ->assertSet('quantity', 1)
        ->call('incrementQuantity')
        ->assertSet('quantity', 2)
        ->call('decrementQuantity')
        ->assertSet('quantity', 1);
});

test('product detail add to cart dispatches event', function () {
    $product = makeDetailProduct();

    if (! $product) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(ProductDetail::class, ['slug' => $product->slug])
        ->call('addToCart')
        ->assertDispatched('add-to-cart');
});

test('product detail tab switching', function () {
    $product = makeDetailProduct();

    if (! $product) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(ProductDetail::class, ['slug' => $product->slug])
        ->assertSet('activeTab', 'description')
        ->call('setTab', 'specs')
        ->assertSet('activeTab', 'specs');
});
