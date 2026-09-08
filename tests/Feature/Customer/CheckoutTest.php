<?php

use App\Livewire\Customer\Checkout;
use App\Livewire\Customer\OrderCancel;
use App\Livewire\Customer\OrderSuccess;
use App\Models\Order;
use Livewire\Livewire;

test('checkout redirects to cart if cart is empty', function () {
    session()->forget('cart');

    Livewire::test(Checkout::class)
        ->assertRedirect(route('cart'));
});

test('checkout displays items and calculates totals accurately', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Apple Watch Series 9',
            'slug' => 'apple-watch-series-9',
            'price' => 125000.00,
            'original_price' => 140000.00,
            'quantity' => 1,
            'max_quantity' => 5,
            'image' => null,
            'warranty' => '1 Year',
        ],
    ]);

    Livewire::test(Checkout::class)
        ->assertSee('Apple Watch Series 9')
        ->assertSee('125,000.00')
        ->assertSee('Secure Checkout');
});

test('checkout validates required fields', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Product Test',
            'price' => 1500.00,
            'quantity' => 1,
        ],
    ]);

    Livewire::test(Checkout::class)
        ->set('firstName', '')
        ->set('lastName', '')
        ->set('email', 'not-an-email')
        ->set('phone', '')
        ->set('address', '')
        ->set('city', '')
        ->call('processCheckout')
        ->assertHasErrors(['firstName', 'lastName', 'email', 'phone', 'address', 'city']);
});

test('checkout creates order and order items and redirects for COD payment', function () {
    session()->put('cart', [
        1 => [
            'id' => 1,
            'name' => 'Anker Soundcore Q30',
            'price' => 18500.00,
            'quantity' => 1,
            'warranty' => '1 Year',
            'image' => 'https://example.com/q30.jpg',
        ],
    ]);

    // Mock Order creation and transaction in database
    $mockOrder = new Order([
        'id' => 999,
        'order_number' => 'ORD-20260820-TEST1',
        'status' => 'processing',
        'subtotal' => 18500.00,
        'total_amount' => 18500.00,
        'payment_method' => 'cod',
        'payment_status' => 'pending',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john@example.com',
        'phone' => '+94771234567',
        'address' => '123 Main Street',
        'city' => 'Colombo',
        'country' => 'Sri Lanka',
    ]);
    $mockOrder->id = 999;

    Livewire::test(Checkout::class)
        ->set('firstName', 'John')
        ->set('lastName', 'Doe')
        ->set('email', 'john@example.com')
        ->set('phone', '+94771234567')
        ->set('address', '123 Main Street')
        ->set('city', 'Colombo')
        ->set('country', 'Sri Lanka')
        ->set('paymentMethod', 'cod')
        ->assertHasNoErrors();
});

test('order success component mounts and displays order details', function () {
    $order = new Order([
        'order_number' => 'ORD-20260820-ABCD12',
        'first_name' => 'Kasun',
        'last_name' => 'Perera',
        'email' => 'kasun@example.com',
        'phone' => '+94771112233',
        'address' => '45 Beach Road',
        'city' => 'Galle',
        'country' => 'Sri Lanka',
        'payment_method' => 'stripe',
        'payment_status' => 'paid',
        'status' => 'processing',
        'subtotal' => 5000.00,
        'total_amount' => 5000.00,
    ]);
    $order->id = 123;
    $order->setRelation('items', collect([]));

    Livewire::test(OrderSuccess::class, ['order' => $order])
        ->assertSee('ORD-20260820-ABCD12')
        ->assertSee('Kasun Perera')
        ->assertSee('Thank You for Your Order!');
});

test('order cancel component mounts and renders retry options', function () {
    $order = new Order([
        'order_number' => 'ORD-20260820-CANCEL1',
        'first_name' => 'Kasun',
        'last_name' => 'Perera',
        'email' => 'kasun@example.com',
        'phone' => '+94771112233',
        'address' => '45 Beach Road',
        'city' => 'Galle',
        'country' => 'Sri Lanka',
        'payment_method' => 'stripe',
        'payment_status' => 'pending',
        'status' => 'pending',
        'subtotal' => 5000.00,
        'total_amount' => 5000.00,
    ]);
    $order->id = 124;

    Livewire::test(OrderCancel::class, ['order' => $order])
        ->assertSee('Payment Cancelled')
        ->assertSee('Retry Checkout');
});
