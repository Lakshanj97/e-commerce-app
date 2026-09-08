<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Contact Us</span>
        </nav>

        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">We're Here to Help</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Get in Touch with SimplyTek
            </h1>
            <p class="text-gray-500 text-sm mt-2">
                Have a question regarding products, warranty claims, or bulk orders? Reach out through any of our channels below.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">

            {{-- Left Column: Contact Cards --}}
            <div class="space-y-6 lg:col-span-1">

                {{-- Phone Card --}}
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Hotlines & Phone</h3>
                        <p class="text-xs text-gray-600 mt-1">{{ $profile->phone ?? '+94 11 234 5678' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Mon - Sat: 9:00 AM - 7:00 PM</p>
                    </div>
                </div>

                {{-- Email Card --}}
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Email Inquiries</h3>
                        <p class="text-xs text-gray-600 mt-1">{{ $profile->email ?? 'support@simplytek.com' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">24/7 ticket response</p>
                    </div>
                </div>

                {{-- Showroom Address Card --}}
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900">Colombo Showroom</h3>
                        <p class="text-xs text-gray-600 mt-1 leading-relaxed">{{ $profile->address ?? 'No. 123, Galle Road, Colombo 03, Sri Lanka' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Parking available on site</p>
                    </div>
                </div>

                {{-- WhatsApp Quick Action --}}
                <a href="https://wa.me/94771234567" target="_blank"
                    class="flex items-center justify-center gap-2 w-full py-3.5 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-md shadow-emerald-600/20">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Chat on WhatsApp Direct</span>
                </a>

            </div>

            {{-- Right Column: Interactive Contact Form --}}
            <div class="lg:col-span-2 bg-white rounded-3xl p-8 sm:p-10 border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Send Us a Message</h3>
                <p class="text-xs text-gray-500 mb-8">Fill out the form below and our tech experts will reply shortly.</p>

                @if (session()->has('contact_success'))
                    <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('contact_success') }}</span>
                    </div>
                @endif

                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="name" type="text" placeholder="John Doe"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="email" type="email" placeholder="john@example.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        {{-- Phone --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Phone / WhatsApp (Optional)
                            </label>
                            <input wire:model="phone" type="text" placeholder="+94 77 123 4567"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="subject" type="text" placeholder="Product Inquiry / Warranty"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                            @error('subject') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="message" rows="5" placeholder="How can our tech team assist you today?"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent"></textarea>
                        @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-md shadow-blue-600/20">
                            <span wire:loading.remove wire:target="submit">Send Message &rarr;</span>
                            <span wire:loading wire:target="submit">Sending...</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
