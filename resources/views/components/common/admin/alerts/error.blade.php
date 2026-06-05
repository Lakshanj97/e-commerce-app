@if (session('error'))
    <div x-data="{ show: true }" x-show="show"
        class="flex items-start gap-3 p-4 mb-5 text-sm text-red-800 transition-none border border-red-200 rounded-md shadow-sm bg-red-50/60">
        <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd" />
        </svg>
        <div class="flex-1 font-medium leading-tight">{{ session('error') }}</div>
        <button @click="show = false" class="text-red-500 transition-colors hover:text-red-700" aria-label="Dismiss">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
