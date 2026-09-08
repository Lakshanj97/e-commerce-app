<div>
    <x-common.admin.alerts.success />
    <x-common.admin.alerts.error />

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Brands
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Manage your brands
            </p>
        </div>
        <a wire:navigate href="{{ route('admin.brands.create') }}"
            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            + Add Brand
        </a>
    </div>
    {{-- Table Card --}}
    <div class="overflow-hidden bg-white border border-gray-200 rounded-xl shadow-sm">
        {{-- Search --}}
        <div class="p-5 border-b border-gray-100">
            <x-common.admin.forms.search wire:model.live.debounce.300ms="search" placeholder="Search brands..." />

        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="text-xs tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                    <tr>
                        <th class="px-6 py-4">
                            Brand ID
                        </th>
                        <th class="px-6 py-4">
                            Brand Name
                        </th>
                        <th class="px-6 py-4">
                            Active Status
                        </th>
                        <th class="px-6 py-4 text-right">
                            Logo
                        </th>
                        <th class="px-6 py-4 text-right">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($brands as $brand)
                        <tr class="transition-colors hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $brand->id }}
                                </div>

                            </td>
                            <td class="px-6 py-4">

                                <div class="font-medium text-gray-800">
                                    {{ $brand->name }}
                                </div>

                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">
                                    <x-common.admin.badges.status :status="$brand->is_active ? 'active' : 'inactive'" />
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($brand->logo_path)
                                    <img src="{{ \Storage::url($brand->logo_path) }}" alt="{{ $brand->name }}"
                                        class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <span class="text-gray-500">No Logo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <x-common.admin.tables.actions :editRoute="route('admin.brands.edit', $brand)"
                                    deleteAction="confirmDelete({{ $brand->id }})" />
                            </td>
                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No brands found.
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <x-common.admin.tables.pagination :records="$brands" />

    </div>

    {{-- Delete Modal --}}
    <x-common.admin.modals.delete-confirmation :show="$deleteId" title="Delete Brand" :item-name="$deleteName"
        cancel-action="cancelDelete" confirm-action="deleteBrand" confirm-text="Delete" loading-target="deleteBrand" />

</div>
