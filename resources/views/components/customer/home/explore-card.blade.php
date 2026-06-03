@props([
    'title',
    'imageSrc',
    'imageAlt'
])


<div class="flex justify-between bg-gray-100 rounded-lg p-4 shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1)]">
    <div class="w-auto">
        <h2 class="text-xl mb-4">{{ $title }}</h2>
        <a href="#" class="text-blue-600 flex items-center gap-1">
            Explore
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                <path fill-rule="evenodd"
                    d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
    <div>
        <img src="{{ $imageSrc }}" alt="{{ $imageAlt }}" class="w-36 h-28 object-cover rounded-lg">
    </div>
</div>
