<div>
    {{-- Main Container --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-28">

        {{-- ─── Breadcrumb ──────────────────────────────────────────────── --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <a href="{{ route('shop') }}" class="hover:text-blue-600 transition">Shop</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">{{ $category->name }}</span>
        </nav>

        {{-- ─── Category Hero Banner ────────────────────────────────────── --}}
        <div class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-3xl p-8 mb-8 text-white shadow-lg shadow-blue-600/10 overflow-hidden">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-xs font-semibold uppercase tracking-wider mb-3">
                    Category Showcase
                </span>
                <h1 class="text-3xl sm:text-4xl font-black tracking-tight mb-2">
                    {{ $category->name }}
                </h1>
                <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                    Explore top-rated {{ strtolower($category->name) }} from industry-leading brands with full warranty and official support.
                </p>
                <div class="mt-4 flex items-center gap-4 text-xs font-medium text-blue-200">
                    <span>{{ $products->total() }} Products Available</span>
                    <span>&bull;</span>
                    <span>100% Genuine Tech</span>
                </div>
            </div>

            {{-- Decorative Background SVG --}}
            <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
                <svg class="w-80 h-80 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                </svg>
            </div>
        </div>

        {{-- ─── Subcategories Pills (if any exist) ────────────────────────── --}}
        @if ($subcategories->isNotEmpty())
            <div class="mb-8">
                <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
                    <button wire:click="filterSubcategory(null)"
                        class="px-4 py-2 rounded-xl text-xs font-semibold transition whitespace-nowrap {{ is_null($subcategoryId) ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        All {{ $category->name }}
                    </button>
                    @foreach ($subcategories as $sub)
                        <button wire:click="filterSubcategory({{ $sub->id }})"
                            class="px-4 py-2 rounded-xl text-xs font-semibold transition whitespace-nowrap {{ $subcategoryId === $sub->id ? 'bg-blue-600 text-white shadow-sm shadow-blue-500/20' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                            {{ $sub->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ─── Content Grid: Sidebar + Products ──────────────────────────── --}}
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ─── Left Sidebar Filters ──────────────────────────────────── --}}
            <aside class="w-full lg:w-64 shrink-0 space-y-6">

                {{-- Search within category --}}
                <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Search in Category</h3>
                    <div class="relative">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search products..."
                            class="w-full pl-9 pr-4 py-2 text-xs border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                {{-- Brands Filter --}}
                @if ($brands->isNotEmpty())
                    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-5">
                        <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Brands</h3>
                        <div class="space-y-2 max-h-56 overflow-y-auto pr-1">
                            @foreach ($brands as $brand)
                                <label class="flex items-center gap-2.5 cursor-pointer select-none text-xs text-gray-700 hover:text-gray-900">
                                    <input type="checkbox"
                                        wire:click="toggleBrand({{ $brand->id }})"
                                        @checked(in_array($brand->id, $brandIds))
                                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="truncate">{{ $brand->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Price Filter --}}
                <div class="bg-white rounded-2xl shadow-xs border border-gray-100 p-5">
                    <h3 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Max Price</h3>
                    <div class="space-y-3">
                        <input type="range" min="0" max="{{ $priceMax }}" step="1000"
                            wire:model.live="maxPrice"
                            class="w-full h-1.5 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                        <div class="flex justify-between text-xs font-semibold text-gray-700">
                            <span>Rs. 0</span>
                            <span class="text-blue-600">Rs. {{ number_format($maxPrice) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Reset Filters --}}
                @if ($search || $subcategoryId || !empty($brandIds) || $maxPrice < $priceMax)
                    <button wire:click="clearFilters"
                        class="w-full py-2.5 px-4 rounded-xl text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 transition text-center border border-red-100">
                        ✕ Reset All Filters
                    </button>
                @endif
            </aside>

            {{-- ─── Product Results & Grid ─────────────────────────────────── --}}
            <div class="flex-1">

                {{-- Sort & Active Filters Bar --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 bg-white rounded-2xl shadow-xs border border-gray-100 p-4">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-xs font-medium text-gray-500">
                            Showing <span class="font-bold text-gray-800">{{ $products->total() }}</span> items
                        </span>
                        @if ($search)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 text-xs font-medium">
                                "{{ $search }}"
                                <button wire:click="$set('search', '')" class="hover:text-blue-900">×</button>
                            </span>
                        @endif
                        @if ($subcategoryId)
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-purple-50 text-purple-700 text-xs font-medium">
                                Subcategory
                                <button wire:click="filterSubcategory(null)" class="hover:text-purple-900">×</button>
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <label for="sort-select" class="text-xs font-medium text-gray-500 shrink-0">Sort By:</label>
                        <select id="sort-select" wire:model.live="sort"
                            class="text-xs border border-gray-200 rounded-xl px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-600 w-full sm:w-auto">
                            <option value="newest">Newest Arrivals</option>
                            <option value="featured">Featured First</option>
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                        </select>
                    </div>
                </div>

                {{-- Loading Indicator --}}
                <div wire:loading.flex class="items-center justify-center py-12">
                    <div class="flex items-center gap-3 text-blue-600">
                        <svg class="animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span class="text-sm font-semibold">Updating products...</span>
                    </div>
                </div>

                {{-- Products Grid --}}
                <div wire:loading.class="opacity-40 pointer-events-none">
                    @if ($products->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($products as $product)
                                <a href="{{ route('product.detail', $product->slug) }}" class="block group" wire:key="cat-prod-{{ $product->id }}">
                                    <div class="bg-white rounded-2xl shadow-xs border border-gray-100 overflow-hidden hover:shadow-md hover:-translate-y-1 transition-all duration-200 flex flex-col h-full">
                                        {{-- Image Container --}}
                                        @php
                                            $imgs = $product->image_urls;
                                            $thumb = $imgs[0] ?? 'https://via.placeholder.com/400x400?text=No+Image';
                                        @endphp
                                        <div class="relative h-56 bg-gray-50 flex items-center justify-center p-4 overflow-hidden">
                                            <img src="{{ $thumb }}" alt="{{ $product->name }}"
                                                class="object-contain h-full max-w-full group-hover:scale-105 transition duration-300">
                                            @if ($product->original_price > $product->selling_price)
                                                @php $discount = round((($product->original_price - $product->selling_price) / $product->original_price) * 100); @endphp
                                                <span class="absolute top-3 left-3 bg-red-500 text-white text-[11px] font-bold px-2 py-0.5 rounded-full shadow-xs">
                                                    -{{ $discount }}%
                                                </span>
                                            @endif
                                            @if ($product->quantity <= 0)
                                                <span class="absolute inset-0 bg-white/80 backdrop-blur-2xs flex items-center justify-center">
                                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Out of Stock</span>
                                                </span>
                                            @endif
                                        </div>

                                        {{-- Details --}}
                                        <div class="p-5 flex-1 flex flex-col justify-between">
                                            <div>
                                                @if ($product->brand)
                                                    <p class="text-[11px] text-blue-600 font-bold uppercase tracking-wider mb-1">{{ $product->brand->name }}</p>
                                                @endif
                                                <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-2 mb-2">
                                                    {{ $product->name }}
                                                </h3>
                                            </div>

                                            <div class="pt-3 border-t border-gray-100">
                                                <div class="flex items-baseline gap-2 mb-2">
                                                    <span class="text-base font-extrabold text-gray-900">
                                                        Rs. {{ number_format($product->selling_price, 2) }}
                                                    </span>
                                                    @if ($product->original_price > $product->selling_price)
                                                        <span class="text-xs text-gray-400 line-through">
                                                            Rs. {{ number_format($product->original_price, 2) }}
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="w-2 h-2 rounded-full {{ $product->quantity > 0 ? 'bg-emerald-500' : 'bg-red-400' }}"></span>
                                                        <span class="text-[11px] font-medium text-gray-500">
                                                            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                                        </span>
                                                    </div>
                                                    @if ($product->warranty)
                                                        <span class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded-md font-medium">
                                                            {{ $product->warranty }}
                                                        </span>
                                                    @endif
                                                </div>
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
                        {{-- Empty State --}}
                        <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-xs">
                            <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">No products found</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
                                There are currently no products matching your active filters in {{ $category->name }}.
                            </p>
                            <button wire:click="clearFilters"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition shadow-sm">
                                Clear Filters
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
