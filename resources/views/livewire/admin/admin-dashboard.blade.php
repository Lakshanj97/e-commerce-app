<div class="space-y-8">
    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-slate-100 sm:text-3xl">
                Dashboard Overview
            </h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">
                Real-time performance and store overview for SimplyTek Electronics.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.product.add-product') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700 transition">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
            <a href="{{ route('home') }}" target="_blank"
                class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-xs hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 transition">
                <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                Live Store
            </a>
        </div>
    </div>

    {{-- Top Metric Cards --}}
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Total Sales --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-slate-400">Total Sales</p>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-slate-100 mt-1">
                    LKR {{ number_format($totalSales, 2) }}
                </p>
            </div>
        </div>

        {{-- Total Orders --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-slate-400">Total Orders</p>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-slate-100 mt-1">
                    {{ number_format($totalOrders) }} Orders
                </p>
            </div>
        </div>

        {{-- Active Products --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-slate-400">Active Products</p>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-slate-100 mt-1">
                    {{ number_format($activeProducts) }} Items
                </p>
            </div>
        </div>

        {{-- Total Customers --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-xs transition-all dark:border-slate-800 dark:bg-slate-900 flex items-center space-x-4">
            <div class="p-3 bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-slate-400">Customers</p>
                <p class="text-2xl font-extrabold text-gray-900 dark:text-slate-100 mt-1">
                    {{ number_format($totalCustomers) }} Users
                </p>
            </div>
        </div>
    </div>

    {{-- Order Status Breakdown Pills --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
        <div class="p-4 rounded-xl border border-amber-200 bg-amber-50/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                <span class="text-sm font-medium text-amber-900">Pending</span>
            </div>
            <span class="text-sm font-bold text-amber-800">{{ $pendingOrdersCount }}</span>
        </div>
        <div class="p-4 rounded-xl border border-blue-200 bg-blue-50/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                <span class="text-sm font-medium text-blue-900">Processing</span>
            </div>
            <span class="text-sm font-bold text-blue-800">{{ $processingOrdersCount }}</span>
        </div>
        <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span class="text-sm font-medium text-emerald-900">Delivered</span>
            </div>
            <span class="text-sm font-bold text-emerald-800">{{ $deliveredOrdersCount }}</span>
        </div>
        <div class="p-4 rounded-xl border border-red-200 bg-red-50/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
                <span class="text-sm font-medium text-red-900">Low Stock Alert</span>
            </div>
            <span class="text-sm font-bold text-red-800">{{ $lowStockProducts }} items</span>
        </div>
    </div>

    {{-- Main Content Grid: Recent Orders & Sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Orders Table --}}
        <div class="lg:col-span-2 rounded-2xl border border-gray-200 bg-white shadow-xs overflow-hidden dark:border-slate-800 dark:bg-slate-900">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/60 dark:border-slate-800 dark:bg-slate-900/50 flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-gray-900 dark:text-slate-100">Recent Orders</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Latest customer purchases</p>
                </div>
                <a href="{{ route('admin.orders.index') }}"
                    class="text-xs font-semibold text-cyan-600 hover:text-cyan-700 transition">
                    View All &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm min-w-[600px]">
                    <thead>
                        <tr class="bg-gray-100/75 text-gray-600 uppercase text-xs font-semibold border-b border-gray-200 dark:bg-slate-800/40 dark:text-slate-400 dark:border-slate-800">
                            <th class="px-6 py-3.5">Order ID</th>
                            <th class="px-6 py-3.5">Customer</th>
                            <th class="px-6 py-3.5">Date</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5">Total</th>
                            <th class="px-6 py-3.5 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-slate-800 text-gray-700 dark:text-slate-300">
                        @forelse ($recentOrders as $order)
                            <tr class="hover:bg-gray-50/80 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-slate-100 whitespace-nowrap">
                                    #{{ $order->order_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900 dark:text-slate-100">
                                        {{ $order->first_name }} {{ $order->last_name }}
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $order->city }}</div>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 whitespace-nowrap">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusStyles = match ($order->status) {
                                            'pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-500/10 dark:text-amber-400',
                                            'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/10 dark:text-blue-400',
                                            'shipped' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-500/10 dark:text-indigo-400',
                                            'delivered' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/10 dark:text-emerald-400',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-500/10 dark:text-red-400',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold capitalize {{ $statusStyles }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-slate-100 whitespace-nowrap">
                                    LKR {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.orders.view', $order->id) }}"
                                        class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 shadow-xs hover:bg-gray-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700 transition">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Right Side Column: Top Products & Quick Links --}}
        <div class="space-y-6">
            {{-- Top Products Widget --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-xs p-6 dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-gray-900 dark:text-slate-100">Featured Products</h2>
                    <a href="{{ route('admin.product.index') }}" class="text-xs font-semibold text-cyan-600 hover:text-cyan-700 transition">
                        View All
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse ($topProducts as $prod)
                        <div class="flex items-center gap-3.5 pb-3 border-b border-gray-100 dark:border-slate-800 last:border-0 last:pb-0">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 overflow-hidden shrink-0 border border-gray-100 flex items-center justify-center">
                                @if ($prod->images->isNotEmpty())
                                    <img src="{{ $prod->image_urls[0] ?? '' }}" alt="{{ $prod->name }}" class="w-full h-full object-contain p-1">
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-900 dark:text-slate-100 truncate">
                                    {{ $prod->name }}
                                </p>
                                <p class="text-[11px] text-gray-400 mt-0.5">
                                    {{ $prod->brand->name ?? 'Tech' }} &bull; Stock: <span class="{{ $prod->quantity <= 5 ? 'text-red-500 font-bold' : 'text-gray-600' }}">{{ $prod->quantity }}</span>
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-gray-900 dark:text-slate-100">
                                    LKR {{ number_format($prod->selling_price) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">No products added yet.</p>
                    @endforelse
                </div>
            </div>

            {{-- Quick Management Shortcuts --}}
            <div class="rounded-2xl border border-gray-200 bg-white shadow-xs p-6 dark:border-slate-800 dark:bg-slate-900">
                <h3 class="font-bold text-gray-900 dark:text-slate-100 text-sm mb-3">Quick Navigation</h3>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('admin.categories.index') }}"
                        class="p-3 text-center rounded-xl bg-gray-50 hover:bg-cyan-50 hover:text-cyan-700 text-gray-700 text-xs font-semibold transition border border-gray-100">
                        📂 Categories
                    </a>
                    <a href="{{ route('admin.brands.index') }}"
                        class="p-3 text-center rounded-xl bg-gray-50 hover:bg-cyan-50 hover:text-cyan-700 text-gray-700 text-xs font-semibold transition border border-gray-100">
                        🏷️ Brands
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="p-3 text-center rounded-xl bg-gray-50 hover:bg-cyan-50 hover:text-cyan-700 text-gray-700 text-xs font-semibold transition border border-gray-100">
                        📦 Orders
                    </a>
                    <a href="{{ route('admin.company-profile') }}"
                        class="p-3 text-center rounded-xl bg-gray-50 hover:bg-cyan-50 hover:text-cyan-700 text-gray-700 text-xs font-semibold transition border border-gray-100">
                        ⚙️ Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
