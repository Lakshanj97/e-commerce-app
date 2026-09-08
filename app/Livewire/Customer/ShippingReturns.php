<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class ShippingReturns extends Component
{
    public function render()
    {
        return view('livewire.customer.shipping-returns')
            ->layout('layouts.customer.app');
    }
}
