@props(['name', 'label', 'options' => []])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-slate-300">
        {{ $label }}
    </label>

    <select name="{{ $name }}" id="{{ $name }}"
        class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-400 focus:border-blue-400 focus:shadow-blue-400 w-full px-3 py-2.5 shadow-xs placeholder:text-body
               @error($name) border-red-400 @enderror"
        {{ $attributes }} >
        <option value="">Select Option</option>

        @foreach($options as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>

    @error($name)
        <p class="mt-1 text-xs text-red-500">
            {{ $message }}
        </p>
    @enderror
</div>
