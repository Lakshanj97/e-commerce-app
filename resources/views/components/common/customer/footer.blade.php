@php
    $canConnect = rescue(fn () => \Illuminate\Support\Facades\DB::connection()->getPdo(), false, false);
    $footerProfile = $canConnect ? rescue(fn () => \App\Models\CompanyProfile::first(), null, false) : null;
@endphp

<footer class="bg-gray-950 text-gray-300">

    {{-- Top Footer --}}
    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Brand & About --}}
            <div>
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <h2 class="text-2xl font-black text-white tracking-tight">
                        SimplyTek<span class="text-blue-500">.</span>
                    </h2>
                </a>

                <p class="text-xs leading-relaxed text-gray-400 mb-6">
                    Sri Lanka's trusted destination for 100% genuine electronics, flagship gadgets, and accessories with official brand warranties.
                </p>

                <div class="space-y-2 text-xs text-gray-400">
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ $footerProfile->phone ?? '+94 11 234 5678' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $footerProfile->email ?? 'support@simplytek.com' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-purple-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="truncate">{{ $footerProfile->address ?? 'No. 123, Galle Road, Colombo 03' }}</span>
                    </p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-5">
                    Quick Links
                </h3>

                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop') }}" class="hover:text-white transition">
                            Shop All Gadgets
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-white transition">
                            About SimplyTek
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="hover:text-white transition">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('order.tracking') }}" class="hover:text-white transition">
                            Track Your Order
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Customer Service & Policies --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-5">
                    Customer Service
                </h3>

                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="{{ auth()->check() ? route('customer.account') : route('login') }}" class="hover:text-white transition">
                            My Account Portal
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('order.tracking') }}" class="hover:text-white transition">
                            Real-Time Order Tracking
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq') }}" class="hover:text-white transition">
                            FAQs & Help Center
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('warranty.policy') }}" class="hover:text-white transition">
                            Brand Warranty Guidelines
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shipping.returns') }}" class="hover:text-white transition">
                            Shipping & 7-Day Returns
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Accepted Payments & Guarantee --}}
            <div>
                <h3 class="text-white font-bold text-sm uppercase tracking-wider mb-5">
                    Secure Checkout
                </h3>

                <p class="text-xs text-gray-400 mb-4 leading-relaxed">
                    Enjoy convenient payment options including Visa, MasterCard, and 3 interest-free installments with KOKO & MintPay.
                </p>

                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="px-2.5 py-1 rounded-lg bg-gray-900 border border-gray-800 text-[10px] font-bold text-gray-300 uppercase">
                        Visa / Master
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-gray-900 border border-gray-800 text-[10px] font-bold text-blue-400 uppercase">
                        KOKO Pay
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-gray-900 border border-gray-800 text-[10px] font-bold text-emerald-400 uppercase">
                        MintPay
                    </span>
                    <span class="px-2.5 py-1 rounded-lg bg-gray-900 border border-gray-800 text-[10px] font-bold text-amber-400 uppercase">
                        Cash on Delivery
                    </span>
                </div>

                <div class="p-3.5 rounded-2xl bg-gray-900 border border-gray-800 flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <div class="text-[11px]">
                        <p class="font-bold text-white">SSL Encrypted Checkout</p>
                        <p class="text-gray-400">100% Safe & Authorized</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Bottom Footer --}}
    <div class="border-t border-gray-900">

        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-xs text-gray-500">
                © {{ date('Y') }} SimplyTek Electronics Sri Lanka. All rights reserved.
            </p>

            <div class="flex items-center gap-5 text-xs text-gray-400 flex-wrap justify-center">

                <a href="{{ route('terms') }}" class="hover:text-white transition">
                    Terms & Conditions
                </a>

                <span class="text-gray-700">&bull;</span>

                <a href="{{ route('privacy') }}" class="hover:text-white transition">
                    Privacy Policy
                </a>

                <span class="text-gray-700">&bull;</span>

                <a href="{{ route('shipping.returns') }}" class="hover:text-white transition">
                    Shipping & Returns
                </a>

                <span class="text-gray-700">&bull;</span>

                <a href="{{ route('warranty.policy') }}" class="hover:text-white transition">
                    Warranty
                </a>

                <span class="text-gray-700">&bull;</span>

                <a href="{{ route('contact') }}" class="hover:text-white transition">
                    Support
                </a>

            </div>

        </div>

    </div>

</footer>