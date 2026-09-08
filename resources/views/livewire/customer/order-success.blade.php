<div class="min-h-screen bg-gray-50/50 py-16 pt-28">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xs border border-gray-100 text-center space-y-6">
            
            {{-- Success Icon --}}
            <div class="w-20 h-20 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto shadow-xs">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div class="space-y-2">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Thank You for Your Order!</h1>
                <p class="text-gray-500 text-base">
                    We've received your order and we're getting it ready for delivery.
                </p>
            </div>

            {{-- Order Summary Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm font-bold text-gray-800">
                <span>Order Reference:</span>
                <span class="text-indigo-600 font-mono">{{ $order->order_number }}</span>
            </div>

            {{-- Order Details Details Box --}}
            <div class="text-left bg-gray-50/70 rounded-2xl p-6 border border-gray-100 space-y-4">
                <h2 class="text-base font-bold text-gray-900 border-b border-gray-200 pb-3">Order Information</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase">Customer</span>
                        <p class="font-bold text-gray-800 mt-0.5">{{ $order->full_name }}</p>
                        <p class="text-gray-600 text-xs">{{ $order->email }}</p>
                        <p class="text-gray-600 text-xs">{{ $order->phone }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase">Delivery Address</span>
                        <p class="text-gray-800 font-medium mt-0.5">{{ $order->address }}</p>
                        <p class="text-gray-600 text-xs">{{ $order->city }}, {{ $order->country }}</p>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase">Payment Method</span>
                        <p class="font-bold text-gray-800 mt-0.5 uppercase">{{ $order->payment_method }}</p>
                        <span class="inline-block px-2 py-0.5 rounded-sm text-xs font-bold mt-1 {{ $order->payment_status === 'paid' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ strtoupper($order->payment_status) }}
                        </span>
                    </div>

                    <div>
                        <span class="block text-xs font-semibold text-gray-400 uppercase">Total Paid</span>
                        <p class="font-black text-xl text-indigo-600 mt-0.5">Rs. {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

                {{-- Purchased Items --}}
                <div class="border-t border-gray-200 pt-4 space-y-2">
                    <span class="block text-xs font-semibold text-gray-400 uppercase mb-2">Purchased Items ({{ $order->items->count() }})</span>
                    @foreach ($order->items as $item)
                        <div class="flex justify-between text-sm py-1">
                            <span class="text-gray-800">{{ $item->product_name }} <strong class="text-gray-500 font-normal">× {{ $item->quantity }}</strong></span>
                            <span class="font-semibold text-gray-900">Rs. {{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Action CTA --}}
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('home') }}"
                    class="w-full sm:w-auto px-8 py-3.5 rounded-full font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition">
                    Continue Shopping
                </a>
            </div>

        </div>

    </div>
</div>
