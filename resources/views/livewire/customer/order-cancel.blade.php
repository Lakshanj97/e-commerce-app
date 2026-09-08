<div class="min-h-screen bg-gray-50/50 py-16 pt-28">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xs border border-gray-100 text-center space-y-6">
            <div class="w-20 h-20 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto shadow-xs">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>

            <div class="space-y-2">
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Payment Cancelled</h1>
                <p class="text-gray-500 text-sm">
                    Your payment was not completed and your order has not been processed. You can retry checkout whenever you are ready.
                </p>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('checkout') }}"
                    class="w-full sm:w-auto px-8 py-3.5 rounded-full font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition">
                    Retry Checkout
                </a>
                <a href="{{ route('cart') }}"
                    class="w-full sm:w-auto px-6 py-3.5 rounded-full font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                    Return to Cart
                </a>
            </div>
        </div>
    </div>
</div>
