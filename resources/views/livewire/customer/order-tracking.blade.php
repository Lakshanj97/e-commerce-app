<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Track Order</span>
        </nav>

        {{-- Page Header --}}
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Real-Time Logistics</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Track Your Shipment
            </h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">
                Enter your order reference code (e.g. <code>ORD-...</code>) or the billing email you used during checkout.
            </p>
        </div>

        {{-- Tracking Input Form Card --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gray-100 shadow-sm mb-10">
            <form wire:submit.prevent="trackOrder" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input wire:model="orderQuery" type="text" placeholder="Enter Order Number or Email address..."
                        class="w-full pl-11 pr-4 py-3.5 rounded-2xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                </div>
                <button type="submit" wire:loading.attr="disabled"
                    class="px-8 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-md shadow-blue-600/20 shrink-0">
                    <span wire:loading.remove wire:target="trackOrder">Track Shipment &rarr;</span>
                    <span wire:loading wire:target="trackOrder">Searching...</span>
                </button>
            </form>
            @error('orderQuery')
                <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
            @enderror

            @if (session()->has('track_error'))
                <div class="mt-4 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('track_error') }}</span>
                </div>
            @endif
        </div>

        {{-- Order Results Section --}}
        @if ($order)
            @php
                $status = strtolower($order->status);
                $step = match($status) {
                    'pending' => 1,
                    'processing' => 2,
                    'shipped' => 3,
                    'delivered' => 4,
                    'cancelled' => 0,
                    default => 1,
                };
            @endphp

            <div class="bg-white rounded-3xl p-6 sm:p-10 border border-gray-100 shadow-sm space-y-8">

                {{-- Order Summary Header --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-gray-100">
                    <div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Order Details</span>
                        <h2 class="text-xl font-black text-gray-900 mt-0.5">{{ $order->order_number }}</h2>
                        <p class="text-xs text-gray-500 mt-0.5">Placed on {{ $order->created_at?->format('M d, Y - h:i A') }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                            {{ $status === 'delivered' ? 'bg-emerald-100 text-emerald-800' : '' }}
                            {{ $status === 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $status === 'processing' ? 'bg-amber-100 text-amber-800' : '' }}
                            {{ $status === 'pending' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                        ">
                            ● {{ ucfirst($status) }}
                        </span>
                        <span class="text-xs font-black text-gray-900 bg-gray-100 px-3.5 py-1.5 rounded-full">
                            Rs. {{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>

                {{-- Visual Progress Timeline (if not cancelled) --}}
                @if ($status !== 'cancelled')
                    <div class="py-4">
                        <div class="relative flex items-center justify-between">
                            {{-- Line Background --}}
                            <div class="absolute left-6 right-6 top-1/2 -translate-y-1/2 h-1 bg-gray-200 z-0"></div>
                            {{-- Line Active Progress --}}
                            @php
                                $width = match($step) {
                                    1 => '10%',
                                    2 => '45%',
                                    3 => '75%',
                                    4 => '100%',
                                    default => '10%',
                                };
                            @endphp
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 h-1 bg-blue-600 z-0 transition-all duration-500" style="width: {{ $width }};"></div>

                            {{-- Step 1 --}}
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs {{ $step >= 1 ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'bg-gray-200 text-gray-500' }}">
                                    ✓
                                </div>
                                <span class="text-[11px] font-bold mt-2 text-gray-800">Order Placed</span>
                                <span class="text-[9px] text-gray-400">Confirmed</span>
                            </div>

                            {{-- Step 2 --}}
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs {{ $step >= 2 ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'bg-gray-200 text-gray-500' }}">
                                    {{ $step >= 2 ? '✓' : '2' }}
                                </div>
                                <span class="text-[11px] font-bold mt-2 text-gray-800">Processing</span>
                                <span class="text-[9px] text-gray-400">Warehouse Pack</span>
                            </div>

                            {{-- Step 3 --}}
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs {{ $step >= 3 ? 'bg-blue-600 text-white shadow-md shadow-blue-500/30' : 'bg-gray-200 text-gray-500' }}">
                                    {{ $step >= 3 ? '✓' : '3' }}
                                </div>
                                <span class="text-[11px] font-bold mt-2 text-gray-800">Dispatched</span>
                                <span class="text-[9px] text-gray-400">With Courier</span>
                            </div>

                            {{-- Step 4 --}}
                            <div class="relative z-10 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-xs {{ $step >= 4 ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/30' : 'bg-gray-200 text-gray-500' }}">
                                    {{ $step >= 4 ? '✓' : '4' }}
                                </div>
                                <span class="text-[11px] font-bold mt-2 text-gray-800">Delivered</span>
                                <span class="text-[9px] text-gray-400">Completed</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs">
                        This order was cancelled. If you believe this is an error, please reach out to customer support.
                    </div>
                @endif

                {{-- Ordered Items Table / List --}}
                <div>
                    <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wider text-xs">Package Contents</h3>
                    <div class="divide-y divide-gray-100">
                        @foreach ($order->items as $item)
                            @php
                                $img = null;
                                if ($item->product) {
                                    $urls = $item->product->image_urls;
                                    $img = $urls[0] ?? null;
                                }
                            @endphp
                            <div class="py-3 flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-xl bg-gray-50 p-1 flex items-center justify-center shrink-0 border border-gray-100 overflow-hidden">
                                        @if ($img)
                                            <img src="{{ $img }}" alt="{{ $item->product_name }}" class="object-contain h-full">
                                        @else
                                            <span class="text-[10px] text-gray-400">📦</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-gray-900 leading-snug">{{ $item->product_name }}</p>
                                        <p class="text-[11px] text-gray-500 mt-0.5">Quantity: {{ $item->quantity }} × Rs. {{ number_format($item->price, 2) }}</p>
                                    </div>
                                </div>
                                <span class="text-xs font-black text-gray-900">
                                    Rs. {{ number_format($item->subtotal, 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Shipping & Payment Breakdown --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                    <div class="bg-gray-50 rounded-2xl p-4 text-xs">
                        <p class="font-bold text-gray-900 uppercase tracking-wider text-[10px] mb-2">Shipping Destination</p>
                        <p class="font-semibold text-gray-800">{{ $order->full_name }}</p>
                        <p class="text-gray-600 mt-0.5">{{ $order->address }}</p>
                        <p class="text-gray-600">{{ $order->city }}, {{ $order->postal_code }}</p>
                        <p class="text-gray-500 mt-1">Phone: {{ $order->phone }}</p>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4 text-xs">
                        <p class="font-bold text-gray-900 uppercase tracking-wider text-[10px] mb-2">Payment Info</p>
                        <p class="text-gray-600">Method: <strong class="text-gray-900 uppercase">{{ $order->payment_method ?? 'COD' }}</strong></p>
                        <p class="text-gray-600 mt-1">Status: <strong class="text-gray-900 uppercase">{{ $order->payment_status ?? 'Pending' }}</strong></p>
                        <p class="text-gray-600 mt-1">Subtotal: Rs. {{ number_format($order->subtotal, 2) }}</p>
                        <p class="text-gray-600">Shipping: Rs. {{ number_format($order->shipping_amount, 2) }}</p>
                        <p class="text-gray-900 font-bold mt-1 text-sm">Total: Rs. {{ number_format($order->total_amount, 2) }}</p>
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>
