<div>

    <x-common.admin.alerts.success />

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Categories
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage product categories
            </p>
        </div>

        <a wire:navigate href="{{ route('admin.categories.create') }}"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            + Add Category
        </a>

    </div>

    {{-- Table Card --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm">

        {{-- Search --}}
        <div class="p-5 border-b border-gray-100">

            <x-common.admin.forms.search wire:model.live.debounce.300ms="search" placeholder="Search categories..." />

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="text-xs tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-4">
                            Category
                        </th>

                        <th class="px-6 py-4">
                            Parent Category
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Actions
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($categories as $category)
                        <tr class="transition-colors hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $category->name }}
                                </div>

                                <div class="text-xs text-gray-500">
                                    {{ $category->slug }}
                                </div>

                            </td>

                            <td class="px-6 py-4">

                                @if ($category->parent)
                                    <span class="px-2 py-1 text-xs font-medium text-blue-700 rounded-full bg-blue-50">
                                        {{ $category->parent->name }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium text-gray-700 rounded-full bg-gray-100">
                                        Main Category
                                    </span>
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <x-common.admin.badges.status :status="$category->status ? 'active' : 'inactive'" />

                            </td>

                            <td class="px-6 py-4 text-right">

                                <x-common.admin.tables.actions :editRoute="route('admin.categories.edit', $category)"
                                    deleteAction="confirmDelete({{ $category->id }})" />

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No categories found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <x-common.admin.tables.pagination :records="$categories" />

    </div>

    {{-- Delete Modal --}}
   <x-common.admin.modals.delete-confirmation
    :show="$deleteId"
    title="Delete Department"
    :item-name="$deleteName"
    cancel-action="cancelDelete"
    confirm-action="deleteCategory"
    confirm-text="Delete"
    loading-target="deleteCategory"
/>

</div>
