<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Livewire\Component;

class OrderCancel extends Component
{
    public Order $order;

    public function mount(Order $order): void
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.customer.order-cancel')
            ->layout('layouts.customer.app');
    }
}
