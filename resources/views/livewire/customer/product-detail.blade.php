<div>
    <div class="max-w-7xl mx-auto px-4 py-8 pt-28">

        {{-- Flash success --}}
        @if (session('success'))
            <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-3.5 rounded-2xl text-sm font-medium">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-3.5 rounded-2xl text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        {{-- Breadcrumb --}}
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-indigo-600 transition">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-indigo-600 transition">Shop</a>
            @if ($product->category)
                <span>/</span>
                <span class="text-gray-400">{{ $product->category->name }}</span>
            @endif
            <span>/</span>
            <span class="text-gray-700 font-medium">{{ Str::limit($product->name, 40) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

            {{-- ─── Image Gallery ───────────────────────────────────── --}}
            <div>
                @php
                    $images = $product->image_urls;
                    if (empty($images)) {
                        $images = ['https://via.placeholder.com/800x800?text=No+Image'];
                    }
                @endphp

                {{-- Main Image --}}
                <div class="relative bg-gray-50 rounded-3xl overflow-hidden mb-4 flex items-center justify-center h-[420px] border border-gray-100 shadow-sm group">
                    <img src="{{ $activeImage ?: $images[0] }}" alt="{{ $product->name }}"
                        id="main-product-image"
                        class="object-contain max-h-full max-w-full p-8 transition-transform duration-300 group-hover:scale-105">

                    @if ($product->original_price > $product->selling_price)
                        @php $discount = round((($product->original_price - $product->selling_price) / $product->original_price) * 100); @endphp
                        <span class="absolute top-4 left-4 bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full shadow">-{{ $discount }}%</span>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if (count($images) > 1)
                    <div class="flex gap-3 overflow-x-auto pb-2">
                        @foreach ($images as $i => $img)
                            <button wire:click="setActiveImage('{{ $img }}')"
                                class="shrink-0 w-20 h-20 rounded-xl overflow-hidden border-2 transition {{ ($activeImage === $img || ($i === 0 && !$activeImage)) ? 'border-indigo-500 shadow-md' : 'border-gray-200 hover:border-indigo-300' }}">
                                <img src="{{ $img }}" alt="Thumbnail {{ $i + 1 }}" class="w-full h-full object-contain p-1">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- ─── Product Info ─────────────────────────────────────── --}}
            <div class="flex flex-col">

                {{-- Brand + Category badges --}}
                <div class="flex items-center gap-2 mb-3">
                    @if ($product->brand)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-semibold">
                            {{ $product->brand->name }}
                        </span>
                    @endif
                    @if ($product->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-medium">
                            {{ $product->category->name }}
                        </span>
                    @endif
                </div>

                {{-- Product Name --}}
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-snug mb-4">
                    {{ $product->name }}
                </h1>

                {{-- Star Rating (static) --}}
                <div class="flex items-center gap-2 mb-4">
                    <x-common.customer.star-review />
                    <span class="text-sm text-gray-500">(Reviews)</span>
                </div>

                {{-- Price --}}
                <div class="flex items-baseline gap-3 mb-2">
                    <span class="text-3xl font-extrabold text-gray-900">Rs. {{ number_format($product->selling_price, 2) }}</span>
                    @if ($product->original_price > $product->selling_price)
                        <span class="text-lg text-gray-400 line-through font-medium">Rs. {{ number_format($product->original_price, 2) }}</span>
                        <span class="text-green-600 text-sm font-bold bg-green-50 px-2 py-0.5 rounded-lg">
                            Save Rs. {{ number_format($product->original_price - $product->selling_price, 2) }}
                        </span>
                    @endif
                </div>

                {{-- Installment --}}
                <p class="text-sm text-gray-500 mb-5">
                    Pay in 3 × Rs. <span class="font-semibold text-gray-700">{{ number_format($product->selling_price / 3, 2) }}</span>
                    with <span class="font-semibold text-indigo-600">MintPay</span> or <span class="font-semibold text-indigo-600">KOKO</span>
                    &amp; get up to <span class="font-semibold text-indigo-600">1% Cashback</span>
                </p>

                <div class="h-px bg-gray-100 mb-5"></div>

                {{-- Stock / Warranty --}}
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full {{ $product->quantity > 0 ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]' : 'bg-red-400' }}"></div>
                        <span class="text-sm font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $product->quantity > 0 ? 'In Stock ('.$product->quantity.' units)' : 'Out of Stock' }}
                        </span>
                    </div>
                    @if ($product->warranty)
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="text-sm text-gray-600 font-medium">{{ $product->warranty }} Warranty</span>
                        </div>
                    @endif
                </div>

                {{-- Quantity Selector --}}
                @if ($product->quantity > 0)
                    <div class="flex items-center gap-4 mb-5">
                        <span class="text-sm font-semibold text-gray-700">Quantity:</span>
                        <div class="flex items-center border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                            <button wire:click="decrementQuantity"
                                class="px-4 py-2.5 text-gray-600 hover:bg-gray-50 transition text-lg font-bold {{ $quantity <= 1 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                @disabled($quantity <= 1)>−</button>
                            <span class="px-5 py-2.5 text-base font-bold text-gray-900 border-x border-gray-200 min-w-[3rem] text-center">{{ $quantity }}</span>
                            <button wire:click="incrementQuantity"
                                class="px-4 py-2.5 text-gray-600 hover:bg-gray-50 transition text-lg font-bold {{ $quantity >= $product->quantity ? 'opacity-40 cursor-not-allowed' : '' }}"
                                @disabled($quantity >= $product->quantity)>+</button>
                        </div>
                        <span class="text-xs text-gray-400">Max {{ $product->quantity }}</span>
                    </div>
                @endif

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 mb-6">
                    <button wire:click="addToCart" wire:loading.attr="disabled"
                        @class([
                            'flex-1 flex items-center justify-center gap-2 py-3.5 rounded-2xl text-base font-bold transition-all duration-200 shadow-sm',
                            'bg-indigo-600 hover:bg-indigo-700 text-white hover:shadow-indigo-200 hover:shadow-lg' => $product->quantity > 0,
                            'bg-gray-200 text-gray-400 cursor-not-allowed' => $product->quantity <= 0,
                        ])
                        @disabled($product->quantity <= 0)>
                        <span wire:loading.class="hidden" wire:target="addToCart">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0"/>
                            </svg>
                        </span>
                        <svg wire:loading wire:target="addToCart" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </button>

                    <a href="{{ route('checkout') }}"
                        class="flex-1 flex items-center justify-center gap-2 py-3.5 rounded-2xl text-base font-bold bg-gray-900 text-white hover:bg-gray-800 transition-all duration-200 shadow-sm">
                        Buy Now
                    </a>
                </div>

                {{-- Trust Badges --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="flex flex-col items-center gap-1 p-3 bg-gray-50 rounded-xl text-center">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/>
                        </svg>
                        <span class="text-xs text-gray-600 font-medium">Free Delivery above Rs. 5,000</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 p-3 bg-gray-50 rounded-xl text-center">
                        <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-xs text-gray-600 font-medium">Genuine Product Guarantee</span>
                    </div>
                    <div class="flex flex-col items-center gap-1 p-3 bg-gray-50 rounded-xl text-center">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-xs text-gray-600 font-medium">24/7 Customer Support</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── Description / Specs Tabs ──────────────────────────── --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 mb-16 overflow-hidden">
            <div class="flex border-b border-gray-100">
                <button wire:click="setTab('description')"
                    class="px-6 py-4 text-sm font-semibold transition {{ $activeTab === 'description' ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-px' : 'text-gray-500 hover:text-gray-700' }}">
                    Description
                </button>
                <button wire:click="setTab('specs')"
                    class="px-6 py-4 text-sm font-semibold transition {{ $activeTab === 'specs' ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-px' : 'text-gray-500 hover:text-gray-700' }}">
                    Specifications
                </button>
            </div>
            <div class="p-8">
                @if ($activeTab === 'description')
                    @if ($product->description)
                        <div class="prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    @else
                        <p class="text-gray-400 text-sm">No description available for this product.</p>
                    @endif
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center justify-between py-3 border-b border-gray-50">
                            <span class="text-sm text-gray-500 font-medium">Brand</span>
                            <span class="text-sm text-gray-800 font-semibold">{{ $product->brand?->name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-50">
                            <span class="text-sm text-gray-500 font-medium">Category</span>
                            <span class="text-sm text-gray-800 font-semibold">{{ $product->category?->name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-50">
                            <span class="text-sm text-gray-500 font-medium">Warranty</span>
                            <span class="text-sm text-gray-800 font-semibold">{{ $product->warranty ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-50">
                            <span class="text-sm text-gray-500 font-medium">Availability</span>
                            <span class="text-sm font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                        @if ($product->short_description)
                            <div class="md:col-span-2 flex flex-col gap-1 py-3 border-b border-gray-50">
                                <span class="text-sm text-gray-500 font-medium">Short Description</span>
                                <span class="text-sm text-gray-800">{{ $product->short_description }}</span>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- ─── Related Products ───────────────────────────────────── --}}
        @if ($relatedProducts->isNotEmpty())
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
                <div x-data="{
                    scroll(dir) {
                        const el = this.$refs.relTrack;
                        el.scrollBy({ left: dir * 280, behavior: 'smooth' });
                    }
                }" class="relative">
                    <button @click="scroll(-1)"
                        class="hidden md:flex absolute -left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-md items-center justify-center hover:bg-gray-50">
                        <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <div x-ref="relTrack" class="flex gap-4 overflow-x-auto scroll-smooth pb-4 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                        @foreach ($relatedProducts as $rp)
                            <a href="{{ route('product.detail', $rp->slug) }}" class="snap-start shrink-0 block" wire:key="rel-product-{{ $rp->id }}">
                                <x-common.customer.product-card
                                    :images="$rp->image_urls"
                                    :imageAlt="$rp->name"
                                    :productName="$rp->name"
                                    :price="$rp->selling_price"
                                    :forMonthlyPayment="$rp->selling_price / 3"
                                    numberOfColors="1"
                                    :stockStatus="$rp->quantity > 0 ? 'In Stock' : 'Out of Stock'" />
                            </a>
                        @endforeach
                    </div>

                    <button @click="scroll(1)"
                        class="hidden md:flex absolute -right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 rounded-full bg-white shadow-md items-center justify-center hover:bg-gray-50">
                        <svg class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
