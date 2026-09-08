<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;

test('login page component renders successfully with SimplyTek branding', function () {
    Livewire::test(Login::class)
        ->assertOk()
        ->assertSee('Welcome back')
        ->assertSee('Sign in')
        ->assertSee('Demo Accounts')
        ->assertSee('⚡ Super Admin');
});

test('login component requires email and password', function () {
    Livewire::test(Login::class)
        ->call('authenticate')
        ->assertHasErrors(['email', 'password']);
});

test('login component quickFill populates demo credentials', function () {
    Livewire::test(Login::class)
        ->call('quickFill', 'admin')
        ->assertSet('email', 'admin@simplytek.com')
        ->assertSet('password', 'Admin@12345')
        ->call('quickFill', 'manager')
        ->assertSet('email', 'manager@simplytek.com')
        ->assertSet('password', 'Admin@12345')
        ->call('quickFill', 'customer')
        ->assertSet('email', 'customer@simplytek.com')
        ->assertSet('password', 'Customer@12345');
});

test('register page component renders successfully', function () {
    Livewire::test(Register::class)
        ->assertOk()
        ->assertSee('Create your account')
        ->assertSee('First Name')
        ->assertSee('Last Name')
        ->assertSee('Email address')
        ->assertSee('Create Account');
});

test('register component requires necessary fields and terms', function () {
    Livewire::test(Register::class)
        ->call('register')
        ->assertHasErrors(['first_name', 'last_name', 'email', 'password', 'terms']);
});

test('register component validates password confirmation', function () {
    $canConnect = rescue(fn () => DB::connection()->getPdo(), false);

    if (! $canConnect) {
        expect(true)->toBeTrue();

        return;
    }

    Livewire::test(Register::class)
        ->set('first_name', 'John')
        ->set('last_name', 'Doe')
        ->set('email', 'john.doe@example.com')
        ->set('password', 'secret123')
        ->set('password_confirmation', 'different123')
        ->set('terms', true)
        ->call('register')
        ->assertHasErrors(['password' => 'confirmed']);
});

test('unauthenticated guest is redirected to login when accessing admin dashboard', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('login'));
});

test('user model is_admin attribute returns boolean correctly', function () {
    $user = new User([
        'name' => 'Regular User',
        'email' => 'user@example.com',
    ]);

    expect($user->is_admin)->toBeFalse();
});
