<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $terms = false;

    /**
     * Validation rules for registration.
     *
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'terms.accepted' => 'You must agree to the terms of service and privacy policy.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'email.unique' => 'An account with this email address already exists.',
        ];
    }

    /**
     * Register a new user.
     */
    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => trim("{$this->first_name} {$this->last_name}"),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
        ]);

        // Assign Customer role
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);
        $user->assignRole($customerRole);

        event(new Registered($user));

        Auth::login($user);
        session()->regenerate();

        session()->flash('status', 'Welcome to SimplyTek! Your account has been created.');

        return redirect()->route('customer.account');
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('layouts.customer.app');
    }
}
