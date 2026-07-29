<div>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Product Details
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                View your products details
            </p>
        </div>
        <div class="flex gap-4">
            <a wire:navigate href="{{ route('admin.product.add-product') }}"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                + Add Product
            </a>

            <a wire:navigate href="{{ route('admin.product.index') }}"
                class="px-10 py-2 text-sm font-medium border rounded-lg">
                Back
            </a>
        </div>
    </div>

    {{-- Body --}}
    <div>
         {{-- Body --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-700 overflow-hidden shadow-sm">
        <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-slate-700">

            {{-- Left Column --}}
            <div class="p-6 space-y-5">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Product name</p>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $product->name }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Slug</p>
                    <p class="text-sm text-gray-800 dark:text-white font-mono">{{ $product->slug }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Category</p>
                    <p class="text-sm text-gray-800 dark:text-white">{{ $product->category->name ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Short description</p>
                    <div class="text-sm text-gray-800 dark:text-white leading-relaxed prose prose-sm max-w-none">
                        {!! $product->short_description !!}
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Description</p>
                    <div class="text-sm text-gray-800 dark:text-white leading-relaxed prose prose-sm max-w-none">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="p-6 space-y-5">
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Pricing & inventory</p>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-100 dark:bg-slate-700 rounded-lg p-3 border border-gray-500 dark:border-slate-700">
                        <p class="text-xs text-gray-500 mb-1">Original price</p>
                        <p class="text-lg font-medium text-gray-800 dark:text-white">{{ number_format($product->original_price, 2) }}</p>
                    </div>
                    <div class="bg-gray-100 dark:bg-slate-700 rounded-lg p-3 border border-gray-500 dark:border-slate-700">
                        <p class="text-xs text-gray-500 mb-1">Selling price</p>
                        <p class="text-lg font-medium text-gray-800 dark:text-white">{{ number_format($product->selling_price, 2) }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Quantity in stock</p>
                    <p class="text-sm text-gray-800 dark:text-white">{{ $product->quantity }} units</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Warranty period</p>
                    <p class="text-sm text-gray-800 dark:text-white">{{ $product->warranty ?? 'N/A' }}</p>
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Active Status:</p>
                    <x-common.admin.badges.status :status="$product->is_active ? 'active' : 'inactive'" />
                </div>

                <div>
                    <p class="text-xs text-gray-500 mb-1">Featured Status:</p>
                    <x-common.admin.badges.status :status="$product->is_featured ? 'featured' : 'notfeatured'" />
                </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="flex justify-end gap-16 px-8 py-4 border-t bg-gray-50 rounded-b-xl">


        <a wire:navigate href="{{ route('admin.product.edit', $product) }}"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            Edit Product
        </a>

        {{-- Delete --}}
        <button wire:click="confirmDelete({{ $product->id }})" title="Delete"
            class="px-4 py-2 text-sm font-medium text-red-600 bg-red-100 rounded-lg hover:bg-red-300">
            Delete Product
        </button>
    </div>

    {{-- Delete Modal --}}
    <x-common.admin.modals.delete-confirmation :show="$deleteId" title="Delete Product" :item-name="$deleteName"
        cancel-action="cancelDelete" confirm-action="deleteProduct" confirm-text="Delete"
        loading-target="deleteProduct" />

</div>
