<?php

use App\Livewire\Customer\Cart;
use Livewire\Livewire;

test('cart component mounts and loads session cart', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Anker Soundcore Q30',
            'slug' => 'anker-soundcore-q30',
            'price' => 18500.00,
            'original_price' => 22000.00,
            'quantity' => 2,
            'max_quantity' => 10,
            'image' => 'https://example.com/q30.jpg',
            'warranty' => '1 Year',
        ],
    ]);

    Livewire::test(Cart::class)
        ->assertSee('Anker Soundcore Q30')
        ->assertSee('18,500.00')
        ->assertSet('cart.1.quantity', 2);
});

test('cart subtotal and total calculations work accurately', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Item One',
            'slug' => 'item-one',
            'price' => 2000.00,
            'original_price' => 2500.00,
            'quantity' => 2,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => '6 Months',
        ],
        2 => [
            'id' => 2,
            'name' => 'Item Two',
            'slug' => 'item-two',
            'price' => 1500.00,
            'original_price' => 1500.00,
            'quantity' => 1,
            'max_quantity' => 3,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    $component = Livewire::test(Cart::class);

    // Subtotal: 2000*2 + 1500*1 = 5500.00 (qualifies for free shipping over 5000)
    expect($component->get('subtotal'))->toBe(5500.00);
    expect($component->get('originalSubtotal'))->toBe(6500.00);
    expect($component->get('productSavings'))->toBe(1000.00);
    expect($component->get('shipping'))->toBe(0.00);
    expect($component->get('total'))->toBe(5500.00);
    expect($component->get('totalCount'))->toBe(3);
});

test('cart increment and decrement actions modify quantity correctly', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Item Test',
            'slug' => 'item-test',
            'price' => 1000.00,
            'original_price' => 1000.00,
            'quantity' => 2,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    Livewire::test(Cart::class)
        ->call('increment', 1)
        ->assertSet('cart.1.quantity', 3);

    expect(session('cart')[1]['quantity'])->toBe(3);

    Livewire::test(Cart::class)
        ->call('decrement', 1)
        ->assertSet('cart.1.quantity', 2);

    expect(session('cart')[1]['quantity'])->toBe(2);
});

test('decrementing quantity of 1 removes item from cart', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Item Single',
            'slug' => 'item-single',
            'price' => 500.00,
            'original_price' => 500.00,
            'quantity' => 1,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    Livewire::test(Cart::class)
        ->call('decrement', 1)
        ->assertSet('cart', [])
        ->assertSee('Your Cart is Empty');

    expect(session('cart'))->toBeEmpty();
});

test('remove action removes product from cart', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Item Delete',
            'slug' => 'item-delete',
            'price' => 750.00,
            'original_price' => 750.00,
            'quantity' => 1,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    Livewire::test(Cart::class)
        ->call('remove', 1)
        ->assertSet('cart', [])
        ->assertSee('Your Cart is Empty');

    expect(session('cart'))->toBeEmpty();
});

test('clear action empties the cart', function () {
    session()->put('cart', [
        1 => ['id' => 1, 'name' => 'A', 'price' => 100, 'quantity' => 1],
        2 => ['id' => 2, 'name' => 'B', 'price' => 200, 'quantity' => 2],
    ]);

    Livewire::test(Cart::class)
        ->call('clear')
        ->assertSet('cart', [])
        ->assertSee('Your Cart is Empty');

    expect(session('cart'))->toBeEmpty();
});

test('applying coupon code applies discount', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Test Phone',
            'slug' => 'test-phone',
            'price' => 10000.00,
            'original_price' => 10000.00,
            'quantity' => 1,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    $component = Livewire::test(Cart::class)
        ->set('couponCode', 'SIMPLY10')
        ->call('applyCoupon');

    expect($component->get('discountAmount'))->toBe(1000.00);
    expect($component->get('total'))->toBe(9000.00);

    $component->call('removeCoupon');
    expect($component->get('discountAmount'))->toBe(0.00);
    expect($component->get('total'))->toBe(10000.00);
});

test('cart charges shipping fee when subtotal is below free shipping threshold', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Small Accessory',
            'slug' => 'small-accessory',
            'price' => 1200.00,
            'original_price' => 1200.00,
            'quantity' => 1,
            'max_quantity' => 10,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    $component = Livewire::test(Cart::class);

    // Subtotal: 1200.00, shippingFee: 350.00, Total: 1550.00
    expect($component->get('subtotal'))->toBe(1200.00);
    expect($component->get('shipping'))->toBe(350.00);
    expect($component->get('total'))->toBe(1550.00);
});

test('updateQuantity action updates or removes based on quantity input', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Cable',
            'slug' => 'cable',
            'price' => 500.00,
            'original_price' => 500.00,
            'quantity' => 1,
            'max_quantity' => 10,
            'image' => null,
            'warranty' => null,
        ],
    ]);

    Livewire::test(Cart::class)
        ->call('updateQuantity', 1, 5)
        ->assertSet('cart.1.quantity', 5);

    expect(session('cart')[1]['quantity'])->toBe(5);

    // Setting quantity to 0 removes the item
    Livewire::test(Cart::class)
        ->call('updateQuantity', 1, 0)
        ->assertSet('cart', []);

    expect(session('cart'))->toBeEmpty();
});
