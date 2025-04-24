@props(['href' => '#'])

<div>
    <a href="{{ $href }}" class="bg-green-500 text-white px-10 py-4 hover:bg-green-600 text-md rounded-full">
        {{ $slot }}
    </a>
</div>