<form class="space-y-8 bg-gray-100 dark:bg-slate-900 p-6 rounded-lg" wire:submit.prevent="save">
    <x-common.admin.alerts.success message="Brand saved successfully!" />

    {{-- Header --}}
    <div class="flex items-center justify-between px-8 pt-6">

        <div>
            <div class="flex items-center gap-2 mb-1 text-sm text-gray-500">
                <a wire:navigate href="{{ route('admin.brands.index') }}" class="hover:text-blue-600">
                    Brands
                </a>
                <span>/</span>
                <span class="text-blue-600">
                    {{ $brandId ? 'Edit Brand' : 'New Brand' }}
                </span>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ $brandId ? 'Edit Brand' : 'Create Brand' }}
            </h1>
        </div>
        <a wire:navigate href="{{ route('admin.brands.index') }}"
            class="px-4 py-2 text-sm font-medium border rounded-lg">
            Back
        </a>
    </div>

    {{-- Body --}}
    <div
        class="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white dark:bg-slate-800 rounded-lg space-y-5 p-6 shadow-sm border border-gray-200 dark:border-slate-700 ">

        <div class="md:col-span-1 gap-4 items-end">
            <div class="mb-4">
                <x-common.admin.forms.input label="Brand Name" name="name" required wire:model.blur="name"
                    placeholder="e.g. Samsung" />
            </div>
            <div class="mb-4">
                <x-common.admin.forms.select label="Brand Status" name="is_active" wire:model="is_active"
                    :options="[1 => 'Active', 0 => 'Inactive']" required />
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="mb-4">
                    <label for="product-image-upload"
                        class="block text-sm font-medium text-gray-700 dark:text-slate-300">
                        Product Image Upload
                    </label>

                    @if (!$existingLogo && !$logo)
                        {{-- Only show upload dropzone when there is NO image at all --}}
                        <div>
                            <label for="product-image-upload"
                                class="cursor-pointer flex flex-col items-center justify-center border-2 border-dashed border-default-medium rounded-lg p-6 hover:border-blue-400 transition-colors">
                                <span class="justify-center items-center size-16">
                                    <svg class="shrink-0 w-16 text-primary mx-auto" width="73" height="47"
                                        viewBox="0 0 73 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M54.519 40.4773V6.76876C54.519 3.92686 52.2121 1.62305 49.3664 1.62305H22.7076C19.8619 1.62305 17.555 3.92686 17.555 6.76876V40.4773M54.519 40.4773C54.519 43.3192 52.2121 45.6231 49.3664 45.6231H22.7076C19.8619 45.6231 17.555 43.3192 17.555 40.4773M54.519 40.4773L54.5189 34.6563L48.6564 28.3566L43.2612 34.6373C42.4421 35.5908 40.9662 35.5955 40.141 34.6472L30.3406 23.3844L17.555 36.9154V40.4773M6.20483 9.59424L17.707 7.6798V42.5188L12.6457 43.5828C9.25658 44.2954 5.94238 42.0892 5.29702 38.691L1.14643 16.8357C0.500082 13.4322 2.78322 10.1637 6.20483 9.59424ZM65.8691 9.59424L54.3669 7.6798V42.5188L59.4282 43.5828C62.8173 44.2954 66.1316 42.0892 66.7769 38.691L70.9274 16.8357C71.5738 13.4322 69.2907 10.1637 65.8691 9.59424ZM45.0584 15.3561C45.0584 17.7228 43.1372 19.6413 40.7673 19.6413C38.3974 19.6413 36.4762 17.7228 36.4762 15.3561C36.4762 12.9894 38.3974 11.0708 40.7673 11.0708C43.1372 11.0708 45.0584 12.9894 45.0584 15.3561Z"
                                            stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </span>

                                <span class="text-sm text-body">Click to upload or drag & drop</span>

                                <input type="file" name="logo" id="product-image-upload" class="hidden"
                                    wire:model="logo" accept="image/*" />
                            </label>
                        </div>
                    @else
                        {{-- Image already present — show disabled/locked state instead of upload control --}}
                        <div
                            class="flex flex-col items-center justify-center border-2 border-dashed border-gray-200 bg-gray-50 rounded-lg p-6 text-center">
                            <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            <span class="text-sm text-gray-400">Remove the current image to upload a new one</span>
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-slate-300 mb-1.5">
                        Preview
                    </label>
                    <div class="grid grid-cols-2 gap-3">

                        {{-- Existing image --}}
                        @if ($existingLogo && !$logo)
                            <div class="relative border rounded-lg overflow-hidden group">
                                <img src="{{ Storage::url($existingLogo) }}"
                                    class="w-full h-24 object-cover" />
                                <button type="button" wire:click="removeExistingLogo"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    &times;
                                </button>
                            </div>
                        @endif

                        {{-- Newly selected image (temporary, not yet saved) --}}
                        @if ($logo)
                            <div class="relative border rounded-lg overflow-hidden group">
                                <img src="{{ $logo->temporaryUrl() }}" class="w-full h-24 object-cover" />
                                <button type="button" wire:click="removeLogo"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    &times;
                                </button>
                            </div>
                        @endif

                    </div>

                    <div wire:loading wire:target="logo" class="text-sm text-blue-500 mt-2">
                        Uploading...
                    </div>

                    @error('logo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="flex justify-end gap-3 px-8 py-4 border-t bg-gray-50 rounded-b-xl">

        <a wire:navigate href="{{ route('admin.brands.index') }}"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
            Cancel
        </a>

        <button type="submit"
            class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">

            <span wire:loading.remove>
                {{ $brandId ? 'Update Brand' : 'Create Brand' }}
            </span>

        </button>

    </div>
</form>
