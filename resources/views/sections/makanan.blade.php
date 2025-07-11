<section class="px-4 lg:px-16">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-bold text-green-500">🍜 Sekilas Makanan</h1>
        <a href="{{ route('menu.list') }}"
            class="inline-flex items-center gap-3 px-5 py-3 border border-green-500 text-green-600 font-semibold rounded-full hover:bg-green-500 hover:text-white transition duration-300">
            <span>Lihat Selengkapnya</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach ($menu as $item)
            <div
                class="group relative rounded-md overflow-hidden shadow-md hover:shadow-xl transition duration-300 transform ">
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                    class="w-full h-72 object-cover transition duration-500">
                <!-- Overlay -->
                <div
                    class="absolute inset-0 bg-gradient-to-t from-green-500 via-green-700/50 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 ease-in-out">
                </div>

                <!-- Konten -->
                <div
                    class="absolute bottom-0 p-5 text-white z-10 transition duration-300 ease-in-out transform translate-y-full group-hover:translate-y-0">
                    <h3 class="text-lg font-bold">{{ $item->name }}</h3>
                    <p class="text-sm mt-1">{{ $item->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
