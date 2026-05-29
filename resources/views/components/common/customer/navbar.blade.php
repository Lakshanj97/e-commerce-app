<nav class="bg-indigo-200 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="SimplyTek"
                        class="h-12 w-auto"
                    >
                </a>
            </div>

            {{-- Navigation Links --}}
            <div class="hidden lg:flex items-center gap-10">
                <a
                    href="/"
                    class="text-gray-900 font-medium hover:text-blue-600 transition"
                >
                    Home
                </a>

                <a
                    href="/shop"
                    class="text-gray-900 font-medium hover:text-blue-600 transition"
                >
                    Shop All
                </a>

                {{-- Categories Dropdown --}}
                <div class="relative group">
                    <button
                        class="flex items-center gap-1 text-gray-900 font-medium hover:text-blue-600 transition"
                    >
                        Categories

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        class="absolute left-0 top-full mt-3 w-52 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50"
                    >
                        <div class="py-2">

                            <a href="#"
                               class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                Laptops
                            </a>

                            <a href="#"
                               class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                Smartphones
                            </a>

                            <a href="#"
                               class="block px-5 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                                Accessories
                            </a>

                        </div>
                    </div>
                </div>

                <a
                    href="/contact"
                    class="text-gray-900 font-medium hover:text-blue-600 transition"
                >
                    Contact
                </a>
            </div>

            {{-- Right Side Icons --}}
            <div class="flex items-center gap-5">

                {{-- Search --}}
                <button class="text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>

                {{-- User --}}
                <button class="text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>

                {{-- Cart --}}
                <div class="relative">
                    <button class="text-blue-600 hover:text-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-7 w-7"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0"/>
                        </svg>
                    </button>

                    {{-- Cart Count --}}
                    <span
                        class="absolute -top-2 -right-2 bg-black text-white text-[10px] font-semibold h-5 w-5 rounded-full flex items-center justify-center"
                    >
                        0
                    </span>
                </div>

            </div>
        </div>
    </div>
</nav>