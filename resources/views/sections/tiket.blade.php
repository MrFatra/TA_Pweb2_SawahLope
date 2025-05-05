<section class="py-16 px-10">
    <h1 class="text-3xl font-bold text-green-500 mb-10 text-center">Beli Tiket Sekarang!!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Tiket Dewasa 1 -->
        <div class="flex flex-col items-center lg:border-r md:border-r-2 border-green-500 pr-4 md:pr-10">
            <i class="fa-solid fa-person text-5xl mb-4 text-gray-700"></i>
            <h2 class="text-2xl font-bold text-center mb-2">DEWASA</h2>
            <p class="text-xl text-center mb-6">Rp. 10.000</p>
            <div class="flex items-center gap-4">
                <button onclick="decreaseTicket('count1')" class="bg-red-500 text-white px-4 py-2 rounded-full font-bold hover:bg-red-600">−</button>
                <span id="count1" class="text-2xl font-bold">0</span>
                <button onclick="increaseTicket('count1')" class="bg-green-500 text-white px-4 py-2 rounded-full font-bold hover:bg-green-600">+</button>
            </div>
            <div class="mt-7">
                <x-button href="/produk">Pesan</x-button>

            </div>
        </div>

        <!-- Tiket Dewasa 2 -->
        <div class="flex flex-col items-center pr-4 md:pr-10">
            <i class="fa-solid fa-person text-5xl mb-4 text-gray-700"></i>
            <h2 class="text-2xl font-bold text-center mb-2">DEWASA</h2>
            <p class="text-xl text-center mb-6">Rp. 10.000</p>
            <div class="flex items-center gap-4">
                <button onclick="decreaseTicket('count1')" class="bg-red-500 text-white px-4 py-2 rounded-full font-bold hover:bg-red-600">−</button>
                <span id="count1" class="text-2xl font-bold">0</span>
                <button onclick="increaseTicket('count1')" class="bg-green-500 text-white px-4 py-2 rounded-full font-bold hover:bg-green-600">+</button>
            </div>
            <div class="mt-7">
                <x-button href="/produk">Pesan</x-button>

            </div>
        </div>
    </div>
</section>

<script>
    const counters = {
        count1: 0,
        count2: 0
    };

    function increaseTicket(id) {
        counters[id]++;
        document.getElementById(id).textContent = counters[id];
    }

    function decreaseTicket(id) {
        if (counters[id] > 0) {
            counters[id]--;
            document.getElementById(id).textContent = counters[id];
        }
    }
</script>