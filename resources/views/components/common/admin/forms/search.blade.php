@props([
    'placeholder' => 'Search...'
])

<div class="relative">

    <svg
        class="absolute left-3 top-1/2 w-4 h-4 text-gray-400 -translate-y-1/2"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24">

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/>
    </svg>

    <input
        {{ $attributes }}
        type="text"
        placeholder="{{ $placeholder }}"
        class="w-full h-12 pl-11 rounded-xl border border-gray-300">
</div>