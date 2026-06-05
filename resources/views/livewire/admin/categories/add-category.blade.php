<div>

    <x-common.admin.alerts.success />

    <div
        class="rounded-xl border border-gray-200 bg-white shadow-sm"
    >

        <form wire:submit="save">

            {{-- Header --}}
            <div class="flex items-center justify-between px-8 pt-6">

                <div>

                    <div class="flex items-center gap-2 mb-1 text-sm text-gray-500">

                        <a
                            wire:navigate
                            href="{{ route('admin.categories.index') }}"
                            class="hover:text-blue-600"
                        >
                            Categories
                        </a>

                        <span>/</span>

                        <span class="text-blue-600">
                            {{ $categoryId ? 'Edit Category' : 'New Category' }}
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold text-gray-800">
                        {{ $categoryId ? 'Edit Category' : 'Create Category' }}
                    </h1>

                </div>

                <a
                    wire:navigate
                    href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-sm font-medium border rounded-lg"
                >
                    Back
                </a>

            </div>

            {{-- Body --}}
            <div class="max-w-2xl p-8">

                <div class="pb-3 mb-6 border-b">

                    <h2 class="font-semibold text-gray-800">
                        Category Information
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Enter category details below.
                    </p>

                </div>

                <div class="space-y-5">

                    {{-- Name --}}
                    <x-common.admin.forms.input
                        label="Category Name"
                        name="name"
                        wire:model.blur="name"
                        required
                        placeholder="Enter category name"
                    />

                    {{-- Parent Category --}}
                    <div>

                        <label
                            class="block mb-1.5 text-sm font-medium text-gray-700"
                        >
                            Parent Category
                        </label>

                        <select
                            wire:model="parent_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        >

                            <option value="">
                                Main Category
                            </option>

                            @foreach($parentCategories as $parent)

                                <option value="{{ $parent->id }}">
                                    {{ $parent->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- Status --}}
                    <div>

                        <label
                            class="inline-flex items-center gap-3 cursor-pointer"
                        >

                            <input
                                type="checkbox"
                                wire:model="status"
                                class="rounded border-gray-300"
                            >

                            <span class="text-sm font-medium text-gray-700">
                                Active Category
                            </span>

                        </label>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div
                class="flex justify-end gap-3 px-8 py-4 border-t bg-gray-50 rounded-b-xl"
            >

                <a
                    wire:navigate
                    href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                >

                    <span wire:loading.remove>
                        {{ $categoryId ? 'Update Category' : 'Create Category' }}
                    </span>

                    <span wire:loading>
                        Saving...
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>