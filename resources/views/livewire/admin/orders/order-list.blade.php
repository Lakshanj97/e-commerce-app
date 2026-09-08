<div>
    <x-common.admin.alerts.success />
    <x-common.admin.alerts.error />

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Orders
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage and track customer orders, payments, and shipping statuses
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                Total Revenue: Rs. {{ number_format($stats['revenue'] ?? 0, 2) }}
            </span>
        </div>
    </div>

    {{-- Metrics Cards Row --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Orders</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs">
            <p class="text-xs font-semibold text-amber-600 uppercase tracking-wider">Pending</p>
            <p class="text-2xl font-bold text-amber-600 mt-1">{{ $stats['pending'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs">
            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider">Processing</p>
            <p class="text-2xl font-bold text-blue-600 mt-1">{{ $stats['processing'] ?? 0 }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-xs">
            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Completed</p>
            <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $stats['completed'] ?? 0 }}</p>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-xs">
        
        {{-- Filter & Search Header --}}
        <div class="p-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex-1 max-w-md">
                <x-common.admin.forms.search wire:model.live.debounce.300ms="search" placeholder="Search orders by number, customer, email, city..." />
            </div>

            <div class="flex flex-wrap items-center gap-3">
                {{-- Order Status Filter --}}
                <div class="flex items-center gap-1.5">
                    <label for="statusFilter" class="text-xs font-semibold text-gray-500">Status:</label>
                    <select id="statusFilter" wire:model.live="statusFilter"
                        class="text-xs font-medium px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                        <option value="all">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                {{-- Payment Status Filter --}}
                <div class="flex items-center gap-1.5">
                    <label for="paymentStatusFilter" class="text-xs font-semibold text-gray-500">Payment:</label>
                    <select id="paymentStatusFilter" wire:model.live="paymentStatusFilter"
                        class="text-xs font-medium px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                        <option value="all">All Payments</option>
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="text-xs tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-4">
                            Order # / Date
                        </th>
                        <th class="px-6 py-4">
                            Customer
                        </th>
                        <th class="px-6 py-4">
                            Items
                        </th>
                        <th class="px-6 py-4 text-right">
                            Total Amount
                        </th>
                        <th class="px-6 py-4">
                            Payment
                        </th>
                        <th class="px-6 py-4">
                            Order Status
                        </th>
                        <th class="px-6 py-4 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                        <tr class="transition-colors hover:bg-gray-50">
                            
                            {{-- Order Number & Date --}}
                            <td class="px-6 py-4">
                                <div class="font-bold text-blue-600 font-mono text-sm">
                                    <a wire:navigate href="{{ route('admin.orders.view', $order) }}" class="hover:underline">
                                        {{ $order->order_number }}
                                    </a>
                                </div>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    {{ $order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A' }}
                                </div>
                            </td>

                            {{-- Customer Info --}}
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $order->full_name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->email }}
                                </div>
                                <div class="text-[11px] text-gray-400">
                                    {{ $order->city }}, {{ $order->country }}
                                </div>
                            </td>

                            {{-- Items Count --}}
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-semibold bg-gray-100 text-gray-800">
                                    {{ $order->items->sum('quantity') }} {{ Str::plural('item', $order->items->sum('quantity')) }}
                                </span>
                            </td>

                            {{-- Total Amount --}}
                            <td class="px-6 py-4 text-right">
                                <div class="font-bold text-gray-900">
                                    Rs. {{ number_format($order->total_amount, 2) }}
                                </div>
                                @if ($order->discount_amount > 0)
                                    <div class="text-[11px] text-emerald-600">
                                        - Rs. {{ number_format($order->discount_amount, 2) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Payment Details --}}
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 items-start">
                                    <span class="text-xs font-bold uppercase text-gray-700">
                                        {{ $order->payment_method }}
                                    </span>
                                    <x-common.admin.badges.status :status="$order->payment_status" />
                                </div>
                            </td>

                            {{-- Order Status --}}
                            <td class="px-6 py-4">
                                <x-common.admin.badges.status :status="$order->status" />
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    {{-- View Details --}}
                                    <a wire:navigate href="{{ route('admin.orders.view', $order) }}" title="View Order Details"
                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-semibold rounded-lg bg-green-100 text-green-800 hover:bg-green-200 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        View
                                    </a>

                                    <span class="text-gray-200 select-none">|</span>

                                    {{-- Delete --}}
                                    <button wire:click="confirmDelete({{ $order->id }})" title="Delete Order"
                                        class="inline-flex items-center p-1.5 text-xs font-semibold rounded-lg bg-red-100 text-red-800 hover:bg-red-200 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                No orders found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <x-common.admin.tables.pagination :records="$orders" />

    </div>

    {{-- Delete Modal --}}
    <x-common.admin.modals.delete-confirmation :show="$deleteId" title="Delete Order" :item-name="$deleteName"
        cancel-action="cancelDelete" confirm-action="deleteOrder" confirm-text="Delete Order"
        loading-target="deleteOrder" />

</div>
