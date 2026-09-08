<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $totalSales = rescue(
            fn () => Order::where('status', '!=', 'cancelled')->sum('total_amount'),
            0.00
        );

        $totalOrders = rescue(
            fn () => Order::count(),
            0
        );

        $activeProducts = rescue(
            fn () => Product::where('is_active', true)->count(),
            0
        );

        $totalCustomers = rescue(
            fn () => User::role('Customer')->count(),
            User::count()
        );

        $pendingOrdersCount = rescue(
            fn () => Order::where('status', 'pending')->count(),
            0
        );

        $processingOrdersCount = rescue(
            fn () => Order::where('status', 'processing')->count(),
            0
        );

        $deliveredOrdersCount = rescue(
            fn () => Order::where('status', 'delivered')->count(),
            0
        );

        $lowStockProducts = rescue(
            fn () => Product::where('is_active', true)->where('quantity', '<=', 5)->count(),
            0
        );

        $recentOrders = rescue(
            fn () => Order::with(['items', 'user'])->latest()->take(6)->get(),
            collect()
        );

        $topProducts = rescue(
            fn () => Product::with(['category', 'brand', 'images'])->where('is_active', true)->latest()->take(5)->get(),
            collect()
        );

        $totalCategories = rescue(
            fn () => Category::count(),
            0
        );

        return view('livewire.admin.admin-dashboard', [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'activeProducts' => $activeProducts,
            'totalCustomers' => $totalCustomers,
            'pendingOrdersCount' => $pendingOrdersCount,
            'processingOrdersCount' => $processingOrdersCount,
            'deliveredOrdersCount' => $deliveredOrdersCount,
            'lowStockProducts' => $lowStockProducts,
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts,
            'totalCategories' => $totalCategories,
        ])->layout('layouts.admin.app');
    }
}
