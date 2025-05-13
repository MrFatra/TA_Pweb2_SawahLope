@extends('layouts.payment')

@section('content')
    <div class="flex max-h-screen">
        <div class="w-1/2 h-screen hidden md:flex items-center justify-center bg-gray-100">
            <img src="{{ asset('images/beli-tiket-banner.jpg') }}" alt="Login Image" class="object-cover h-full w-full">
        </div>

        <div class="w-full md:w-1/2 flex justify-center p-10 flex-col">
            <div id="payment-card" class="block hidden max-w-2xl mx-auto p-6 mt-10 bg-white rounded-lg shadow-lg">
                <div class="flex items-center mb-5 gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Sawah Lope" class="w-10 h-auto" />
                    <h1 class="text-green-500 font-semibold text-4xl">Sawah Lope</h1>
                </div>

                <h2 class="text-3xl font-bold">Detail Pembayaran Tiket</h2>
                <p class="text-gray-500 mb-8">Silahkan Anda cek detail pesanan berikut.</p>

                <div class="mb-10">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2 text-gray-700">Detail Tiket</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-gray-600">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama Lengkap</p>
                            <p class="text-base font-semibold text-gray-800">{{ $ticket->full_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Email</p>
                            <p class="text-base font-semibold text-gray-800">{{ $ticket->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">No. Telepon</p>
                            <p class="text-base font-semibold text-gray-800">{{ $ticket->phone_number ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Kunjungan</p>
                            <p class="text-base font-semibold text-gray-800">
                                {{ \Carbon\Carbon::parse($ticket->visit_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Tamu</p>
                            <p class="text-base font-semibold text-gray-800">{{ $ticket->guest_count }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Bayar</p>
                            <p class="text-base font-bold text-green-600">
                                Rp{{ number_format($ticket->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <button id="pay-button"
                    class="w-full bg-green-500 text-white py-3 rounded-md hover:bg-green-700 transition">
                    Bayar Sekarang!
                </button>
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

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const payButton = document.getElementById('pay-button');
            const loadingOverlay = document.getElementById('loading-overlay');
            const paymentCard = document.getElementById('payment-card');

            paymentCard.classList.remove('hidden');

            payButton.addEventListener('click', function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        loadingOverlay.classList.remove('hidden');
                        paymentCard.classList.add('hidden');

                        fetch("{{ route('pay.ticket-checkout') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ticket_id: {{ $ticket->id }},
                                    payment_method: result.payment_type,
                                    order_id: result.order_id
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                window.location.href = "{{ route('auth.login.view') }}";
                            })
                            .catch(error => {
                                console.error("Terjadi kesalahan:", error);
                                alert("Terjadi kesalahan saat memproses pembayaran.");
                                loadingOverlay.classList.add('hidden');
                                paymentCard.classList.remove('hidden');
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
@endsection
