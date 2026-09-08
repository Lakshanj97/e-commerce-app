<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">About Us</span>
        </nav>

        {{-- Hero Header --}}
        <div class="relative bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 rounded-3xl p-8 sm:p-14 text-white shadow-2xl overflow-hidden mb-12">
            <div class="relative z-10 max-w-2xl">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-xs font-bold uppercase tracking-wider mb-4">
                    Our Story & Mission
                </span>
                <h1 class="text-3xl sm:text-5xl font-black text-white tracking-tight leading-tight mb-4">
                    Sri Lanka’s Premier Destination for Genuine Tech
                </h1>
                <p class="text-gray-300 text-sm sm:text-base leading-relaxed">
                    Founded with a passion for world-class innovation, SimplyTek connects tech enthusiasts and everyday users across Sri Lanka with authentic global gadgets, backed by official brand warranties and prompt local support.
                </p>
            </div>
            <div class="absolute -right-16 -bottom-16 w-80 h-80 rounded-full bg-blue-600/15 blur-3xl pointer-events-none"></div>
        </div>

        {{-- Stats Grid --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-center">
                <p class="text-3xl sm:text-4xl font-black text-blue-600">15,000+</p>
                <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mt-1">Happy Customers</p>
                <p class="text-xs text-gray-500 mt-1">Served island-wide with 5-star satisfaction</p>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-center">
                <p class="text-3xl sm:text-4xl font-black text-emerald-600">100%</p>
                <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mt-1">Genuine & Sealed</p>
                <p class="text-xs text-gray-500 mt-1">Sourced directly from authorized distributors</p>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-center">
                <p class="text-3xl sm:text-4xl font-black text-purple-600">24 - 48h</p>
                <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mt-1">Express Dispatch</p>
                <p class="text-xs text-gray-500 mt-1">Fast doorstep delivery to all 9 provinces</p>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm text-center">
                <p class="text-3xl sm:text-4xl font-black text-amber-600">50+</p>
                <p class="text-xs font-bold text-gray-900 uppercase tracking-wider mt-1">Global Tech Brands</p>
                <p class="text-xs text-gray-500 mt-1">Apple, Anker, Sony, JBL, Samsung & more</p>
            </div>
        </div>

        {{-- Core Pillars / Values --}}
        <div class="mb-16">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Why Choose SimplyTek</span>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight mt-1">
                    Engineered Around Trust, Speed & Quality
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Authenticity Guaranteed</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        We never deal in replicas or grey-market knockoffs. Every device comes sealed in original manufacturer packaging with verified serial numbers and official warranties.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Rapid Doorstep Delivery</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Partnered with Sri Lanka's leading express logistics networks to ensure same-day or next-day delivery in Colombo and 1-3 business days across the entire island.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Dedicated Aftersales Support</h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Our in-house customer care team assists with setup, firmware updates, and direct warranty handling. Quick WhatsApp answers from 9 AM to 7 PM every day.
                    </p>
                </div>
            </div>
        </div>

        {{-- Brand Partners Grid --}}
        @if ($brands->isNotEmpty())
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-gray-100 shadow-sm mb-16 text-center">
                <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Our Authorized Ecosystem</span>
                <h2 class="text-2xl font-black text-gray-900 mt-1 mb-8">Official Brand Partners</h2>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 items-center">
                    @foreach ($brands as $brand)
                        <div class="p-4 rounded-2xl bg-gray-50 border border-gray-100 hover:border-blue-300 transition text-center">
                            <span class="text-sm font-black text-gray-800 uppercase tracking-wider">{{ $brand->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Showroom & Contact CTA --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="max-w-xl">
                <h3 class="text-2xl font-black mb-2">Visit Our Colombo Showroom</h3>
                <p class="text-blue-100 text-xs sm:text-sm leading-relaxed">
                    Experience gadgets in person at our flagship showroom in Colombo 03. Test audio equipment, try on wearables, and speak with our tech advisors.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('contact') }}" class="px-6 py-3 rounded-2xl bg-white text-blue-700 text-xs font-bold hover:bg-blue-50 transition shadow-md">
                    Get Directions &rarr;
                </a>
                <a href="{{ route('shop') }}" class="px-6 py-3 rounded-2xl bg-white/20 hover:bg-white/30 text-white text-xs font-bold transition">
                    Shop Online
                </a>
            </div>
        </div>

    </div>
</div>
