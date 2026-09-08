<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-4xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Shipping & Returns</span>
        </nav>

        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Delivery & Return Guidelines</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Shipping & Returns Policy
            </h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">
                Fast, reliable express delivery to all 9 provinces in Sri Lanka, paired with our 7-day hassle-free replacement guarantee.
            </p>
        </div>

        {{-- Free Delivery Promo Card --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl mb-12 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-black">Free Island-Wide Delivery</h3>
                    <p class="text-xs text-blue-100 mt-0.5">Applied automatically on all shopping carts of Rs. 5,000 or more.</p>
                </div>
            </div>
            <a href="{{ route('shop') }}" class="px-6 py-3 rounded-2xl bg-white text-blue-700 text-xs font-bold hover:bg-blue-50 transition shrink-0 shadow-md">
                Start Shopping &rarr;
            </a>
        </div>

        {{-- Delivery Timelines Table --}}
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mb-10">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                Delivery Timelines & Rates
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-gray-100 text-gray-400 font-bold uppercase tracking-wider">
                            <th class="pb-3">Delivery Zone</th>
                            <th class="pb-3">Estimated Time</th>
                            <th class="pb-3">Orders < Rs. 5,000</th>
                            <th class="pb-3">Orders ≥ Rs. 5,000</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr>
                            <td class="py-4 font-bold text-gray-900">Colombo City (1 - 15)</td>
                            <td class="py-4 text-emerald-600 font-semibold">Same Day / 24 Hours</td>
                            <td class="py-4 text-gray-600">Rs. 350</td>
                            <td class="py-4 font-bold text-emerald-600">FREE</td>
                        </tr>
                        <tr>
                            <td class="py-4 font-bold text-gray-900">Greater Colombo & Western Province</td>
                            <td class="py-4 text-blue-600 font-semibold">24 - 48 Hours</td>
                            <td class="py-4 text-gray-600">Rs. 350</td>
                            <td class="py-4 font-bold text-emerald-600">FREE</td>
                        </tr>
                        <tr>
                            <td class="py-4 font-bold text-gray-900">Outstation & Island-Wide (All Provinces)</td>
                            <td class="py-4 text-purple-600 font-semibold">2 - 3 Business Days</td>
                            <td class="py-4 text-gray-600">Rs. 350</td>
                            <td class="py-4 font-bold text-emerald-600">FREE</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="text-[11px] text-gray-400 mt-4 leading-relaxed">
                * Note: Delivery timelines exclude Sundays and public mercantile holidays. Severe weather conditions may cause slight delays.
            </p>
        </div>

        {{-- 7-Day Returns Policy --}}
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mb-10 space-y-6">
            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                7-Day Hassle-Free Returns & Replacements
            </h2>

            <p class="text-xs text-gray-600 leading-relaxed">
                We want you to be 100% confident with your purchase from SimplyTek. If your item meets any of the eligible criteria below, we will gladly arrange a replacement or refund within 7 calendar days of receipt.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div class="bg-emerald-50/60 rounded-2xl p-5 border border-emerald-100">
                    <h4 class="text-xs font-bold text-emerald-900 uppercase tracking-wider mb-2">Eligible for Return / Swap</h4>
                    <ul class="space-y-1.5 text-xs text-emerald-800 list-disc list-inside">
                        <li>Dead on arrival (DOA) hardware defects.</li>
                        <li>Incorrect item or color model dispatched.</li>
                        <li>Package damaged during courier transit.</li>
                        <li>Missing components listed in manufacturer specs.</li>
                    </ul>
                </div>

                <div class="bg-red-50/60 rounded-2xl p-5 border border-red-100">
                    <h4 class="text-xs font-bold text-red-900 uppercase tracking-wider mb-2">Non-Returnable Conditions</h4>
                    <ul class="space-y-1.5 text-xs text-red-800 list-disc list-inside">
                        <li>Physical drop damage, crushing, or heavy scratches.</li>
                        <li>Liquid ingress or submersion beyond IP rating.</li>
                        <li>Missing original box, barcode sticker, or serial tag.</li>
                        <li>In-ear earbuds that have been unsealed and used (hygiene policy).</li>
                    </ul>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <h4 class="text-xs font-bold text-gray-900 mb-1">How to Initiate a Return:</h4>
                <ol class="list-decimal list-inside text-xs text-gray-600 space-y-1">
                    <li>Contact our support team on WhatsApp (+94 77 123 4567) within 7 days of delivery.</li>
                    <li>Provide your <strong>Order Number (ORD-...)</strong> and brief video showing the defect.</li>
                    <li>Our team will arrange courier pickup from your doorstep or direct showroom inspection.</li>
                    <li>Replacement units are dispatched within 24 hours of inspection verification.</li>
                </ol>
            </div>
        </div>

    </div>
</div>
