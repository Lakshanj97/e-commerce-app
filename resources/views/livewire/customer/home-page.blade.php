<div class="bg-gray-50 min-h-screen">

    {{-- ─── Flash Toast Notifications ────────────────────────────────────── --}}
    @if (session()->has('cart_success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-gray-900 text-white px-5 py-4 rounded-2xl shadow-2xl border border-gray-700 max-w-md">
            <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="flex-1 text-xs">
                <p class="font-bold text-white text-sm">Added to Cart!</p>
                <p class="text-gray-300 mt-0.5">{{ session('cart_success') }}</p>
            </div>
            <a href="{{ route('cart') }}" class="px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shrink-0 transition">
                View Cart &rarr;
            </a>
            <button @click="show = false" class="text-gray-400 hover:text-white ml-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-red-900 text-white px-5 py-3.5 rounded-2xl shadow-2xl border border-red-700 max-w-md">
            <svg class="w-5 h-5 text-red-300 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <p class="text-xs font-medium">{{ session('error') }}</p>
            <button @click="show = false" class="text-red-300 hover:text-white ml-auto">✕</button>
        </div>
    @endif

    {{-- ─── 1. HERO SHOWCASE SLIDER ────────────────────────────────────────── --}}
    <section class="pt-20 bg-slate-950 text-white overflow-hidden relative"
        x-data="{
            activeSlide: 0,
            slides: [
                {
                    tag: 'NEW FLAGSHIP 2026',
                    title: 'iPhone 16 Pro Max & AirPods Pro',
                    subtitle: 'Titanium design. Groundbreaking A18 Pro chip. Official Apple Sri Lanka warranty.',
                    price: 'Rs. 79,500',
                    priceLabel: 'AirPods Pro starting from',
                    link: '{{ route('category.products', 'mobile-phones-tablets') }}',
                    cta: 'Explore Apple Store',
                    badge: '100% Genuine Apple Care',
                    image: 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=1600&auto=format&fit=crop&q=80'
                },
                {
                    tag: 'ULTRA-FAST GAN TECH',
                    title: 'Anker Prime 250W GaN Charging Ecosystem',
                    subtitle: 'Charge your laptop, phone & accessories simultaneously with smart real-time digital display.',
                    price: 'Rs. 52,500',
                    priceLabel: 'Special Launch Price',
                    link: '{{ route('category.products', 'power-charging') }}',
                    cta: 'Shop Anker Power',
                    badge: '24 Months Anker Warranty',
                    image: 'https://images.unsplash.com/photo-1583863788434-e58a36330cf0?w=1600&auto=format&fit=crop&q=80'
                },
                {
                    tag: 'STUDIO-GRADE ACOUSTICS',
                    title: 'Sony WH-1000XM5 & JBL PartyBox',
                    subtitle: 'Industry-leading noise cancellation & deep punchy bass. Experience pure acoustic brilliance.',
                    price: 'Rs. 119,000',
                    priceLabel: 'Sony Flagship Deal',
                    link: '{{ route('category.products', 'audio-sound') }}',
                    cta: 'Discover Sound Deals',
                    badge: 'High-Res Wireless Audio',
                    image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=1600&auto=format&fit=crop&q=80'
                },
                {
                    tag: 'ADVENTURE & WELLNESS',
                    title: 'Apple Watch Ultra 2 & Galaxy Watch 6',
                    subtitle: 'Aerospace-grade titanium, precision dual-frequency GPS, and cutting-edge health tracking.',
                    price: 'Rs. 98,000',
                    priceLabel: 'Galaxy Watch Classic',
                    link: '{{ route('category.products', 'smart-watches-wearables') }}',
                    cta: 'Shop Smartwatches',
                    badge: 'Official Brand Support',
                    image: 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=1600&auto=format&fit=crop&q=80'
                }
            ],
            timer: null,
            start() {
                this.timer = setInterval(() => this.next(), 6000);
            },
            stop() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },
            prev() {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            },
            init() {
                this.start();
            }
        }"
        @mouseenter="stop()"
        @mouseleave="start()">

        {{-- Slider Container --}}
        <div class="relative h-[500px] sm:h-[540px] md:h-[600px] lg:h-[640px] w-full">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index"
                    x-transition:enter="transition ease-out duration-700"
                    x-transition:enter-start="opacity-0 scale-105"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute inset-0">

                    {{-- Background Photo with Dark Vignette --}}
                    <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover object-center brightness-60">
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-slate-950/40"></div>

                    {{-- Content Area --}}
                    <div class="absolute inset-0 flex items-center">
                        <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full">
                            <div class="max-w-2xl">
                                {{-- Tag Badge --}}
                                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/20 backdrop-blur-md border border-blue-400/30 text-blue-300 text-xs font-bold uppercase tracking-widest mb-4">
                                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                    <span x-text="slide.tag"></span>
                                </div>

                                {{-- Title --}}
                                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight mb-4"
                                    x-text="slide.title"></h1>

                                {{-- Subtitle --}}
                                <p class="text-sm sm:text-base md:text-lg text-gray-300 font-normal leading-relaxed mb-6 max-w-xl"
                                    x-text="slide.subtitle"></p>

                                {{-- Pricing & Warranty Pill --}}
                                <div class="flex flex-wrap items-center gap-4 mb-8">
                                    <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-2xl border border-white/15">
                                        <p class="text-[10px] uppercase font-bold text-gray-300 tracking-wider" x-text="slide.priceLabel"></p>
                                        <p class="text-xl font-black text-white" x-text="slide.price"></p>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-semibold">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span x-text="slide.badge"></span>
                                    </span>
                                </div>

                                {{-- Action Buttons --}}
                                <div class="flex flex-wrap items-center gap-3">
                                    <a :href="slide.link"
                                        class="inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold shadow-lg shadow-blue-600/30 hover:shadow-blue-500/50 hover:scale-[1.02] transition-all duration-200">
                                        <span x-text="slide.cta"></span>
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('shop') }}"
                                        class="inline-flex items-center justify-center px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 backdrop-blur-md text-white text-sm font-semibold border border-white/15 transition">
                                        Browse All Tech
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Prev / Next Navigation Arrows --}}
        <button @click="prev()"
            class="hidden md:flex absolute left-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-2xl bg-black/40 hover:bg-black/70 backdrop-blur-md border border-white/15 items-center justify-center text-white transition hover:scale-105">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button @click="next()"
            class="hidden md:flex absolute right-6 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-2xl bg-black/40 hover:bg-black/70 backdrop-blur-md border border-white/15 items-center justify-center text-white transition hover:scale-105">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        {{-- Slide Progress Indicators --}}
        <div class="absolute bottom-6 left-0 right-0 z-20 flex justify-center items-center gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index"
                    class="h-2 rounded-full transition-all duration-300"
                    :class="activeSlide === index ? 'w-8 bg-blue-500' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
            </template>
        </div>
    </section>

    {{-- ─── 2. TRUST & VALUE PROPOSITIONS BAR ───────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 -mt-8 relative z-30">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-6">
            {{-- Delivery --}}
            <div class="flex items-center gap-4 p-2">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900">Express Delivery</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Free island-wide over Rs. 5,000</p>
                </div>
            </div>

            {{-- Warranty --}}
            <div class="flex items-center gap-4 p-2 sm:border-l border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900">100% Genuine Tech</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Official manufacturer warranty</p>
                </div>
            </div>

            {{-- Installments --}}
            <div class="flex items-center gap-4 p-2 lg:border-l border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900">3x 0% Installments</h4>
                    <p class="text-xs text-gray-500 mt-0.5">MintPay & KOKO accepted</p>
                </div>
            </div>

            {{-- Support --}}
            <div class="flex items-center gap-4 p-2 sm:border-l border-gray-100">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900">24/7 Expert Support</h4>
                    <p class="text-xs text-gray-500 mt-0.5">Hotline & WhatsApp support</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── 3. POPULAR CATEGORIES GRID ──────────────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Departments</span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                    Explore Popular Categories
                </h2>
                <p class="text-gray-500 text-sm mt-1">Find the latest electronics and gear across all tech departments.</p>
            </div>
            <a href="{{ route('shop') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 transition">
                <span>View All Tech</span>
                <span>&rarr;</span>
            </a>
        </div>

        @php
            $catImages = [
                'mobile-phones-tablets' => 'https://images.unsplash.com/photo-1695048133142-1a20484d2569?w=600&auto=format&fit=crop&q=80',
                'smart-watches-wearables' => 'https://images.unsplash.com/photo-1579586337278-3befd40fd17a?w=600&auto=format&fit=crop&q=80',
                'audio-sound' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80',
                'power-charging' => 'https://images.unsplash.com/photo-1609592424361-b5e1cf5ca760?w=600&auto=format&fit=crop&q=80',
                'smart-devices-gadgets' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&auto=format&fit=crop&q=80',
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @forelse ($categories as $category)
                @php
                    $imgUrl = $catImages[$category->slug] ?? 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=600&auto=format&fit=crop&q=80';
                @endphp
                <a href="{{ route('category.products', $category->slug) }}"
                    class="group relative bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between h-72">

                    {{-- Category Image Container --}}
                    <div class="relative h-44 overflow-hidden bg-gray-100">
                        <img src="{{ $imgUrl }}" alt="{{ $category->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                        <span class="absolute bottom-3 left-4 text-[11px] font-bold text-white bg-black/40 backdrop-blur-md px-2.5 py-1 rounded-full border border-white/20">
                            {{ $category->products_count ?? $category->products()->count() }} Products
                        </span>
                    </div>

                    {{-- Category Details --}}
                    <div class="p-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition leading-snug">
                                {{ $category->name }}
                            </h3>
                            <p class="text-[11px] text-gray-500 mt-0.5">Explore catalog &rarr;</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-5 text-center py-8">Categories currently being updated.</p>
            @endforelse
        </div>
    </section>

    {{-- ─── 4. FLASH DEALS OF THE WEEK (LIMITED TIME) ───────────────────── --}}
    @if ($flashDeals->isNotEmpty())
        <section class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="bg-gradient-to-br from-blue-900 via-indigo-950 to-slate-950 rounded-3xl p-8 sm:p-10 text-white shadow-2xl overflow-hidden relative"
                x-data="{
                    hours: 8,
                    minutes: 42,
                    seconds: 15,
                    startCountdown() {
                        setInterval(() => {
                            if (this.seconds > 0) {
                                this.seconds--;
                            } else {
                                this.seconds = 59;
                                if (this.minutes > 0) {
                                    this.minutes--;
                                } else {
                                    this.minutes = 59;
                                    if (this.hours > 0) this.hours--;
                                }
                            }
                        }, 1000);
                    }
                }"
                x-init="startCountdown()">

                {{-- Section Header & Countdown --}}
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 border-b border-white/10 pb-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-500/20 text-red-400 text-xs font-bold uppercase tracking-wider mb-2">
                            <span class="w-2 h-2 rounded-full bg-red-400 animate-ping"></span>
                            Special Weekly Discounts
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                            ⚡ Flash Deals of the Week
                        </h2>
                        <p class="text-gray-300 text-sm mt-1">Grab genuine tech at exclusive prices before stock runs out.</p>
                    </div>

                    {{-- Countdown Badge --}}
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-gray-300 uppercase font-semibold tracking-wider">Ends In:</span>
                        <div class="flex items-center gap-2 text-center">
                            <div class="bg-white/10 backdrop-blur-md px-3 py-2 rounded-xl border border-white/15 min-w-[52px]">
                                <span class="text-lg font-black text-white" x-text="String(hours).padStart(2, '0')">08</span>
                                <span class="text-[9px] uppercase block text-gray-400 font-bold">Hours</span>
                            </div>
                            <span class="font-bold text-lg text-gray-400">:</span>
                            <div class="bg-white/10 backdrop-blur-md px-3 py-2 rounded-xl border border-white/15 min-w-[52px]">
                                <span class="text-lg font-black text-white" x-text="String(minutes).padStart(2, '0')">42</span>
                                <span class="text-[9px] uppercase block text-gray-400 font-bold">Mins</span>
                            </div>
                            <span class="font-bold text-lg text-gray-400">:</span>
                            <div class="bg-white/10 backdrop-blur-md px-3 py-2 rounded-xl border border-white/15 min-w-[52px]">
                                <span class="text-lg font-black text-red-400" x-text="String(seconds).padStart(2, '0')">15</span>
                                <span class="text-[9px] uppercase block text-gray-400 font-bold">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deals Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($flashDeals as $deal)
                        @php
                            $discount = round((($deal->original_price - $deal->selling_price) / $deal->original_price) * 100);
                            $thumb = $deal->image_urls[0] ?? 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=600&auto=format&fit=crop&q=80';
                        @endphp
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 p-5 flex flex-col justify-between hover:bg-white/15 hover:border-white/20 transition-all duration-200">
                            <div>
                                <div class="relative h-48 bg-white/5 rounded-xl flex items-center justify-center p-4 mb-4 overflow-hidden">
                                    <img src="{{ $thumb }}" alt="{{ $deal->name }}" class="object-contain h-full max-w-full">
                                    <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-md">
                                        -{{ $discount }}% OFF
                                    </span>
                                    @if ($deal->brand)
                                        <span class="absolute top-3 right-3 bg-black/40 text-gray-200 text-[10px] font-bold px-2 py-0.5 rounded-md uppercase">
                                            {{ $deal->brand->name }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('product.detail', $deal->slug) }}" class="block">
                                    <h3 class="text-sm font-bold text-white line-clamp-2 hover:text-blue-400 transition leading-snug">
                                        {{ $deal->name }}
                                    </h3>
                                </a>

                                <div class="mt-3 flex items-baseline gap-2">
                                    <span class="text-xl font-black text-white">
                                        Rs. {{ number_format($deal->selling_price, 2) }}
                                    </span>
                                    <span class="text-xs text-gray-400 line-through">
                                        Rs. {{ number_format($deal->original_price, 2) }}
                                    </span>
                                </div>

                                <p class="text-[11px] text-gray-400 mt-1">
                                    Pay 3x <span class="text-blue-300 font-semibold">Rs. {{ number_format($deal->selling_price / 3, 2) }}</span> with KOKO
                                </p>
                            </div>

                            <div class="mt-5 pt-4 border-t border-white/10 flex items-center gap-2">
                                <button wire:click="addToCart({{ $deal->id }})" wire:loading.attr="disabled"
                                    class="flex-1 py-2.5 px-4 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-md">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Add to Cart</span>
                                </button>
                                <a href="{{ route('product.detail', $deal->slug) }}"
                                    class="p-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white transition text-xs font-semibold" title="View details">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ─── 5. CURATED BRAND COLLECTIONS & SLIDER ───────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Brand Showcase</span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                    Featured Tech Collections
                </h2>
                <p class="text-gray-500 text-sm mt-1">Filter top products by your favorite electronic brand.</p>
            </div>

            {{-- Dynamic Brand Tabs --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none" wire:loading.class="opacity-60" wire:target="setActiveBrand">
                <button wire:click="setActiveBrand('all')"
                    class="px-4 py-2 rounded-full text-xs font-bold transition whitespace-nowrap {{ $activeBrandSlug === 'all' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    All Brands
                </button>
                @foreach ($brands as $brand)
                    <button wire:click="setActiveBrand('{{ $brand->slug }}')"
                        class="px-4 py-2 rounded-full text-xs font-bold transition whitespace-nowrap {{ $activeBrandSlug === $brand->slug ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        {{ $brand->name }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Horizontal Product Slider with Controls --}}
        <div x-data="{
            scroll(dir) {
                const el = this.$refs.track;
                const maxScroll = el.scrollWidth - el.clientWidth;
                if (dir === 1 && el.scrollLeft >= maxScroll - 10) {
                    el.scrollTo({ left: 0, behavior: 'smooth' });
                } else if (dir === -1 && el.scrollLeft <= 10) {
                    el.scrollTo({ left: maxScroll, behavior: 'smooth' });
                } else {
                    el.scrollBy({ left: dir * 300, behavior: 'smooth' });
                }
            }
        }" class="relative">

            {{-- Arrow Prev --}}
            <button @click="scroll(-1)"
                class="hidden md:flex absolute -left-5 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-2xl bg-white shadow-lg border border-gray-100 items-center justify-center text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            {{-- Slider Track --}}
            <div x-ref="track"
                class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4 scrollbar-none"
                wire:key="featured-slider-{{ $activeBrandSlug }}">
                @forelse ($featuredProducts as $prod)
                    @php
                        $thumb = $prod->image_urls[0] ?? 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=600&auto=format&fit=crop&q=80';
                    @endphp
                    <div class="snap-start shrink-0 w-72 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden"
                        wire:key="brand-prod-{{ $prod->id }}">

                        <div>
                            {{-- Image Preview --}}
                            <div class="relative h-56 bg-gray-50 flex items-center justify-center p-4 overflow-hidden">
                                <img src="{{ $thumb }}" alt="{{ $prod->name }}" class="object-contain h-full max-w-full hover:scale-105 transition duration-300">
                                @if ($prod->original_price > $prod->selling_price)
                                    @php $discount = round((($prod->original_price - $prod->selling_price) / $prod->original_price) * 100); @endphp
                                    <span class="absolute top-3 left-3 bg-red-500 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-sm">
                                        -{{ $discount }}%
                                    </span>
                                @endif
                                @if ($prod->brand)
                                    <span class="absolute top-3 right-3 text-[10px] bg-gray-200/80 backdrop-blur-xs text-gray-700 font-bold px-2 py-0.5 rounded-md uppercase">
                                        {{ $prod->brand->name }}
                                    </span>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="p-5">
                                <a href="{{ route('product.detail', $prod->slug) }}" class="block group">
                                    <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition line-clamp-2 leading-snug">
                                        {{ $prod->name }}
                                    </h3>
                                </a>

                                <div class="mt-3 flex items-baseline gap-2">
                                    <span class="text-base font-black text-gray-900">
                                        Rs. {{ number_format($prod->selling_price, 2) }}
                                    </span>
                                    @if ($prod->original_price > $prod->selling_price)
                                        <span class="text-xs text-gray-400 line-through">
                                            Rs. {{ number_format($prod->original_price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <p class="text-[11px] text-gray-500 mt-1">
                                    Pay 3x <span class="font-bold text-gray-800">Rs. {{ number_format($prod->selling_price / 3, 2) }}</span> with KOKO
                                </p>

                                <div class="mt-3 flex items-center justify-between text-xs">
                                    <div class="flex items-center gap-1 text-amber-500">
                                        <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                        <span class="text-gray-400 text-[10px] ml-1">5.0</span>
                                    </div>
                                    <span class="text-[11px] font-medium {{ $prod->quantity > 0 ? 'text-emerald-600' : 'text-red-500' }}">
                                        {{ $prod->quantity > 0 ? '● In Stock' : '✕ Sold Out' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Card Footer CTA --}}
                        <div class="px-5 pb-5 pt-2 flex items-center gap-2">
                            <button wire:click="addToCart({{ $prod->id }})" wire:loading.attr="disabled"
                                class="flex-1 py-2.5 px-3 rounded-xl bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Add to Cart</span>
                            </button>
                            <a href="{{ route('product.detail', $prod->slug) }}"
                                class="p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition" title="View details">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 py-8">No products found for this brand.</p>
                @endforelse
            </div>

            {{-- Arrow Next --}}
            <button @click="scroll(1)"
                class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 z-10 w-11 h-11 rounded-2xl bg-white shadow-lg border border-gray-100 items-center justify-center text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </section>

    {{-- ─── 6. DUAL PROMOTIONAL BANNERS ─────────────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Audio Banner --}}
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-slate-900 to-indigo-950 text-white p-8 sm:p-10 flex flex-col justify-between shadow-xl min-h-[300px]">
                <div class="relative z-10 max-w-sm">
                    <span class="inline-block px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-bold uppercase tracking-wider mb-3">
                        Acoustic Heaven
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight mb-2">
                        Next-Gen ANC Headphones & Speakers
                    </h3>
                    <p class="text-sm text-gray-300 mb-6">Sony, JBL, and Soundcore with deep immersive bass.</p>
                    <a href="{{ route('category.products', 'audio-sound') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-gray-900 hover:bg-blue-50 text-xs font-bold transition shadow-md">
                        Shop Audio &rarr;
                    </a>
                </div>
                <div class="absolute right-0 bottom-0 top-0 w-1/2 opacity-30 pointer-events-none">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=80"
                        alt="Headphones" class="w-full h-full object-cover object-center">
                </div>
            </div>

            {{-- Power Banner --}}
            <div class="relative rounded-3xl overflow-hidden bg-gradient-to-r from-blue-900 to-cyan-950 text-white p-8 sm:p-10 flex flex-col justify-between shadow-xl min-h-[300px]">
                <div class="relative z-10 max-w-sm">
                    <span class="inline-block px-3 py-1 rounded-full bg-cyan-500/20 text-cyan-300 text-xs font-bold uppercase tracking-wider mb-3">
                        GaN Charging Tech
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight mb-2">
                        Fastest Power Banks & GaN Fast Chargers
                    </h3>
                    <p class="text-sm text-gray-300 mb-6">Up to 250W multi-device charging from Anker, Baseus & Ugreen.</p>
                    <a href="{{ route('category.products', 'power-charging') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-gray-900 hover:bg-cyan-50 text-xs font-bold transition shadow-md">
                        Shop Power &rarr;
                    </a>
                </div>
                <div class="absolute right-0 bottom-0 top-0 w-1/2 opacity-30 pointer-events-none">
                    <img src="https://images.unsplash.com/photo-1609592424361-b5e1cf5ca760?w=800&auto=format&fit=crop&q=80"
                        alt="Power Banks" class="w-full h-full object-cover object-center">
                </div>
            </div>
        </div>
    </section>

    {{-- ─── 7. NEW ARRIVALS SHOWCASE ────────────────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Fresh Catalog</span>
                <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                    Latest Arrivals
                </h2>
                <p class="text-gray-500 text-sm mt-1">Stay ahead with the newest electronics launched this season.</p>
            </div>
            <a href="{{ route('shop') }}"
                class="px-5 py-2.5 rounded-full text-xs font-bold bg-gray-900 hover:bg-blue-600 text-white shadow-sm transition">
                Shop All New Arrivals &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($newArrivals as $product)
                @php
                    $thumb = $product->image_urls[0] ?? 'https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=600&auto=format&fit=crop&q=80';
                @endphp
                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                    <div>
                        <div class="relative h-56 bg-gray-50 flex items-center justify-center p-4 overflow-hidden">
                            <img src="{{ $thumb }}" alt="{{ $product->name }}" class="object-contain h-full max-w-full group-hover:scale-105 transition duration-300">
                            <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-black px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                NEW
                            </span>
                            @if ($product->brand)
                                <span class="absolute top-3 right-3 text-[10px] bg-gray-200/80 text-gray-700 font-bold px-2 py-0.5 rounded-md uppercase">
                                    {{ $product->brand->name }}
                                </span>
                            @endif
                        </div>

                        <div class="p-5">
                            <a href="{{ route('product.detail', $product->slug) }}" class="block">
                                <h3 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition line-clamp-2 leading-snug">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            <div class="mt-3 flex items-baseline gap-2">
                                <span class="text-base font-black text-gray-900">
                                    Rs. {{ number_format($product->selling_price, 2) }}
                                </span>
                                @if ($product->original_price > $product->selling_price)
                                    <span class="text-xs text-gray-400 line-through">
                                        Rs. {{ number_format($product->original_price, 2) }}
                                    </span>
                                @endif
                            </div>

                            <p class="text-[11px] text-gray-500 mt-1">
                                3x <span class="font-bold text-gray-800">Rs. {{ number_format($product->selling_price / 3, 2) }}</span> with KOKO
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5 pt-2 flex items-center gap-2">
                        <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled"
                            class="flex-1 py-2.5 px-3 rounded-xl bg-gray-900 hover:bg-blue-600 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                        <a href="{{ route('product.detail', $product->slug) }}"
                            class="p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition" title="View details">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-4 text-center py-8">No new arrivals currently.</p>
            @endforelse
        </div>
    </section>

    {{-- ─── 8. CUSTOMER REVIEWS & SOCIAL PROOF ─────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-14">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Community Trust</span>
            <h2 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Loved by Tech Enthusiasts Across Sri Lanka
            </h2>
            <p class="text-gray-500 text-sm mt-1">Real reviews from verified buyers who trust SimplyTek.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Review 1 --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed italic mb-4">
                    "Ordered the Anker Prime 250W power bank and got it delivered to Kandy in less than 24 hours. Sealed box with official warranty card. Unbeatable service!"
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                    <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center">
                        DK
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Dinuka Kariyawasam</h4>
                        <p class="text-[10px] text-gray-400">Verified Buyer &bull; Kandy</p>
                    </div>
                </div>
            </div>

            {{-- Review 2 --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed italic mb-4">
                    "Bought the Sony WH-1000XM5 headphones with MintPay 3 installments. Authentic item, serial verified with Sony. Best tech store in Colombo."
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                    <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-700 font-bold text-xs flex items-center justify-center">
                        SF
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Shanika Fernando</h4>
                        <p class="text-[10px] text-gray-400">Verified Buyer &bull; Colombo 03</p>
                    </div>
                </div>
            </div>

            {{-- Review 3 --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition">
                <div class="flex items-center gap-1 text-amber-400 mb-3">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed italic mb-4">
                    "Apple Watch Ultra 2 was in mint condition with warranty active. Customer support on WhatsApp answered all my charging questions in minutes."
                </p>
                <div class="flex items-center gap-3 pt-3 border-t border-gray-100">
                    <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 font-bold text-xs flex items-center justify-center">
                        AP
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Arun Perera</h4>
                        <p class="text-[10px] text-gray-400">Verified Buyer &bull; Galle</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── 9. VIP INSIDER CLUB (NEWSLETTER) ────────────────────────────── --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 pb-16">
        <div class="bg-gradient-to-r from-gray-900 via-blue-950 to-gray-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl border border-gray-800 text-center relative overflow-hidden">
            {{-- Decorative circles --}}
            <div class="absolute -right-16 -bottom-16 w-64 h-64 rounded-full bg-blue-600/10 blur-3xl pointer-events-none"></div>
            <div class="absolute -left-16 -top-16 w-64 h-64 rounded-full bg-indigo-600/10 blur-3xl pointer-events-none"></div>

            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-xs font-bold uppercase tracking-wider mb-3">
                    🎁 Exclusive Member Perks
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3">
                    Join the SimplyTek Insider Club
                </h2>
                <p class="text-gray-300 text-sm mb-8 leading-relaxed">
                    Subscribe today and enjoy <strong class="text-white">10% OFF</strong> your first purchase, instant alerts on rare tech drops, and exclusive secret promo codes.
                </p>

                {{-- Livewire Subscription Form --}}
                @if (session()->has('newsletter_success'))
                    <div class="p-4 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-sm font-semibold max-w-md mx-auto">
                        {{ session('newsletter_success') }}
                    </div>
                @else
                    <form wire:submit.prevent="subscribeNewsletter" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                        <input wire:model="newsletterEmail" type="email" placeholder="Enter your email address..."
                            class="flex-1 px-5 py-3.5 rounded-2xl bg-white/10 border border-white/20 text-white placeholder-gray-400 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500 backdrop-blur-md">
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition shadow-lg shadow-blue-600/30 whitespace-nowrap">
                            <span wire:loading.remove wire:target="subscribeNewsletter">Subscribe Now</span>
                            <span wire:loading wire:target="subscribeNewsletter">Subscribing...</span>
                        </button>
                    </form>
                    @error('newsletterEmail')
                        <p class="text-xs text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                @endif
                <p class="text-[11px] text-gray-400 mt-4">Zero spam. Unsubscribe anytime with 1-click.</p>
            </div>
        </div>
    </section>

</div>
