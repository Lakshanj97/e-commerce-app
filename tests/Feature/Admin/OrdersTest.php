<?php

use App\Livewire\Admin\Orders\OrderList;
use App\Livewire\Admin\Orders\OrderView;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Livewire\Livewire;

test('admin order list component renders successfully', function () {
    $user = new User([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
    ]);
    $user->id = 1;

    $this->actingAs($user);

    Livewire::test(OrderList::class)
        ->assertSee('Orders')
        ->assertSee('Total Revenue')
        ->assertSee('Search orders');
});

test('admin order list displays orders and filters by search', function () {
    $user = new User(['name' => 'Admin User', 'email' => 'admin@example.com']);
    $user->id = 1;
    $this->actingAs($user);

    $order = new Order([
        'order_number' => 'ORD-20260820-TEST99',
        'first_name' => 'Nimal',
        'last_name' => 'Silva',
        'email' => 'nimal@example.com',
        'phone' => '+94779876543',
        'address' => '50 Kandy Road',
        'city' => 'Kandy',
        'country' => 'Sri Lanka',
        'payment_method' => 'stripe',
        'payment_status' => 'paid',
        'status' => 'processing',
        'subtotal' => 35000.00,
        'total_amount' => 35000.00,
    ]);
    $order->id = 55;
    $order->setRelation('items', collect([]));

    Livewire::test(OrderList::class)
        ->set('search', 'ORD-20260820-TEST99')
        ->assertSet('search', 'ORD-20260820-TEST99');
});

test('admin order list handles delete confirmation lifecycle', function () {
    $user = new User(['name' => 'Admin User', 'email' => 'admin@example.com']);
    $user->id = 1;
    $this->actingAs($user);

    Livewire::test(OrderList::class)
        ->set('deleteId', 12)
        ->set('deleteName', 'Order #ORD-123')
        ->call('cancelDelete')
        ->assertSet('deleteId', null)
        ->assertSet('deleteName', '');
});

test('admin order view component mounts with order details', function () {
    $user = new User(['name' => 'Admin User', 'email' => 'admin@example.com']);
    $user->id = 1;
    $this->actingAs($user);

    $order = new Order([
        'order_number' => 'ORD-20260820-VIEW01',
        'first_name' => 'Amal',
        'last_name' => 'Fernando',
        'email' => 'amal@example.com',
        'phone' => '+94712345678',
        'address' => '78 Lake View',
        'city' => 'Colombo',
        'country' => 'Sri Lanka',
        'payment_method' => 'cod',
        'payment_status' => 'pending',
        'status' => 'pending',
        'subtotal' => 8500.00,
        'shipping_amount' => 350.00,
        'total_amount' => 8850.00,
        'notes' => 'Call before delivery',
    ]);
    $order->id = 88;

    $item = new OrderItem([
        'order_id' => 88,
        'product_name' => 'Anker PowerBank 20000mAh',
        'price' => 8500.00,
        'quantity' => 1,
        'subtotal' => 8500.00,
        'warranty' => '18 Months',
    ]);

    $order->setRelation('items', collect([$item]));
    $order->setRelation('user', null);

    Livewire::test(OrderView::class, ['order' => $order])
        ->assertSee('ORD-20260820-VIEW01')
        ->assertSee('Amal Fernando')
        ->assertSee('Anker PowerBank 20000mAh')
        ->assertSee('Call before delivery')
        ->assertSet('status', 'pending')
        ->assertSet('paymentStatus', 'pending');
});
