<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;

class OrderView extends Component
{
    public Order $order;

    public string $status = '';

    public string $paymentStatus = '';

    public ?int $deleteId = null;

    public string $deleteName = '';

    public function mount(Order $order): void
    {
        $this->order = $order;

        if ($order->exists && ! $order->relationLoaded('items')) {
            rescue(fn () => $order->loadMissing(['items', 'user']));
        }

        $this->status = $order->status ?? 'pending';
        $this->paymentStatus = $order->payment_status ?? 'pending';
    }

    public function updateStatus(): void
    {
        $this->order->update([
            'status' => $this->status,
            'payment_status' => $this->paymentStatus,
        ]);

        session()->flash('success', "Order #{$this->order->order_number} status updated successfully.");
    }

    public function confirmDelete(): void
    {
        $this->deleteId = $this->order->id;
        $this->deleteName = "Order #{$this->order->order_number} ({$this->order->full_name})";
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function deleteOrder()
    {
        $orderNumber = $this->order->order_number;
        $this->order->delete();

        session()->flash('success', "Order #{$orderNumber} deleted successfully.");

        return $this->redirectRoute('admin.orders.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.orders.order-view')
            ->layout('layouts.admin.app');
    }
}
