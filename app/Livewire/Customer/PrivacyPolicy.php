<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class PrivacyPolicy extends Component
{
    public function render()
    {
        return view('livewire.customer.privacy-policy')
            ->layout('layouts.customer.app');
    }
}
