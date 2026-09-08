<div class="bg-gray-50 min-h-screen pt-28 pb-16">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">Help & FAQ</span>
        </nav>

        {{-- Header --}}
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">Help Center</span>
            <h1 class="text-3xl sm:text-4xl font-black text-gray-900 tracking-tight mt-1">
                Frequently Asked Questions
            </h1>
            <p class="text-gray-500 text-xs sm:text-sm mt-2">
                Find quick answers to common questions regarding delivery, KOKO installments, warranties, and returns.
            </p>
        </div>

        {{-- Search & Filter Controls --}}
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm mb-10 space-y-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search questions or keywords (e.g. warranty, KOKO, delivery)..."
                    class="w-full pl-11 pr-4 py-3 rounded-2xl border border-gray-200 text-xs focus:ring-2 focus:ring-blue-600 focus:border-transparent">
            </div>

            {{-- Category Filter Pills --}}
            <div class="flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
                <button wire:click="setCategory('all')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $activeCategory === 'all' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    All Topics
                </button>
                <button wire:click="setCategory('delivery')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $activeCategory === 'delivery' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Shipping & Delivery
                </button>
                <button wire:click="setCategory('payments')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $activeCategory === 'payments' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Payments & Installments
                </button>
                <button wire:click="setCategory('warranty')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $activeCategory === 'warranty' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Warranty & Authenticity
                </button>
                <button wire:click="setCategory('returns')"
                    class="px-4 py-2 rounded-xl text-xs font-bold transition whitespace-nowrap {{ $activeCategory === 'returns' ? 'bg-blue-600 text-white shadow-sm' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Returns & Refunds
                </button>
            </div>
        </div>

        {{-- Accordion Questions List --}}
        <div class="space-y-4 mb-16">
            @forelse ($faqs as $idx => $faq)
                <div x-data="{ open: false }" class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
                    <button @click="open = !open"
                        class="w-full p-5 text-left flex items-center justify-between gap-4 hover:bg-gray-50/50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 font-bold text-xs flex items-center justify-center shrink-0">
                                Q
                            </span>
                            <span class="text-sm font-bold text-gray-900 leading-snug">{{ $faq['q'] }}</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 transform transition-transform duration-200 shrink-0"
                            :class="open ? 'rotate-180 text-blue-600' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse
                        class="px-5 pb-5 pt-1 text-xs text-gray-600 leading-relaxed border-t border-gray-50">
                        <div class="pl-9">
                            <p>{{ $faq['a'] }}</p>
                            <span class="inline-block mt-3 px-2.5 py-0.5 rounded-md bg-gray-100 text-gray-500 text-[10px] font-semibold uppercase">
                                {{ $faq['category_name'] }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 text-gray-500">
                    <p class="text-sm font-bold text-gray-900">No questions found</p>
                    <p class="text-xs text-gray-400 mt-1">Try refining your search term or selecting another category.</p>
                </div>
            @endforelse
        </div>

        {{-- Contact CTA Card --}}
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm text-center">
            <h3 class="text-lg font-bold text-gray-900 mb-1">Still have questions?</h3>
            <p class="text-xs text-gray-500 mb-6">Our dedicated support team is here to assist you 7 days a week.</p>
            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('contact') }}"
                    class="px-6 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition shadow-sm">
                    Contact Tech Support &rarr;
                </a>
                <a href="https://wa.me/94771234567" target="_blank"
                    class="px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm">
                    WhatsApp Chat
                </a>
            </div>
        </div>

    </div>
</div>
