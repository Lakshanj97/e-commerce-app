<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Component;

class Login extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    /**
     * Validation rules for login.
     *
     * @return array<string, string>
     */
    protected function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Authenticate the user.
     */
    public function authenticate()
    {
        $this->validate();

        $throttleKey = Str::transliterate(Str::lower($this->email).'|'.request()->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]));

            return;
        }

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($throttleKey);
            $this->addError('email', 'These credentials do not match our records.');

            return;
        }

        RateLimiter::clear($throttleKey);
        session()->regenerate();

        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('customer.account'));
    }

    /**
     * Quick-fill helper for testing accounts.
     */
    public function quickFill(string $role): void
    {
        if ($role === 'admin') {
            $this->email = 'admin@simplytek.com';
            $this->password = 'Admin@12345';
        } elseif ($role === 'manager') {
            $this->email = 'manager@simplytek.com';
            $this->password = 'Admin@12345';
        } elseif ($role === 'customer') {
            $this->email = 'customer@simplytek.com';
            $this->password = 'Customer@12345';
        }
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('layouts.customer.app');
    }
}
