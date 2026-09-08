<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class WarrantyPolicy extends Component
{
    public function render()
    {
        return view('livewire.customer.warranty-policy')
            ->layout('layouts.customer.app');
    }
}
