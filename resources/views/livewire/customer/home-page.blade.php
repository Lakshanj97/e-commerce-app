<div>
    <section class="bg-white py-20">
        {{-- 1. Image Slider Section --}}
        <x-customer.home.imagelider />

        {{-- 2. Explore Cards Grid Section --}}
        <div class="max-w-7xl mx-auto px-6 z-0">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                <x-customer.home.explore-card title="All Your Favorite Apple Gadgets"
                    imageSrc="https://www.simplytek.lk/cdn/shop/files/Apple-Watch-Series-9-simplytek-lk_5.webp?v=1698144841&width=120"
                    imageAlt="Apple Watch" />

                <x-customer.home.explore-card title="JBL PartyBox Series - Suits All Parties"
                    imageSrc="https://www.simplytek.lk/cdn/shop/files/JBL-PartyBox-310-Portable-Bluetooth-Party-Speaker-JBL-Speakers-Sri-Lanka-SimplyTek-1.jpg?v=1694425789&width=120"
                    imageAlt="JBL PartyBox" />

                <x-customer.home.explore-card title="Galaxy S26 Ultra - Shop with Freebies"
                    imageSrc="https://www.simplytek.lk/cdn/shop/files/SAMSUNG-GALAXY-S26-ULTRA-SIMPLYTEK-LK-SRI-LANKA-3.webp?v=1772775853&width=120"
                    imageAlt="Galaxy S26 Ultra" />
            </div>
        </div>

        {{-- 3. Tabs Component Section --}}
        <div x-data="{ activeTab: 'anker' }" class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between">
                {{-- Tab navigation or headers go here --}}
            </div>
        </div>

        {{-- 4. Popular Categories Section --}}
        <div class="mt-12 text-center max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold text-slate-800">
                Popular
                <span class="relative inline-block text-slate-800">
                    Categories
                    <svg class="absolute left-0 -bottom-2 w-full h-3 text-blue-600" viewBox="0 0 100 10"
                        preserveAspectRatio="none">
                        <path d="M0,5 Q50,10 100,5" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                            fill="none" />
                    </svg>
                </span>
            </h1>

            <h3 class="text-lg text-gray-600 mt-2 font-semibold">Shop electronics in every department</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                {{-- Category items will go here --}}
                {{-- Card --}}
                <x-common.customer.product-card
                    imageSrc="https://www.simplytek.lk/cdn/shop/files/anker-soundcore-r50i-nc-simplytek-lk-sri-lanka_2.jpg?v=1755317827&width=596"
                    imageAlt="Anker Soundcore R50i NC True Wireless Bluetooth Earbuds"
                    productName="Anker Soundcore R50i NC True Wireless Bluetooth Earbuds" price="5000.00"
                    forMonthlyPayment="1666.67" numberOfColors="5" stockStatus="In Stock" />
            </div>
        </div>
    </section>
</div>
