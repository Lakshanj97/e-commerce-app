@props([
    'records'
])

@if ($records->hasPages())

    <div
        class="flex items-center justify-between px-4 py-4 border-t border-gray-100 bg-gray-50/50"
    >

        <p class="text-xs font-medium text-gray-500">

            Showing

            <span class="text-gray-700">
                {{ $records->firstItem() }}
            </span>

            -

            <span class="text-gray-700">
                {{ $records->lastItem() }}
            </span>

            of

            <span class="text-gray-700">
                {{ $records->total() }}
            </span>

        </p>

        {{ $records->links() }}

    </div>

@endif