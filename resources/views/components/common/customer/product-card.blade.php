@props(['images' => [], 'imageAlt', 'productName', 'price', 'forMonthlyPayment', 'numberOfColors', 'stockStatus'])

@php
    // Fallback if no images exist at all
    $images = count($images) ? $images : ['https://via.placeholder.com/400x400?text=No+Image'];
@endphp

<div x-data="{
    images: {{ Illuminate\Support\Js::from($images) }},
    current: 0,
    interval: null,
    start() {
        if (this.images.length <= 1) return;
        this.stop(); // clear any existing interval first
        this.interval = setInterval(() => {
            this.current = (this.current + 1) % this.images.length;
        }, 2000);
    },
    stop() {
        clearInterval(this.interval);
        this.interval = null;
    }
}" x-init="start()" @mouseenter="start()" @mouseleave="start()"
    class="bg-gray-100 rounded-lg overflow-hidden shadow-sm max-w-70">
    <div class="relative flex items-center justify-center h-64 p-4 overflow-hidden">
        <template x-for="(img, index) in images" :key="index">
            <img :src="img" alt="{{ $imageAlt }}" x-show="current === index"
                x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" class="object-contain max-w-60 h-full rounded-2xl absolute" />
        </template>

        {{-- Dots indicator, only if more than 1 image --}}
        <div class="absolute bottom-2 left-0 right-0 flex justify-center gap-1" x-show="images.length > 1">
            <template x-for="(img, index) in images" :key="index">
                <div class="w-1.5 h-1.5 rounded-full" :class="current === index ? 'bg-gray-800' : 'bg-gray-300'"></div>
            </template>
        </div>
    </div>

    <div class="text-left pl-4 pb-4">
        <h3 class="font-semibold mt-4 text-gray-800">{{ $productName }}</h3>
        <h4 class="font-bold mt-1 text-gray-900">Rs. {{ number_format($price, 2) }}</h4>

        <p class="text-sm text-gray-600 mt-2 leading-relaxed">
            Pay in 3 x Rs. <span class="font-semibold text-gray-800">{{ number_format($forMonthlyPayment, 2) }}</span>
            & get up to <span class="font-semibold text-gray-800">1% Cashback</span>
            with MintPay or KOKO *T&C Apply
            <br>
            <span class="text-xs text-gray-500 mt-1 inline-block">Available in {{ $numberOfColors }} colors</span>
        </p>

        <x-common.customer.star-review class="mt-3 block" />

        <div class="flex flex-row items-center mt-4 space-x-2">
            <div class="w-2 h-2 rounded-full bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.7)]"></div>
            <div class="text-sm font-medium text-green-600">{{ $stockStatus }}</div>
        </div>
    </div>
</div>
