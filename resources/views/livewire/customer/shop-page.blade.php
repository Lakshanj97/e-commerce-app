<div>
    <div class="max-w-7xl mx-auto px-4 py-8 pt-28">

        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Shop All Products</h1>
            <p class="text-gray-500 mt-1 text-sm">
                Showing {{ $products instanceof \Illuminate\Pagination\LengthAwarePaginator ? $products->total() : 0 }} products
                @if ($search)
                    for <span class="font-medium text-indigo-600">"{{ $search }}"</span>
                @endif
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ─── Sidebar ──────────────────────────────────────────── --}}
            <aside class="w-full lg:w-64 shrink-0">

                {{-- Search --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input wire:model.live.debounce.400ms="search" type="text" placeholder="Search products…"
                            class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Categories</h3>
                    <ul class="space-y-1">
                        <li>
                            <button wire:click="setCategory(null)"
                                class="w-full text-left px-3 py-2 rounded-lg text-sm transition {{ is_null($categoryId) ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                All Categories
                            </button>
                        </li>
                        @foreach ($categories as $cat)
                            <li>
                                <button wire:click="setCategory({{ $cat->id }})"
                                    class="w-full text-left px-3 py-2 rounded-lg text-sm transition {{ $categoryId === $cat->id ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
                                    {{ $cat->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Brands --}}
                @if ($brands->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Brands</h3>
                        <ul class="space-y-2">
                            @foreach ($brands as $brand)
                                <li>
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="checkbox" wire:click="toggleBrand({{ $brand->id }})"
                                            @checked(in_array($brand->id, $brandIds))
                                            class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                                        <span class="text-sm text-gray-700 group-hover:text-indigo-600 transition">{{ $brand->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Price Range --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-3">Max Price</h3>
                    <input wire:model.live="maxPrice" type="range" min="0" max="{{ $priceMax }}" step="500"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-indigo-600">
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>Rs. 0</span>
                        <span class="font-semibold text-indigo-600">Rs. {{ number_format($maxPrice) }}</span>
                    </div>
                </div>

                {{-- Clear Filters --}}
                @if ($search || $categoryId || !empty($brandIds) || $maxPrice < $priceMax)
                    <button wire:click="clearFilters"
                        class="w-full py-2.5 rounded-xl border border-red-200 text-red-600 text-sm font-medium hover:bg-red-50 transition">
                        ✕ Clear All Filters
                    </button>
                @endif
            </aside>

            {{-- ─── Product Grid ─────────────────────────────────────── --}}
            <div class="flex-1">

                {{-- Sort Bar --}}
                <div class="flex items-center justify-between mb-6 bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        {{-- Active filter pills --}}
                        @if ($search)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-medium">
                                Search: {{ $search }}
                                <button wire:click="$set('search', '')" class="ml-1 hover:text-indigo-900">×</button>
                            </span>
                        @endif
                        @if ($categoryId)
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-medium">
                                Category filtered
                                <button wire:click="setCategory(null)" class="ml-1 hover:text-purple-900">×</button>
                            </span>
                        @endif
                        @if (!empty($brandIds))
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">
                                {{ count($brandIds) }} brand(s)
                                <button wire:click="$set('brandIds', [])" class="ml-1 hover:text-blue-900">×</button>
                            </span>
                        @endif
                    </div>

                    <select wire:model.live="sort"
                        class="text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="newest">Newest First</option>
                        <option value="featured">Featured</option>
                        <option value="price_asc">Price: Low → High</option>
                        <option value="price_desc">Price: High → Low</option>
                    </select>
                </div>

                {{-- Loading overlay --}}
                <div wire:loading.flex class="items-center justify-center py-20">
                    <div class="flex items-center gap-3 text-indigo-600">
                        <svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span class="text-sm font-medium">Loading products…</span>
                    </div>
                </div>

                {{-- Grid --}}
                <div wire:loading.class="opacity-40 pointer-events-none">
                    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator && $products->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <a href="{{ route('product.detail', $product->slug) }}" class="block group" wire:key="shop-product-{{ $product->id }}">
                                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200">
                                        {{-- Image --}}
                                        @php
                                            $imgs = $product->image_urls;
                                            $thumb = $imgs[0] ?? 'https://via.placeholder.com/400x400?text=No+Image';
                                        @endphp
                                        <div class="relative h-52 bg-gray-50 flex items-center justify-center p-4 overflow-hidden">
                                            <img src="{{ $thumb }}" alt="{{ $product->name }}"
                                                class="object-contain h-full max-w-full group-hover:scale-105 transition duration-300">
                                            @if ($product->original_price > $product->selling_price)
                                                @php $discount = round((($product->original_price - $product->selling_price) / $product->original_price) * 100); @endphp
                                                <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">-{{ $discount }}%</span>
                                            @endif
                                            @if ($product->quantity <= 0)
                                                <span class="absolute inset-0 bg-white/70 flex items-center justify-center">
                                                    <span class="text-sm font-bold text-gray-500">Out of Stock</span>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Info --}}
                                        <div class="p-4">
                                            @if ($product->brand)
                                                <p class="text-xs text-indigo-500 font-semibold uppercase tracking-wide mb-1">{{ $product->brand->name }}</p>
                                            @endif
                                            <h3 class="text-sm font-semibold text-gray-800 leading-snug line-clamp-2 mb-2">{{ $product->name }}</h3>

                                            <div class="flex items-baseline gap-2 mb-3">
                                                <span class="text-lg font-bold text-gray-900">Rs. {{ number_format($product->selling_price, 2) }}</span>
                                                @if ($product->original_price > $product->selling_price)
                                                    <span class="text-sm text-gray-400 line-through">Rs. {{ number_format($product->original_price, 2) }}</span>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-2">
                                                <div class="w-2 h-2 rounded-full {{ $product->quantity > 0 ? 'bg-green-500' : 'bg-red-400' }}"></div>
                                                <span class="text-xs {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">
                                                    {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>

                    @else
                        <div class="flex flex-col items-center justify-center py-24 text-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-600 mb-1">No products found</h3>
                            <p class="text-sm text-gray-400 mb-4">Try adjusting your filters or search term.</p>
                            <button wire:click="clearFilters"
                                class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                                Clear Filters
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
