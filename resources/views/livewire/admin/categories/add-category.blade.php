<div>

    <x-common.admin.alerts.success />
    <x-common.admin.alerts.error />

    <div class="rounded-xl border border-gray-200 bg-white shadow-sm">

        <form wire:submit="save">

            {{-- Header --}}
            <div class="flex items-center justify-between px-8 pt-6">

                <div>
                    <div class="flex items-center gap-2 mb-1 text-sm text-gray-500">
                        <a wire:navigate href="{{ route('admin.categories.index') }}"
                            class="hover:text-blue-600">
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

                <a wire:navigate href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-sm font-medium border rounded-lg">
                    Back
                </a>

            </div>

            {{-- Body --}}
            <div class="max-w-2xl p-8">

                <div class="pb-3 mb-6 border-b">
                    <h2 class="font-semibold text-gray-800">Category Information</h2>
                    <p class="mt-1 text-sm text-gray-500">Enter category details below.</p>
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

                    {{-- Slug --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Slug
                            <span class="ml-1 text-xs font-normal text-gray-400">(auto-generated, editable)</span>
                        </label>

                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden
                                    focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500">

                            <span class="px-3 py-2.5 text-sm text-gray-400 bg-gray-50 border-r border-gray-300 select-none">
                                /categories/
                            </span>

                            <input
                                type="text"
                                wire:model.blur="slug"
                                placeholder="category-slug"
                                class="flex-1 px-3 py-2.5 text-sm bg-white outline-none"
                            />

                        </div>

                        @error('slug')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Parent Category --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Parent Category
                        </label>

                        <select
                            wire:model="parent_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg
                                   focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                        >
                            <option value="">Main Category</option>

                            @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Category Image --}}
                    <div class="space-y-2">

                        <label class="block text-sm font-medium text-gray-700">
                            Category Image
                            <span class="ml-1 text-xs font-normal text-gray-400">JPG, PNG, WebP · max 2 MB</span>
                        </label>

                        {{-- Existing image preview (edit mode) --}}
                        @if ($existingImage && !$removeImage)
                            <div class="flex items-center gap-4 p-3 border border-gray-200 rounded-lg bg-gray-50">

                                <img
                                    src="{{ Storage::url($existingImage) }}"
                                    alt="Current category image"
                                    class="w-16 h-16 rounded-lg object-cover border border-gray-200"
                                />

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700 truncate">
                                        Current Image
                                    </p>
                                    <p class="text-xs text-gray-400 mt-0.5 truncate">
                                        {{ basename($existingImage) }}
                                    </p>
                                </div>

                                <button
                                    type="button"
                                    wire:click="removeExistingImage"
                                    class="flex-shrink-0 px-3 py-1.5 text-xs font-medium text-red-600
                                           border border-red-200 rounded-lg hover:bg-red-50 transition-colors"
                                >
                                    Remove
                                </button>

                            </div>
                        @endif

                        {{-- New image upload input --}}
                        <div class="flex items-center gap-3">
                            <input
                                type="file"
                                wire:model="newImage"
                                accept="image/jpeg,image/png,image/webp"
                                class="block w-full text-sm text-gray-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-lg file:border-0
                                       file:text-sm file:font-medium
                                       file:bg-blue-50 file:text-blue-700
                                       hover:file:bg-blue-100"
                            />

                            {{-- Upload spinner --}}
                            <div wire:loading wire:target="newImage" class="flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-500 animate-spin" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- New image preview --}}
                        @if ($newImage)
                            <div class="flex items-center gap-4 p-3 border border-blue-200 rounded-lg bg-blue-50">

                                <img
                                    src="{{ $newImage->temporaryUrl() }}"
                                    alt="New image preview"
                                    class="w-16 h-16 rounded-lg object-cover border border-blue-200"
                                />

                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700">New Image Preview</p>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ number_format($newImage->getSize() / 1024, 1) }} KB
                                    </p>
                                </div>

                            </div>
                        @endif

                        @error('newImage')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                wire:model="status"
                                class="rounded border-gray-300"
                            >
                            <span class="text-sm font-medium text-gray-700">Active Category</span>
                        </label>
                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-8 py-4 border-t bg-gray-50 rounded-b-xl">

                <a wire:navigate href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Cancel
                </a>

                <button
                    type="submit"
                    class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                >
                    <span wire:loading.remove wire:target="save">
                        {{ $categoryId ? 'Update Category' : 'Create Category' }}
                    </span>
                    <span wire:loading wire:target="save">
                        Saving...
                    </span>
                </button>

            </div>

        </form>

    </div>

</div>