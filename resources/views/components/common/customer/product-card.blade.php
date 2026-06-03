@props(['imageSrc', 'imageAlt', 'productName', 'price', 'forMonthlyPayment', 'numberOfColors', 'stockStatus'])

<div class="bg-gray-100 rounded-lg overflow-hidden shadow-sm max-w-70">
    <div class="flex items-center justify-center h-64 p-4">
        <img src="{{ $imageSrc }}" alt="{{ $imageAlt }}" class="object-contain max-w-60 h-full rounded-2xl" />
    </div>

    <div class="text-left pl-4 pb-4">
        <h3 class="font-semibold mt-4 text-gray-800">{{ $productName }}</h3>
        <h4 class=" font-bold mt-1 text-gray-900">Rs. {{ number_format($price, 2) }}</h4>

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
