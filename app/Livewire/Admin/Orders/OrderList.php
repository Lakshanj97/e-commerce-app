<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class OrderList extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = 'all';

    public string $paymentStatusFilter = 'all';

    public ?int $deleteId = null;

    public string $deleteName = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPaymentStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updateOrderStatus(int $orderId, string $status): void
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['status' => $status]);
            session()->flash('success', "Order #{$order->order_number} status updated to ".ucfirst($status).'.');
        }
    }

    public function updatePaymentStatus(int $orderId, string $paymentStatus): void
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->update(['payment_status' => $paymentStatus]);
            session()->flash('success', "Order #{$order->order_number} payment status updated to ".ucfirst($paymentStatus).'.');
        }
    }

    public function confirmDelete(int $id): void
    {
        $order = Order::findOrFail($id);
        $this->deleteId = $order->id;
        $this->deleteName = "Order #{$order->order_number} ({$order->full_name})";
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function deleteOrder(): void
    {
        if ($this->deleteId) {
            $order = Order::find($this->deleteId);
            if ($order) {
                $orderNumber = $order->order_number;
                $order->delete();
                session()->flash('success', "Order #{$orderNumber} deleted successfully.");
            }
        }

        $this->cancelDelete();
    }

    public function searchOrders()
    {
        return Order::query()
            ->with(['items', 'user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('order_number', 'like', '%'.$this->search.'%')
                        ->orWhere('first_name', 'like', '%'.$this->search.'%')
                        ->orWhere('last_name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('phone', 'like', '%'.$this->search.'%')
                        ->orWhere('city', 'like', '%'.$this->search.'%')
                        ->orWhere('total_amount', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->paymentStatusFilter !== 'all', function ($query) {
                $query->where('payment_status', $this->paymentStatusFilter);
            })
            ->latest()
            ->paginate(20);
    }

    public function render()
    {
        $orders = rescue(
            fn () => $this->searchOrders(),
            new LengthAwarePaginator([], 0, 20)
        );

        $stats = [
            'total' => rescue(fn () => Order::count(), 0),
            'pending' => rescue(fn () => Order::where('status', 'pending')->count(), 0),
            'processing' => rescue(fn () => Order::where('status', 'processing')->count(), 0),
            'completed' => rescue(fn () => Order::where('status', 'completed')->count(), 0),
            'revenue' => rescue(fn () => Order::where('payment_status', 'paid')->sum('total_amount'), 0.0),
        ];

        return view('livewire.admin.orders.order-list', compact('orders', 'stats'))
            ->layout('layouts.admin.app');
    }
}
