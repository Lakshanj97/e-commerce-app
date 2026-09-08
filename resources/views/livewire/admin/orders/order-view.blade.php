<div>
    <x-common.admin.alerts.success />
    <x-common.admin.alerts.error />

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Order Details
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Order <span class="font-mono font-bold text-blue-600">#{{ $order->order_number }}</span> • Placed on {{ $order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A' }}
            </p>
        </div>
        <div class="flex gap-3">
            <a wire:navigate href="{{ route('admin.orders.index') }}"
                class="px-6 py-2 text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                ← Back to Orders
            </a>
        </div>
    </div>

    {{-- Main Order Info Card --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden shadow-xs mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-slate-700">

            {{-- Left Column: Customer & Delivery Info --}}
            <div class="p-6 space-y-5">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Customer & Delivery Details</h3>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Customer Name</p>
                    <p class="text-sm font-bold text-gray-800 dark:text-white">{{ $order->full_name }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Email Address</p>
                        <p class="text-sm text-gray-800 dark:text-white font-medium">{{ $order->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Phone Number</p>
                        <p class="text-sm text-gray-800 dark:text-white font-medium">{{ $order->phone }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Delivery Address</p>
                    <p class="text-sm text-gray-800 dark:text-white">{{ $order->address }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $order->city }}, {{ $order->state ? $order->state . ', ' : '' }}{{ $order->postal_code ? $order->postal_code . ', ' : '' }}{{ $order->country }}</p>
                </div>

                @if ($order->notes)
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Customer Delivery Notes</p>
                        <div class="text-xs text-gray-700 dark:text-gray-300 p-3 bg-gray-50 dark:bg-slate-700 rounded-lg border border-gray-200 dark:border-slate-600">
                            {{ $order->notes }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Column: Payment, Status & Pricing --}}
            <div class="p-6 space-y-5">
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Status & Payment Summary</h3>

                {{-- Status Management Form --}}
                <div class="p-4 bg-gray-50 dark:bg-slate-700/50 rounded-xl border border-gray-200 dark:border-slate-600 space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="status" class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Order Status</label>
                            <select id="status" wire:model="status"
                                class="w-full text-xs font-medium px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label for="paymentStatus" class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Payment Status</label>
                            <select id="paymentStatus" wire:model="paymentStatus"
                                class="w-full text-xs font-medium px-3 py-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-600 rounded-lg focus:outline-hidden focus:ring-2 focus:ring-blue-500">
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-1">
                        <button wire:click="updateStatus"
                            wire:loading.attr="disabled"
                            class="px-4 py-1.5 text-xs font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition disabled:opacity-50">
                            Save Changes
                        </button>
                    </div>
                </div>

                {{-- Price Breakdown Cards --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600">
                        <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                        <p class="text-base font-bold text-gray-800 dark:text-white">Rs. {{ number_format($order->subtotal, 2) }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-slate-700 rounded-lg p-3 border border-gray-200 dark:border-slate-600">
                        <p class="text-xs text-gray-500 mb-1">Grand Total</p>
                        <p class="text-base font-black text-blue-600">Rs. {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                <div class="text-xs space-y-1.5 text-gray-600 dark:text-gray-300">
                    <div class="flex justify-between">
                        <span>Payment Method:</span>
                        <strong class="uppercase text-gray-900 dark:text-white">{{ $order->payment_method }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Delivery Fee:</span>
                        <span>Rs. {{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    @if ($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-600">
                            <span>Discount:</span>
                            <span>- Rs. {{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    @if ($order->stripe_session_id)
                        <div class="flex justify-between font-mono text-[11px] pt-1">
                            <span>Stripe ID:</span>
                            <span class="truncate max-w-[200px]">{{ $order->stripe_session_id }}</span>
                        </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- Purchased Items Section --}}
        <div class="p-6 border-t border-gray-200 dark:border-slate-700">
            <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Ordered Items ({{ $order->items->count() }})</h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="text-xs text-left text-gray-500 uppercase bg-gray-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Warranty</th>
                            <th class="px-4 py-3 text-right">Unit Price</th>
                            <th class="px-4 py-3 text-center">Qty</th>
                            <th class="px-4 py-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-700 text-sm">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden shrink-0 flex items-center justify-center p-1 border border-gray-200">
                                            @if ($item->product_image)
                                                <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="w-full h-full object-contain">
                                            @else
                                                <svg class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 dark:text-white">{{ $item->product_name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-xs text-gray-500">
                                    {{ $item->warranty ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-right font-medium text-gray-800 dark:text-white">
                                    Rs. {{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-4 py-3 text-center font-bold text-gray-800 dark:text-white">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-gray-900 dark:text-white">
                                    Rs. {{ number_format($item->subtotal, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="flex justify-end gap-4 px-6 py-4 border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800">
            <button wire:click="confirmDelete"
                class="px-4 py-2 text-sm font-medium text-red-600 bg-red-100 rounded-lg hover:bg-red-200 transition">
                Delete Order
            </button>
        </div>

    </div>

    {{-- Delete Modal --}}
    <x-common.admin.modals.delete-confirmation :show="$deleteId" title="Delete Order" :item-name="$deleteName"
        cancel-action="cancelDelete" confirm-action="deleteOrder" confirm-text="Delete Order"
        loading-target="deleteOrder" />

</div>
