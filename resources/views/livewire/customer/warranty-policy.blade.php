<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Warranty Policy</span>
        </nav>

        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Peace of Mind Guarantee</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Official Warranty Guidelines
            </h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">
                Every gadget purchased from SimplyTek comes backed by genuine manufacturer warranty and dedicated local service claims.
            </p>
        </div>

        {{-- Brand Warranty Matrix --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            {{-- Anker --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">ANKER</h3>
                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">18 - 24 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Industry-leading <strong>One-to-One Hardware Replacement Warranty</strong> for power banks, chargers, hubs, and Soundcore audio gear.
                </p>
            </div>

            {{-- Apple --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">APPLE</h3>
                    <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-900 text-xs font-bold">12 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Official Apple Global Hardware Warranty claimable through any Apple Authorized Service Provider (AASP) in Sri Lanka and worldwide.
                </p>
            </div>

            {{-- Sony & JBL --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">SONY & JBL</h3>
                    <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-xs font-bold">12 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Full hardware and driver warranty covering internal circuitry, Bluetooth connectivity, and ANC processors against manufacturing defects.
                </p>
            </div>

            {{-- Samsung --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">SAMSUNG</h3>
                    <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">12 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Official manufacturer warranty for smartphones, Galaxy Watches, and tablets covering motherboards, cameras, and display panels.
                </p>
            </div>

            {{-- Baseus & Ugreen --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">BASEUS & UGREEN</h3>
                    <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold">12 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Fast replacement warranty covering GaN desktop chargers, multi-port power banks, cables, and smart docking stations.
                </p>
            </div>

            {{-- Xiaomi --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base font-black text-gray-900">XIAOMI</h3>
                    <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">6 - 12 Months</span>
                </div>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Direct hardware warranty for smart security cameras, Mi Bands, and lifestyle gadgets with dedicated local tech diagnosis.
                </p>
            </div>
        </div>

        {{-- Coverage & Exclusions --}}
        <div class="bg-white rounded-3xl p-8 sm:p-10 border border-gray-100 shadow-sm mb-12 space-y-6">
            <h2 class="text-lg font-bold text-gray-900">Warranty Scope & Limitations</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xs font-bold text-emerald-700 uppercase tracking-wider mb-3">✓ What Is Covered:</h4>
                    <ul class="space-y-2 text-xs text-gray-600 list-disc list-inside">
                        <li>Factory assembly or manufacturing flaws.</li>
                        <li>Internal circuitry, GaN chips, and power delivery failure.</li>
                        <li>Bluetooth / Wi-Fi module failure.</li>
                        <li>Unprovoked battery swelling or rapid failure under normal usage.</li>
                        <li>Speaker driver distortion not caused by blown volume overload.</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-red-700 uppercase tracking-wider mb-3">✕ What Voids Warranty:</h4>
                    <ul class="space-y-2 text-xs text-gray-600 list-disc list-inside">
                        <li>Physical impact, bent frames, cracked screens, or dented casings.</li>
                        <li>Liquid ingress or submersion damages.</li>
                        <li>Use of uncertified third-party high-voltage counterfeit chargers.</li>
                        <li>Unauthorized third-party teardown or attempted repairs.</li>
                        <li>Removed, defaced, or illegible serial number stickers.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- How to Claim --}}
        <div class="bg-gradient-to-r from-blue-900 to-indigo-950 rounded-3xl p-8 sm:p-10 text-white shadow-xl">
            <h3 class="text-xl font-black mb-2">How to Submit a Warranty Claim</h3>
            <p class="text-xs text-gray-300 mb-6 max-w-xl">
                Our support team makes warranty claims simple and transparent with no unnecessary delays.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs">
                <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
                    <span class="w-7 h-7 rounded-full bg-blue-500 text-white font-bold flex items-center justify-center mb-2">1</span>
                    <h5 class="font-bold text-white mb-1">Contact Support</h5>
                    <p class="text-gray-300">Message us on WhatsApp with your Order ID and photo/video of the issue.</p>
                </div>
                <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
                    <span class="w-7 h-7 rounded-full bg-blue-500 text-white font-bold flex items-center justify-center mb-2">2</span>
                    <h5 class="font-bold text-white mb-1">Device Inspection</h5>
                    <p class="text-gray-300">Drop off at our Colombo showroom or send it via courier for diagnostic testing.</p>
                </div>
                <div class="bg-white/10 rounded-2xl p-4 border border-white/15">
                    <span class="w-7 h-7 rounded-full bg-blue-500 text-white font-bold flex items-center justify-center mb-2">3</span>
                    <h5 class="font-bold text-white mb-1">Repair or Replacement</h5>
                    <p class="text-gray-300">Brand new replacement or authorized repair dispatched back to your doorstep.</p>
                </div>
            </div>
        </div>

    </div>
</div>
