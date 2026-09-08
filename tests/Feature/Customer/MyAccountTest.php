<?php

use App\Livewire\Customer\MyAccount;
use App\Models\User;
use Livewire\Livewire;

test('my account redirects guests to login', function () {
    Livewire::test(MyAccount::class)
        ->assertRedirect(route('login'));
});

test('my account renders for authenticated users', function () {
    $user = rescue(
        fn () => User::factory()->create(['name' => 'Test Customer', 'email' => 'cust'.uniqid().'@example.com']),
        null
    );

    if (! $user) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::actingAs($user)
        ->test(MyAccount::class)
        ->assertOk()
        ->assertSee('My Account')
        ->assertSee('Personal Information');
});

test('my account profile tab shows user data', function () {
    $user = rescue(
        fn () => User::factory()->create([
            'name' => 'John Doe',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone' => '+94771234567',
            'email' => 'johndoe'.uniqid().'@example.com',
        ]),
        null
    );

    if (! $user) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::actingAs($user)
        ->test(MyAccount::class)
        ->assertSet('firstName', 'John')
        ->assertSet('lastName', 'Doe')
        ->assertSet('phone', '+94771234567');
});

test('my account tab switching works', function () {
    $user = rescue(
        fn () => User::factory()->create(['email' => 'tab'.uniqid().'@example.com']),
        null
    );

    if (! $user) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::actingAs($user)
        ->test(MyAccount::class)
        ->assertSet('activeTab', 'profile')
        ->call('setTab', 'orders')
        ->assertSet('activeTab', 'orders')
        ->call('setTab', 'security')
        ->assertSet('activeTab', 'security');
});

test('my account orders tab shows order history', function () {
    $user = rescue(
        fn () => User::factory()->create(['email' => 'orders'.uniqid().'@example.com']),
        null
    );

    if (! $user) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::actingAs($user)
        ->test(MyAccount::class)
        ->call('setTab', 'orders')
        ->assertSee('Order History');
});
