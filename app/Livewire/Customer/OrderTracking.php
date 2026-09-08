<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderTracking extends Component
{
    public string $orderQuery = '';

    public bool $searched = false;

    public ?Order $order = null;

    public function mount(): void
    {
        // If query string has 'code', prefill and track
        $code = request()->query('code');
        if ($code) {
            $this->orderQuery = trim($code);
            $this->trackOrder();
        }
    }

    public function trackOrder(): void
    {
        $this->validate([
            'orderQuery' => 'required|string|min:3',
        ], [
            'orderQuery.required' => 'Please enter your Order Number (e.g. ORD-2026-...) or Email.',
        ]);

        $query = trim($this->orderQuery);

        $canConnect = rescue(fn () => DB::connection()->getPdo(), false, false);
        $this->order = $canConnect ? rescue(
            fn () => Order::with(['items.product.images', 'user'])
                ->where('order_number', 'like', "%{$query}%")
                ->orWhere('email', $query)
                ->latest()
                ->first(),
            null,
            false
        ) : null;

        $this->searched = true;

        if (! $this->order) {
            session()->flash('track_error', "No order found matching '{$query}'. Please verify your order number or email.");
        }
    }

    public function render()
    {
        return view('livewire.customer.order-tracking')
            ->layout('layouts.customer.app');
    }
}
