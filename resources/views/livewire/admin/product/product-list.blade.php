<div>
    <x-common.admin.alerts.success />
    <x-common.admin.alerts.error />

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Products
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage your products
            </p>
        </div>
        <a wire:navigate href="{{ route('admin.product.add-product') }}"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            + Add Product
        </a>
    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm">
        {{-- Search --}}
        <div class="p-5 border-b border-gray-100">
            <x-common.admin.forms.search wire:model.live.debounce.300ms="search" placeholder="Search products..." />

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="text-xs tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-4">
                            Product Name
                        </th>
                        <th class="px-6 py-4">
                            Category
                        </th>
                        <th class="px-6 py-4">
                            Original Price
                        </th>
                        <th class="px-6 py-4 text-right">
                            Selling Price
                        </th>
                        <th class="px-6 py-4">
                            Quantity
                        </th>
                        <th class="px-6 py-4">
                            Warranty
                        </th>
                        <th class="px-6 py-4">
                            Active Status
                        </th>
                        <th class="px-6 py-4">
                            Featured Status
                        </th>
                        <th class="px-6 py-4 text-right">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($products as $product)
                        <tr class="transition-colors hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $product->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $product->slug }}
                                </div>

                            </td>
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $product->category->slug ?? 'uncategorized' }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    ${{ number_format($product->original_price, 2) }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="font-medium text-gray-800">
                                    ${{ number_format($product->selling_price, 2) }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $product->quantity }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    {{ $product->warranty }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    <x-common.admin.badges.status :status="$product->is_active ? 'active' : 'inactive'" />
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    <x-common.admin.badges.status :status="$product->is_featured ? 'featured' : 'notfeatured'" />
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-common.admin.tables.actions :editRoute="route('admin.product.edit', $product)"
                                    deleteAction="confirmDelete({{ $product->id }})"
                                    :viewRoute="route('admin.product.view', $product)" />
                            </td>
                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No products found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <x-common.admin.tables.pagination :records="$products" />

    </div>

    {{-- Delete Modal --}}
    <x-common.admin.modals.delete-confirmation :show="$deleteId" title="Delete Product" :item-name="$deleteName"
        cancel-action="cancelDelete" confirm-action="deleteProduct" confirm-text="Delete"
        loading-target="deleteProduct" />

</div>
