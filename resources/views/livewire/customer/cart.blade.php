<div class="min-h-screen bg-gray-50/50 py-10 pt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumbs & Header --}}
        <div class="mb-8">
            <nav class="flex items-center text-sm font-medium text-gray-500 mb-3 space-x-2">
                <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-gray-900 font-semibold">Shopping Cart</span>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Shopping Cart</h1>
                    @if ($this->totalCount > 0)
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-bold bg-indigo-100 text-indigo-800">
                            {{ $this->totalCount }} {{ Str::plural('item', $this->totalCount) }}
                        </span>
                    @endif
                </div>

                @if (! $this->isEmpty)
                    <button wire:click="clear"
                        wire:confirm="Are you sure you want to clear your cart?"
                        class="inline-flex items-center gap-1.5 text-sm font-medium text-red-600 hover:text-red-700 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Clear Cart
                    </button>
                @endif
            </div>
        </div>

        {{-- Flash Notification Messages --}}
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session()->has('warning'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="mb-6 p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 flex items-center justify-between shadow-xs transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-sm font-medium">{{ session('warning') }}</p>
                </div>
                <button @click="show = false" class="text-amber-500 hover:text-amber-700">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session()->has('error'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs transition">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($this->isEmpty)
            {{-- Empty Cart State --}}
            <div class="bg-white rounded-2xl p-12 text-center shadow-xs border border-gray-100 max-w-xl mx-auto my-12">
                <div class="w-24 h-24 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Your Cart is Empty</h2>
                <p class="text-gray-500 mb-8 text-base">Looks like you haven't added any products to your cart yet. Discover our top collections and best deals!</p>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-full font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all duration-200 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0" />
                    </svg>
                    Start Shopping
                </a>
            </div>
        @else
            {{-- Active Cart Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- Left Column: Items List (8 cols) --}}
                <div class="lg:col-span-8 space-y-4">

                    {{-- Free Shipping Meter --}}
                    <div class="bg-gradient-to-r from-blue-500/10 via-indigo-500/10 to-purple-500/10 border border-indigo-100 rounded-2xl p-5">
                        <div class="flex items-center justify-between text-sm font-semibold mb-2">
                            <span class="flex items-center gap-2 text-indigo-900">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                @if ($this->subtotal >= $this->freeShippingThreshold)
                                    🎉 Congratulations! You unlocked <strong class="text-indigo-700">FREE Delivery</strong>
                                @else
                                    Add <strong class="text-indigo-700">Rs. {{ number_format($this->freeShippingThreshold - $this->subtotal, 2) }}</strong> more for <strong class="text-indigo-700">FREE Delivery</strong>
                                @endif
                            </span>
                            <span class="text-xs font-bold text-indigo-600">
                                {{ min(100, round(($this->subtotal / $this->freeShippingThreshold) * 100)) }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-500"
                                style="width: {{ min(100, round(($this->subtotal / $this->freeShippingThreshold) * 100)) }}%">
                            </div>
                        </div>
                    </div>

                    {{-- Cart Items Table / Cards --}}
                    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden divide-y divide-gray-100">
                        @foreach ($cart as $id => $item)
                            <div wire:key="cart-item-{{ $id }}" class="p-6 transition hover:bg-gray-50/50">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    
                                    {{-- Product Info & Thumbnail --}}
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden shrink-0 flex items-center justify-center p-2 border border-gray-100">
                                            @if (!empty($item['image']))
                                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                            @else
                                                <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="space-y-1">
                                            <h3 class="font-bold text-gray-900 text-base leading-snug hover:text-indigo-600 transition">
                                                {{ $item['name'] }}
                                            </h3>

                                            @if (!empty($item['warranty']))
                                                <div class="inline-flex items-center gap-1 text-xs text-gray-500 font-medium bg-gray-100 px-2 py-0.5 rounded-md">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                    Warranty: {{ $item['warranty'] }}
                                                </div>
                                            @endif

                                            <div class="flex items-baseline gap-2 pt-0.5">
                                                <span class="text-sm font-bold text-gray-900">
                                                    Rs. {{ number_format($item['price'], 2) }}
                                                </span>
                                                @if (!empty($item['original_price']) && $item['original_price'] > $item['price'])
                                                    <span class="text-xs text-gray-400 line-through">
                                                        Rs. {{ number_format($item['original_price'], 2) }}
                                                    </span>
                                                    <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded-sm">
                                                        Save {{ round((($item['original_price'] - $item['price']) / $item['original_price']) * 100) }}%
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Quantity Controls & Line Subtotal --}}
                                    <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto pt-3 sm:pt-0 border-t sm:border-t-0 border-gray-100">
                                        
                                        {{-- Quantity Selector Spinner --}}
                                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden bg-white shadow-2xs">
                                            <button wire:click="decrement({{ $id }})"
                                                wire:loading.attr="disabled"
                                                class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition disabled:opacity-50">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4" />
                                                </svg>
                                            </button>

                                            <span class="w-10 text-center text-sm font-bold text-gray-800">
                                                {{ $item['quantity'] }}
                                            </span>

                                            <button wire:click="increment({{ $id }})"
                                                wire:loading.attr="disabled"
                                                class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition disabled:opacity-50">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Item Total --}}
                                        <div class="text-right min-w-28">
                                            <span class="block text-xs text-gray-400 font-medium">Subtotal</span>
                                            <span class="text-base font-extrabold text-gray-900">
                                                Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </span>
                                        </div>

                                        {{-- Remove Item Button --}}
                                        <button wire:click="remove({{ $id }})"
                                            wire:loading.attr="disabled"
                                            title="Remove item"
                                            class="text-gray-400 hover:text-red-600 p-2 rounded-lg hover:bg-red-50 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Back to Shopping Link --}}
                    <div class="pt-2">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Continue Shopping
                        </a>
                    </div>
                </div>

                {{-- Right Column: Order Summary (4 cols) --}}
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 sticky top-28 space-y-6">
                        <h2 class="text-xl font-bold text-gray-900 border-b border-gray-100 pb-4">Order Summary</h2>

                        {{-- Coupon Promo Code Section --}}
                        <div>
                            <label for="couponCode" class="block text-xs font-semibold text-gray-700 mb-1.5 uppercase tracking-wider">
                                Promo / Coupon Code
                            </label>
                            
                            @if ($appliedCoupon)
                                <div class="flex items-center justify-between p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-xs font-semibold text-emerald-800">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span>{{ $appliedCoupon }}</span>
                                    </div>
                                    <button wire:click="removeCoupon" class="text-emerald-700 hover:text-emerald-900 text-xs font-bold underline">
                                        Remove
                                    </button>
                                </div>
                            @else
                                <div class="flex gap-2">
                                    <input type="text" id="couponCode" wire:model="couponCode"
                                        placeholder="Try SIMPLY10 or SAVE500"
                                        class="flex-1 px-4 py-2.5 rounded-xl text-sm border border-gray-200 focus:outline-hidden focus:ring-2 focus:ring-indigo-600 uppercase placeholder:normal-case font-medium">
                                    <button wire:click="applyCoupon"
                                        wire:loading.attr="disabled"
                                        class="px-4 py-2.5 rounded-xl text-sm font-semibold bg-gray-900 text-white hover:bg-gray-800 transition disabled:opacity-50">
                                        Apply
                                    </button>
                                </div>
                                @if (session()->has('coupon_error'))
                                    <p class="text-xs text-rose-600 mt-1.5 font-medium">{{ session('coupon_error') }}</p>
                                @endif
                                @if (session()->has('coupon_success'))
                                    <p class="text-xs text-emerald-600 mt-1.5 font-medium">{{ session('coupon_success') }}</p>
                                @endif
                            @endif
                        </div>

                        {{-- Calculation Breakdown --}}
                        <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Original Price</span>
                                <span class="font-medium text-gray-800">Rs. {{ number_format($this->originalSubtotal, 2) }}</span>
                            </div>

                            @if ($this->productSavings > 0)
                                <div class="flex justify-between text-emerald-600 font-medium">
                                    <span>Product Discount</span>
                                    <span>- Rs. {{ number_format($this->productSavings, 2) }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-gray-800 font-semibold">
                                <span>Items Subtotal</span>
                                <span>Rs. {{ number_format($this->subtotal, 2) }}</span>
                            </div>

                            @if ($this->discountAmount > 0)
                                <div class="flex justify-between text-emerald-600 font-medium">
                                    <span>Coupon Discount</span>
                                    <span>- Rs. {{ number_format($this->discountAmount, 2) }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-gray-600">
                                <span>Estimated Shipping</span>
                                @if ($this->shipping == 0)
                                    <span class="font-semibold text-emerald-600 uppercase text-xs">FREE</span>
                                @else
                                    <span class="font-medium text-gray-800">Rs. {{ number_format($this->shipping, 2) }}</span>
                                @endif
                            </div>

                            {{-- Grand Total --}}
                            <div class="border-t border-gray-200 pt-4 mt-2 flex justify-between items-baseline">
                                <div>
                                    <span class="text-base font-bold text-gray-900">Total</span>
                                    <span class="block text-xs text-gray-400">Includes all applicable taxes</span>
                                </div>
                                <span class="text-2xl font-black text-indigo-600">
                                    Rs. {{ number_format($this->total, 2) }}
                                </span>
                            </div>
                        </div>

                        {{-- Installment Plan Banner --}}
                        <div class="p-3.5 bg-blue-50/70 border border-blue-100 rounded-xl text-xs text-blue-900 leading-relaxed">
                            <p class="font-semibold">Or pay in 3 interest-free installments:</p>
                            <p class="text-blue-700 mt-0.5">
                                <strong>3 x Rs. {{ number_format($this->total / 3, 2) }}</strong> with <strong>MintPay</strong> or <strong>KOKO</strong>.
                            </p>
                        </div>

                        {{-- Checkout Action Button --}}
                        <div class="space-y-3">
                            <a href="{{ route('checkout') }}"
                                class="w-full py-4 px-6 rounded-full font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2 text-base">
                                <span>Proceed to Checkout</span>
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>

                            <div class="flex items-center justify-center gap-4 text-gray-400 text-xs pt-1">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    100% Secure Checkout
                                </span>
                                <span>•</span>
                                <span>Official Warranty</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @endif

    </div>
</div>
