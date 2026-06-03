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

                <a href="/shop" class="text-gray-900 font-medium hover:text-blue-600 transition">
                    Shop All
                </a>

                {{-- Categories Dropdown --}}
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
                        class="fixed left-0 w-screen opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200">
                        <div class="pt-5">
                            <div
                                class="max-w-7xl mx-auto px-8 py-8 bg-white rounded-xl shadow-lg border border-gray-100 grid grid-cols-6 gap-6">
                                <div>
                                    <h3 class="px-5 py-3 font-semibold text-gray-900">Main Categories</h3>
                                    <ul class="space-y-2 left-0">
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Apple
                                                Store</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Mobile
                                                Phones</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Smart
                                                Watches</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Earphones
                                                and Headphones</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Power
                                                Banks</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Mobile
                                                Phone Accessories</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="px-5 py-3 font-semibold text-gray-900">Accessories</h3>
                                    <ul class="space-y-2 left-0">
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Smart
                                                Devices</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Speakers</a>
                                        </li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Cameras</a>
                                        </li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Projectors</a>
                                        </li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Storage
                                                Devices</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Computer
                                                Accessories</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Car
                                                Accessories</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Cases
                                                & Covers</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Tools</a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="px-5 py-3 font-semibold text-gray-900">Appliances</h3>
                                    <ul class="space-y-2">
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Personal
                                                Care</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:text-blue-600">Home
                                                Care</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h3 class="px-5 py-3 font-semibold text-gray-900">Exclusive Collections</h3>
                                    <ul class="space-y-2">
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:hover:text-blue-600">New
                                                Arrivals</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:hover:text-blue-600">Merchandise</a>
                                        </li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:hover:text-blue-600">Gift
                                                Cards</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:hover:text-blue-600">Gaming
                                                Consoles</a></li>
                                        <li><a href="#"
                                                class="block px-5 py-3 text-sm text-gray-700 hover:hover:text-blue-600">Pre
                                                Orders</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <ul class="space-y-2">
                                        <li class="overflow-hidden"><img
                                                src="https://www.simplytek.lk/cdn/shop/files/apple_logo_blk_bg.jpg?v=1706847574&width=670"
                                                alt="Apple Logo"
                                                class="w-full h-auto transition duration-700 hover:scale-115"></li>
                                        <li><a href="#"
                                                class="block mt-4 px-5 py-3 text-sm text-gray-700">Apple
                                                Store</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <ul class="space-y-2">
                                        <li class="overflow-hidden"><img
                                                src="https://www.simplytek.lk/cdn/shop/files/image_c003819b-63a0-4aa8-82aa-e7e64fd6bb20.webp?v=1737092735&width=670"
                                                alt="Sales Banner"
                                                class="w-full h-auto transition duration-700 hover:scale-115"></li>
                                        <li><a href="#"
                                                class="block mt-4 px-5 py-3 text-sm text-gray-700">Clearence
                                                Sale</a></li>
                                    </ul>
                                </div>
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

                {{-- User --}}
                <button class="text-blue-600 hover:text-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A9 9 0 1118.88 17.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>

                {{-- Cart --}}
                <div class="relative">
                    <button class="text-blue-600 hover:text-blue-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0" />
                        </svg>
                    </button>

                    {{-- Cart Count --}}
                    <span
                        class="absolute -top-2 -right-2 bg-black text-white text-[10px] font-semibold h-5 w-5 rounded-full flex items-center justify-center">
                        0
                    </span>
                </div>
            </div>
        </div>
    </div>
</nav>
