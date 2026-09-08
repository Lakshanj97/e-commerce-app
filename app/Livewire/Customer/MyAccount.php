<?php

namespace App\Livewire\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;

class MyAccount extends Component
{
    use WithPagination;

    public string $activeTab = 'profile';

    // Profile fields
    public string $name = '';

    public string $firstName = '';

    public string $lastName = '';

    public string $phone = '';

    public string $email = '';

    // Password fields
    public string $currentPassword = '';

    public string $newPassword = '';

    public string $newPasswordConfirmation = '';

    public function mount(): void
    {
        if (! Auth::check()) {
            $this->redirectRoute('login');

            return;
        }

        $user = Auth::user();
        $this->name = $user->name;
        $this->firstName = $user->first_name ?? '';
        $this->lastName = $user->last_name ?? '';
        $this->phone = $user->phone ?? '';
        $this->email = $user->email;
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
        $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation']);
        $this->resetValidation();
    }

    public function updateProfile(): void
    {
        $this->validate([
            'firstName' => 'nullable|string|max:100',
            'lastName' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->phone = $this->phone;
        $user->save();

        session()->flash('profileSuccess', 'Profile updated successfully!');
    }

    public function changePassword(): void
    {
        $this->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($this->currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'currentPassword' => 'The current password is incorrect.',
            ]);
        }

        $user->password = Hash::make($this->newPassword);
        $user->save();

        $this->reset(['currentPassword', 'newPassword', 'newPasswordConfirmation']);
        session()->flash('passwordSuccess', 'Password changed successfully!');
    }

    public function render()
    {
        $orders = rescue(
            fn () => Auth::user()
                ->orders()
                ->with('items')
                ->latest()
                ->paginate(10),
            collect()
        );

        return view('livewire.customer.my-account', [
            'orders' => $orders,
        ])->layout('layouts.customer.app');
    }
}
