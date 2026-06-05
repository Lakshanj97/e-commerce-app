@props([
    'label',
    'name'
])

<div>

    <label class="block mb-1.5 text-sm font-medium text-gray-700">
        {{ $label }}
    </label>

    <textarea
        {{ $attributes }}
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
               focus:border-blue-500 focus:ring-1 focus:ring-blue-500
               @error($name) border-red-400 @enderror"></textarea>

    @error($name)
        <p class="mt-1 text-xs text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>