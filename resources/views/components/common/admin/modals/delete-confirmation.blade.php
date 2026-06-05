@props([
    'show' => false,
    'title' => 'Delete Item',
    'message' => 'Are you sure you want to delete this item?',
    'itemName' => null,
    'confirmText' => 'Delete',
    'cancelAction' => null,
    'confirmAction' => null,
    'loadingTarget' => null,
])

@if ($show)
<div
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    x-data
    x-init="$el.offsetHeight"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
         wire:click="{{ $cancelAction }}"></div>

    {{-- Dialog --}}
    <div class="relative w-full max-w-md bg-white shadow-2xl rounded-2xl ring-1 ring-gray-200"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0">

        <div class="p-6">

            {{-- Icon --}}
            <div class="flex justify-center mb-5">
                <div class="flex items-center justify-center rounded-full h-14 w-14 bg-red-50 ring-8 ring-red-50/60">
                    <svg class="text-red-500 h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>

            {{-- Content --}}
            <div class="text-center">
                <h3 class="text-base font-bold text-gray-900">
                    {{ $title }}
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    {!! $message !!}
                    @if($itemName)
                        <span class="font-semibold text-gray-800">"{{ $itemName }}"</span>.
                    @endif
                    <span class="font-medium text-red-600">This action cannot be undone</span>.
                </p>
            </div>

            <div class="my-5 border-t border-gray-100 border-dashed"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-center gap-3">

                <button
                    type="button"
                    class="flex-1 rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:border-gray-400 active:scale-95"
                    wire:click="{{ $cancelAction }}"
                >
                    Cancel
                </button>

                <button
                    type="button"
                    class="flex-1 flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700 active:scale-95 disabled:opacity-60"
                    wire:click="{{ $confirmAction }}"
                    @if($loadingTarget) wire:loading.attr="disabled" @endif
                >
                    <svg wire:loading.remove wire:target="{{ $loadingTarget }}" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>

                    <span wire:loading.remove wire:target="{{ $loadingTarget }}">
                        {{ $confirmText }}
                    </span>

                    <svg wire:loading wire:target="{{ $loadingTarget }}" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                    </svg>

                    <span wire:loading wire:target="{{ $loadingTarget }}">
                        Deleting...
                    </span>
                </button>

            </div>
        </div>
    </div>
</div>
@endif