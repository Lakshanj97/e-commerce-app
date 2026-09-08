<nav class="fixed top-0 left-0 right-0 bg-white border-gray-100 hover:bg-indigo-50 transition duration-500 z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="SimplyTek" class="h-12 w-auto">
                </a>
            </div>

            {{-- Navigation Links --}}
            <div class="hidden lg:flex items-center gap-10">
                <a href="/" class="text-gray-900 font-medium hover:text-blue-600 transition">
                    Home
                </a>

                <a href="{{ route('shop') }}" class="text-gray-900 font-medium hover:text-blue-600 transition">
                    Shop All
                </a>

                {{-- Categories Dropdown --}}
                @php
                    $canConnect = rescue(fn () => \Illuminate\Support\Facades\DB::connection()->getPdo(), false, false);
                    $navCategories = $canConnect ? rescue(
                        fn () => \App\Models\Category::with(['children' => fn ($q) => $q->where('status', true)])
                            ->whereNull('parent_id')
                            ->where('status', true)
                            ->take(5)
                            ->get(),
                        collect(),
                        false
                    ) : collect();
                @endphp
                <div class="group static">
                    <button class="flex items-center gap-1 text-gray-900 font-medium hover:text-blue-600 transition">
                        Categories
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        class="fixed left-0 w-screen opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50">
                        <div class="pt-5">
                            <div
                                class="max-w-7xl mx-auto px-8 py-8 bg-white rounded-2xl shadow-2xl border border-gray-100 grid grid-cols-5 gap-6">
                                @forelse ($navCategories as $navCat)
                                    <div>
                                        <a href="{{ route('category.products', $navCat->slug) }}"
                                            class="inline-block px-3 py-2 font-bold text-gray-900 hover:text-blue-600 transition text-sm">
                                            {{ $navCat->name }} &rarr;
                                        </a>
                                        <ul class="space-y-1 mt-1">
                                            @foreach ($navCat->children as $child)
                                                <li>
                                                    <a href="{{ route('category.products', $child->slug) }}"
                                                        class="block px-3 py-1.5 text-xs text-gray-600 hover:text-blue-600 hover:bg-blue-50/50 rounded-lg transition">
                                                        {{ $child->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                            <li>
                                                <a href="{{ route('category.products', $navCat->slug) }}"
                                                    class="block px-3 py-1 text-[11px] font-semibold text-blue-600 hover:underline">
                                                    View all in {{ $navCat->name }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @empty
                                    <div class="col-span-5 text-center py-6 text-sm text-gray-400">
                                        <a href="{{ route('shop') }}" class="text-blue-600 hover:underline">Browse All Categories in Shop</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/contact" class="text-gray-900 font-medium hover:text-blue-600 transition">
                    Contact
                </a>
            </div>

            {{-- Right Side Icons --}}
            <div class="flex items-center gap-5">

                {{-- Search --}}
                <button class="text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                {{-- User Menu --}}
                @if (auth()->check())
                    <div class="relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-1.5 text-blue-600 hover:text-blue-700 transition focus:outline-none" title="My Account">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold text-xs flex items-center justify-center border border-blue-200 shadow-2xs">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </button>

                        <div x-show="userMenu"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-1.5 z-50 text-sm"
                             style="display: none;">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500 font-medium">Signed in as</p>
                                <p class="font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            </div>

                            @if (auth()->user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-cyan-600 hover:bg-cyan-50 font-medium transition">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                                    </svg>
                                    Admin Dashboard
                                </a>
                            @endif

                            <a href="{{ route('customer.account') }}" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-50 transition">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                My Account
                            </a>

                            <div class="border-t border-gray-100 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-blue-600 hover:text-blue-700 transition" title="Sign In">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>
                @endif

                {{-- Cart --}}
                @php
                    $sessionCart = session('cart', []);
                    $cartCount = is_array($sessionCart) ? array_sum(array_column($sessionCart, 'quantity')) : 0;
                @endphp
                <a href="{{ route('cart') }}" class="relative text-blue-600 hover:text-blue-700 transition" title="View Shopping Cart">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0" />
                    </svg>

                    {{-- Cart Count --}}
                    @if ($cartCount > 0)
                        <span
                            class="absolute -top-2 -right-2 bg-indigo-600 text-white text-[10px] font-bold h-5 w-5 rounded-full flex items-center justify-center shadow-xs">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </div>
</nav>
