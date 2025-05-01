@props(['href' => '#'])

<div>
    <a href="{{ $href }}" class="bg-green-500 text-white px-4 py-2 text-sm sm:px-6 sm:py-2.5 sm:text-base md:px-8 md:py-3 md:text-md hover:bg-green-600 rounded-full transition-all duration-200">
        {{ $slot }}
    </a>
</div>
