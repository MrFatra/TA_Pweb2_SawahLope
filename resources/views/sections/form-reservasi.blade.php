<section
    class="max-w-3xl mx-auto my-16 px-6 py-10 rounded-2xl shadow-xl border-r-8 border border-green-500 bg-white space-y-8">
    <!-- Header -->
    <div class="flex flex-col items-center space-y-2">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sawah Lope" class="w-10 h-auto" />
            <h2 class="text-green-500 font-semibold text-xl">Sawah Lope</h2>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">Formulir Reservasi</h1>
        <p class="text-gray-500 text-sm text-center">Silahkan cek data berikut untuk menyelesaikan reservasi Anda.</p>
    </div>

    <!-- Form -->
    <form action="#" method="POST" class="space-y-6">
        @csrf
        <!-- Info Tiket -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="kode_tiket" class="block mb-1 font-medium text-gray-700">Kode Tiket</label>
                <input type="text" id="kode_tiket" name="kode_tiket" value="{{ $ticket->ticket_code }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white"
                    placeholder="SL-XXXXXX" />
            </div>

            <div>
                <label for="nama" class="block mb-1 font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ $ticket->full_name }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white"
                    placeholder="Nama Anda" />
            </div>

            <div>
                <label for="telepon" class="block mb-1 font-medium text-gray-700">Nomor Telepon</label>
                <input type="tel" id="telepon" name="telepon" value="{{ $ticket->phone_number }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white"
                    placeholder="08xxxxxxxxxx" />
            </div>

            <div>
                <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ $ticket->email }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white"
                    placeholder="email@contoh.com" />
            </div>
        </div>

        <!-- Tanggal & Jumlah Tamu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="visit_date" class="block mb-1 font-medium text-gray-700">Tanggal Reservasi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M6 2a1 1 0 0 0-1 1v1H3a1 1 0 0 0-1 1v2h16V5a1 1 0 0 0-1-1h-2V3a1 1 0 0 0-2 0v1h-4V3a1 1 0 0 0-2 0V2Zm12 6H2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z" />
                        </svg>
                    </div>
                    <input id="visit_date" name="visit_date" readonly
                        value="{{ Carbon\Carbon::parse($ticket->visit_date)->format('m/d/Y') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white pl-10"
                        placeholder="Pilih Tanggal" />
                </div>
            </div>

            <div>
                <label for="jumlah" class="block mb-1 font-medium text-gray-700">Jumlah Tamu</label>
                <input type="number" id="jumlah" name="jumlah" min="1" value="{{ $ticket->guest_count }}"
                    readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white"
                    placeholder="Jumlah Tamu" />
            </div>
        </div>

        <!-- Menu Pilihan -->
        <div>
            <label class="block font-medium mb-1 text-gray-700">Menu yang Dipilih</label>
            <div
                class="flex justify-between items-center px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm">
                <span class="text-gray-800">{{ count($cartItems) }} menu dipilih</span>
                <button type="button" onclick="toggleModal()" class="text-green-600 hover:underline text-sm">Lihat
                    Detail</button>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t-2 border-dashed border-gray-300 my-8"></div>

        <!-- Harga -->
        @php
            $carts = $cartItems->sum(function ($cart) {
                return $cart->menu->price * $cart->quantity;
            });

            $total = $carts + $ticket->total_price;
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="harga_tiket" class="block font-medium mb-1 text-gray-700">Total Harga Tiket (Rp)</label>
                <input type="text" id="harga_tiket" name="harga_tiket"
                    value="{{ number_format($ticket->total_price, 0, ',', '.') }}" readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white" />
            </div>
            <div>
                <label for="total" class="block font-medium mb-1 text-gray-700">Harga Total (Rp)</label>
                <input type="text" id="total" name="total" value="{{ number_format($total, 0, ',', '.') }}"
                    readonly
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 shadow-sm bg-white" />
            </div>
        </div>

        <!-- Tombol -->
        <div class="pt-6 flex w-full">
            <button id="pay-button" type="button"
                class="flex w-full py-3 items-center justify-center rounded-md font-semibold text-white bg-green-500 hover:bg-green-700 cursor-pointer">
                <p>Reservasi Sekarang!</p>
            </button>
        </div>
    </form>

    <!-- Modal -->
    <div id="menuModal"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm flex w-full h-full justify-center items-center z-50 hidden overflow-hidden">
        <div class="bg-white rounded-lg shadow-xl w-11/12 max-w-md p-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Menu yang Dipilih</h3>
            <ul class="list-disc pl-5 space-y-2 text-gray-800 text-sm">
                @foreach ($cartItems as $cart)
                    <li class="flex justify-between">
                        <span>{{ $cart->menu->name }}</span>
                        <span>Rp {{ number_format($cart->menu->price, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="text-right mt-6">
                <button onclick="toggleModal()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm">Tutup</button>
            </div>
        </div>
    </div>

    <div id="loading-overlay"
        class="fixed inset-0 bg-white/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-all duration-300">
        <div class="flex flex-col items-center space-y-4">
            <div class="relative">
                <div class="absolute inset-0 animate-ping rounded-full bg-green-300 opacity-50 w-12 h-12 mx-auto">
                </div>
                <svg class="relative animate-spin h-12 w-12 text-green-500 drop-shadow"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
            </div>
            <p class="text-green-700 font-semibold text-lg animate-pulse tracking-wide">Mengalihkan halaman...</p>
        </div>
    </div>

</section>

<script>
    function toggleModal() {
        const modal = document.getElementById('menuModal');
        modal.classList.toggle('hidden');

        // Toggle scroll lock
        if (!modal.classList.contains('hidden')) {
            document.body.classList.add('overflow-hidden');
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        const payButton = document.getElementById('pay-button');
        const loadingOverlay = document.getElementById('loading-overlay');

        payButton.addEventListener('click', function() {
            snap.pay('{!! session('snapToken') !!}', {
                onSuccess: function(result) {
                    loadingOverlay.classList.remove('hidden');

                    fetch("{{ route('reservation') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                ticketId: {{ $ticket->id }},
                                payment_method: result.payment_type,
                                order_id: result.order_id
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => {
                                    throw new Error(err.message);
                                });
                            }
                            return response.json();
                        })
                        .then(data => {
                            window.location.href = "{{ route('landing') }}";
                        })
                        .catch(error => {
                            console.error("Terjadi kesalahan:", error.message);
                            alert("Terjadi kesalahan saat memproses pembayaran.");
                            loadingOverlay.classList.add('hidden');
                        });
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran...");
                },
                onError: function(result) {
                    alert("Pembayaran gagal!");
                },
                onClose: function() {
                    alert("Anda belum menyelesaikan pembayaran.");
                }
            });
        });
    });
</script>
