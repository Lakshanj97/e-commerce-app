<div class="min-h-screen bg-gray-50/50 py-10 pt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center text-sm font-medium text-gray-500 mb-6 space-x-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="{{ route('cart') }}" class="hover:text-indigo-600 transition">Cart</a>
            <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-900 font-semibold">Checkout</span>
        </nav>

        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-8">Secure Checkout</h1>

        {{-- Alert Messages --}}
        @if (session()->has('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-3 shadow-xs">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <form wire:submit="processCheckout">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- Left Column: Checkout Forms (8 cols) --}}
                <div class="lg:col-span-8 space-y-6">

                    {{-- 1. Contact Information --}}
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-xs border border-gray-100 space-y-6">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm">1</span>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Contact Information</h2>
                                <p class="text-xs text-gray-500">We'll send the order confirmation and tracking details here.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="firstName" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">First Name <span class="text-rose-500">*</span></label>
                                <input type="text" id="firstName" wire:model.blur="firstName"
                                    placeholder="John"
                                    class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('firstName') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                @error('firstName') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="lastName" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Last Name <span class="text-rose-500">*</span></label>
                                <input type="text" id="lastName" wire:model.blur="lastName"
                                    placeholder="Doe"
                                    class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('lastName') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                @error('lastName') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Email Address <span class="text-rose-500">*</span></label>
                                <input type="email" id="email" wire:model.blur="email"
                                    placeholder="john.doe@example.com"
                                    class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('email') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                @error('email') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Phone Number <span class="text-rose-500">*</span></label>
                                <input type="tel" id="phone" wire:model.blur="phone"
                                    placeholder="+94 77 123 4567"
                                    class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('phone') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                @error('phone') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 2. Shipping Address --}}
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-xs border border-gray-100 space-y-6">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm">2</span>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Shipping Address</h2>
                                <p class="text-xs text-gray-500">Where should we deliver your package?</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="address" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Street Address <span class="text-rose-500">*</span></label>
                                <input type="text" id="address" wire:model.blur="address"
                                    placeholder="No. 123, Galle Road"
                                    class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('address') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                @error('address') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="city" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">City <span class="text-rose-500">*</span></label>
                                    <input type="text" id="city" wire:model.blur="city"
                                        placeholder="Colombo"
                                        class="w-full px-4 py-2.5 rounded-xl border text-sm {{ $errors->has('city') ? 'border-rose-300 bg-rose-50/30' : 'border-gray-200' }} focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                    @error('city') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="state" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Province / State</label>
                                    <input type="text" id="state" wire:model.blur="state"
                                        placeholder="Western Province"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                </div>

                                <div>
                                    <label for="postalCode" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Postal Code</label>
                                    <input type="text" id="postalCode" wire:model.blur="postalCode"
                                        placeholder="00300"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium">
                                </div>
                            </div>

                            <div>
                                <label for="country" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Country <span class="text-rose-500">*</span></label>
                                <input type="text" id="country" wire:model.blur="country"
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium bg-gray-50/50">
                                @error('country') <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="notes" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Delivery Notes (Optional)</label>
                                <textarea id="notes" wire:model.blur="notes" rows="2"
                                    placeholder="Special instructions for courier (e.g. Landmark, bell code)..."
                                    class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-hidden focus:ring-2 focus:ring-indigo-600 font-medium"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 3. Payment Method --}}
                    <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-xs border border-gray-100 space-y-6">
                        <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                            <span class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm">3</span>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Payment Method</h2>
                                <p class="text-xs text-gray-500">Choose how you would like to complete your order.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            
                            {{-- Stripe Option --}}
                            <label class="relative flex flex-col p-5 border-2 rounded-2xl cursor-pointer transition {{ $paymentMethod === 'stripe' ? 'border-indigo-600 bg-indigo-50/20' : 'border-gray-200 hover:border-gray-300' }}">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="paymentMethod" value="stripe" wire:model.live="paymentMethod"
                                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                        <span class="font-bold text-gray-900 text-sm">Stripe Checkout</span>
                                    </div>
                                    <span class="text-[11px] font-semibold text-indigo-600 bg-indigo-100 px-2 py-0.5 rounded-md">Instant</span>
                                </div>
                                <p class="text-xs text-gray-500 leading-relaxed pl-7">
                                    Pay securely via Stripe using Visa, MasterCard, American Express, Apple Pay, or Google Pay.
                                </p>
                            </label>

                            {{-- Cash on Delivery (COD) Option --}}
                            <label class="relative flex flex-col p-5 border-2 rounded-2xl cursor-pointer transition {{ $paymentMethod === 'cod' ? 'border-indigo-600 bg-indigo-50/20' : 'border-gray-200 hover:border-gray-300' }}">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="paymentMethod" value="cod" wire:model.live="paymentMethod"
                                            class="w-4 h-4 text-indigo-600 focus:ring-indigo-500">
                                        <span class="font-bold text-gray-900 text-sm">Cash on Delivery</span>
                                    </div>
                                    <span class="text-[11px] font-semibold text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-md">COD</span>
                                </div>
                                <p class="text-xs text-gray-500 leading-relaxed pl-7">
                                    Pay in cash or credit card directly to the courier agent when your package is delivered.
                                </p>
                            </label>
                        </div>
                    </div>

                </div>

                {{-- Right Column: Order Summary (4 cols) --}}
                <div class="lg:col-span-4 space-y-6">
                    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-6 sticky top-28 space-y-6">
                        
                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <h2 class="text-lg font-bold text-gray-900">Order Summary</h2>
                            <span class="text-xs font-semibold text-gray-500">{{ $this->totalCount }} {{ Str::plural('item', $this->totalCount) }}</span>
                        </div>

                        {{-- Item list thumbnail review --}}
                        <div class="max-h-64 overflow-y-auto space-y-3 pr-1 divide-y divide-gray-100">
                            @foreach ($cart as $item)
                                <div class="flex items-center gap-3 pt-3 first:pt-0">
                                    <div class="w-14 h-14 bg-gray-100 rounded-xl overflow-hidden shrink-0 flex items-center justify-center p-1.5 border border-gray-100 relative">
                                        @if (!empty($item['image']))
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                        @else
                                            <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        @endif
                                        <span class="absolute -top-1 -right-1 bg-gray-800 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                                            {{ $item['quantity'] }}
                                        </span>
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-gray-900 truncate">{{ $item['name'] }}</p>
                                        <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }} × Rs. {{ number_format($item['price'], 2) }}</p>
                                    </div>

                                    <span class="text-xs font-bold text-gray-900">
                                        Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Calculation Breakdown --}}
                        <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                            <div class="flex justify-between text-gray-600">
                                <span>Items Subtotal</span>
                                <span class="font-medium text-gray-900">Rs. {{ number_format($this->subtotal, 2) }}</span>
                            </div>

                            @if ($this->discountAmount > 0)
                                <div class="flex justify-between text-emerald-600 font-medium">
                                    <span>Discount</span>
                                    <span>- Rs. {{ number_format($this->discountAmount, 2) }}</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-gray-600">
                                <span>Delivery Fee</span>
                                @if ($this->shipping == 0)
                                    <span class="font-bold text-emerald-600 text-xs uppercase">FREE</span>
                                @else
                                    <span class="font-medium text-gray-900">Rs. {{ number_format($this->shipping, 2) }}</span>
                                @endif
                            </div>

                            <div class="border-t border-gray-200 pt-4 flex justify-between items-baseline">
                                <div>
                                    <span class="text-base font-bold text-gray-900">Total Payable</span>
                                    <span class="block text-xs text-gray-400">LKR Currency</span>
                                </div>
                                <span class="text-2xl font-black text-indigo-600">
                                    Rs. {{ number_format($this->total, 2) }}
                                </span>
                            </div>
                        </div>

                        {{-- Submit Button with Livewire Loading States --}}
                        <div class="space-y-3">
                            <button type="submit"
                                wire:loading.attr="disabled"
                                class="w-full py-4 px-6 rounded-full font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all duration-200 hover:-translate-y-0.5 flex items-center justify-center gap-2 text-base disabled:opacity-50 disabled:cursor-not-allowed">
                                
                                <span wire:loading.remove wire:target="processCheckout">
                                    @if ($paymentMethod === 'stripe')
                                        Pay Rs. {{ number_format($this->total, 2) }} via Stripe
                                    @else
                                        Confirm & Place Order (COD)
                                    @endif
                                </span>

                                <span wire:loading wire:target="processCheckout" class="flex items-center gap-2">
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Redirecting to Stripe...
                                </span>
                            </button>

                            <div class="text-center text-xs text-gray-400 pt-1 space-y-1">
                                <p>🔒 256-Bit SSL Encrypted & Stripe Secured</p>
                                <p>By completing this order you agree to our Terms of Service.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
</div>
