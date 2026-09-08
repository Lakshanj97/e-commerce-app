<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;

    public function mount(Order $order): void
    {
        $this->order = $order;

        if ($order->exists && ! $order->relationLoaded('items')) {
            rescue(fn () => $order->loadMissing('items'));
        }

        // Check for Stripe session callback
        $sessionId = request()->query('session_id');
        if ($sessionId && $this->order->payment_status !== 'paid') {
            $this->order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'stripe_session_id' => $sessionId,
            ]);
        }

        // Forget the cart session upon successful checkout
        session()->forget('cart');
        $this->dispatch('cart-updated', count: 0);
    }

    public function render()
    {
        return view('livewire.customer.order-success')
            ->layout('layouts.customer.app');
    }
}
