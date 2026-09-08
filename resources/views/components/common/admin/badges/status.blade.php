@props([
    'status' => 'inactive'
])

@php

    $styles = [

        'active' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Active',
        ],

        'inactive' => [
            'bg' => 'bg-gray-100',
            'text' => 'text-gray-800',
            'dot' => 'bg-gray-500',
            'label' => 'Inactive',
        ],

        'featured' => [
            'bg' => 'bg-amber-50',
            'text' => 'text-amber-800',
            'dot' => 'bg-amber-500',
            'label' => 'Featured',
        ],

        'notfeatured' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Not Featured',
        ],

        'instock' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'In Stock',
        ],

        'outofstock' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Out Of Stock',
        ],

        'pending' => [
            'bg' => 'bg-yellow-100',
            'text' => 'text-yellow-800',
            'dot' => 'bg-yellow-500',
            'label' => 'Pending',
        ],

        'approved' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-800',
            'dot' => 'bg-blue-500',
            'label' => 'Approved',
        ],

        'rejected' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Rejected',
        ],

        'processing' => [
            'bg' => 'bg-blue-100',
            'text' => 'text-blue-800',
            'dot' => 'bg-blue-500',
            'label' => 'Processing',
        ],

        'completed' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-800',
            'dot' => 'bg-green-500',
            'label' => 'Completed',
        ],

        'cancelled' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-800',
            'dot' => 'bg-red-500',
            'label' => 'Cancelled',
        ],

        'paid' => [
            'bg' => 'bg-emerald-100',
            'text' => 'text-emerald-800',
            'dot' => 'bg-emerald-500',
            'label' => 'Paid',
        ],

        'failed' => [
            'bg' => 'bg-rose-100',
            'text' => 'text-rose-800',
            'dot' => 'bg-rose-500',
            'label' => 'Failed',
        ],

    ];

    $current = $styles[strtolower($status)] ?? $styles['inactive'];

@endphp

<span
    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold rounded-full
    {{ $current['bg'] }}
    {{ $current['text'] }}"
>

    <span
        class="w-2 h-2 rounded-full {{ $current['dot'] }}"
    ></span>

    {{ $current['label'] }}

</span>
