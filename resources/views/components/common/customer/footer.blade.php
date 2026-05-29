<footer class="bg-gray-950 text-gray-300">

    {{-- Top Footer --}}
    <div class="max-w-7xl mx-auto px-6 py-16">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Brand --}}
            <div>
                <h2 class="text-2xl font-bold text-white mb-4">
                    SimplyTek
                </h2>

                <p class="text-sm leading-7 text-gray-400">
                    Discover premium electronics, gadgets, and accessories
                    with modern technology solutions for your lifestyle.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">
                    Quick Links
                </h3>

                <ul class="space-y-3">

                    <li>
                        <a href="/"
                           class="hover:text-white transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="/shop"
                           class="hover:text-white transition">
                            Shop
                        </a>
                    </li>

                    <li>
                        <a href="/categories"
                           class="hover:text-white transition">
                            Categories
                        </a>
                    </li>

                    <li>
                        <a href="/contact"
                           class="hover:text-white transition">
                            Contact
                        </a>
                    </li>

                </ul>
            </div>

            {{-- Customer Service --}}
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">
                    Customer Service
                </h3>

                <ul class="space-y-3">

                    <li>
                        <a href="#"
                           class="hover:text-white transition">
                            My Account
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-white transition">
                            Orders Tracking
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-white transition">
                            Wishlist
                        </a>
                    </li>

                    <li>
                        <a href="#"
                           class="hover:text-white transition">
                            Privacy Policy
                        </a>
                    </li>

                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h3 class="text-white font-semibold text-lg mb-5">
                    Newsletter
                </h3>

                <p class="text-sm text-gray-400 mb-5">
                    Subscribe to receive updates, access to exclusive deals,
                    and more.
                </p>

                <form class="space-y-3">

                    <input
                        type="email"
                        placeholder="Enter your email"
                        class="w-full px-4 py-3 rounded-xl bg-gray-900 border border-gray-800 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition"
                    >
                        Subscribe
                    </button>

                </form>
            </div>

        </div>

    </div>

    {{-- Bottom Footer --}}
    <div class="border-t border-gray-800">

        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-sm text-gray-500">
                © {{ date('Y') }} SimplyTek. All rights reserved.
            </p>

            <div class="flex items-center gap-5 text-sm">

                <a href="#"
                   class="hover:text-white transition">
                    Terms
                </a>

                <a href="#"
                   class="hover:text-white transition">
                    Privacy
                </a>

                <a href="#"
                   class="hover:text-white transition">
                    Support
                </a>

            </div>

        </div>

    </div>

</footer>