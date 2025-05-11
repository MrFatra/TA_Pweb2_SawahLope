<section class="max-w-2xl mx-auto my-12 p-6 border border-green-500 rounded-xl shadow-md bg-white">
    <h2 class="text-2xl font-semibold text-green-700 mb-6 text-center">Formulir Reservasi Sawah Lope</h2>
    <form action="#" method="POST" class="space-y-4">

        <!-- Kode Tiket -->
        <div>
            <label for="kode_tiket" class="block font-medium mb-1 text-gray-700">Kode Tiket</label>
            <input type="text" id="kode_tiket" name="kode_tiket" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="SL-XXXXXX">
        </div>

        <!-- Nama Lengkap -->
        <div>
            <label for="nama" class="block font-medium mb-1 text-gray-700">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="Nama Anda">
        </div>

        <!-- Nomor Telepon -->
        <div>
            <label for="telepon" class="block font-medium mb-1 text-gray-700">Nomor Telepon</label>
            <input type="tel" id="telepon" name="telepon" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="08xxxxxxxxxx">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-medium mb-1 text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="email@contoh.com">
        </div>

        <!-- Grid untuk Tanggal dan Jumlah Tamu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Tanggal Reservasi -->
            <div>
                <label for="tanggal" class="block font-medium mb-1 text-gray-700">Tanggal Reservasi</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500">
            </div>

            <!-- Jumlah Tamu -->
            <div>
                <label for="jumlah" class="block font-medium mb-1 text-gray-700">Jumlah Tamu</label>
                <input type="number" id="jumlah" name="jumlah" min="1" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="Masukkan jumlah tamu">
            </div>
        </div>

        <!-- Pilihan Menu (Ringkasan dan Modal) -->
        <div>
            <label class="block font-medium mb-1 text-gray-700">Menu yang Dipilih</label>
            <div class="flex justify-between items-center bg-gray-100 border border-gray-300 rounded-md px-4 py-2">
                <span class="text-gray-800">3 menu dipilih</span>
                <button type="button" onclick="document.getElementById('menuModal').classList.remove('hidden')" class="text-green-600 hover:underline text-sm">Lihat Detail</button>
            </div>
            <!-- Kirim data ke server -->
            <input type="hidden" name="menu" value="Nasi Oncom, Ayam Kampung Bakar, Karedok">
        </div>

        <!-- Harga Tiket -->
        <div>
            <label for="harga_tiket" class="block font-medium mb-1 text-gray-700">Harga Tiket (per orang)</label>
            <input type="text" id="harga_tiket" name="harga_tiket" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="Rp 50.000">
        </div>

        <!-- Harga Total -->
        <div>
            <label for="total" class="block font-medium mb-1 text-gray-700">Harga Total</label>
            <input type="text" id="total" name="total" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-green-500" placeholder="Akan terisi otomatis">
        </div>

        <div class="text-center pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200">
                Reservasi Sekarang
            </button>
        </div>

    </form>

    <!-- Modal -->
    <div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-md p-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Menu yang Dipilih</h3>
            <ul class="list-disc pl-5 space-y-1 text-gray-800">
                <li class="flex justify-between"><span>Nasi Oncom</span><span>Rp 15.000</span></li>
                <li class="flex justify-between"><span>Ayam Kampung Bakar</span><span>Rp 25.000</span></li>
                <li class="flex justify-between"><span>Karedok</span><span>Rp 18.000</span></li>
            </ul>
            <div class="text-right mt-6">
                <button onclick="document.getElementById('menuModal').classList.add('hidden')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Tutup</button>
            </div>
        </div>
    </div>
</section>

<script>
    // Script modal control (toggle visibility)
    function toggleModal() {
        const modal = document.getElementById('menuModal');
        modal.classList.toggle('hidden');
    }
</script>