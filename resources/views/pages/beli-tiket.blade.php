@extends('layouts.auth')

@section('content')
    <div class="flex">

        <div class="w-1/2 h-full hidden md:flex items-center justify-center bg-gray-100">
            <img src="{{ asset('images/beli-tiket-banner.jpg') }}" alt="Beli Tiket Image" class="object-cover h-full w-full">
        </div>

        <div class="w-full md:w-1/2 flex justify-center p-10 flex-col">
            <div class="flex items-center mb-5 gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sawah Lope" class="w-10 h-auto" />
                <h1 class="text-green-500 font-semibold text-4xl">Sawah Lope</h1>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Beli Tiket</h2>
            <p class="text-gray-500 mb-8">Silakan isi data berikut untuk melakukan pembelian tiket.</p>

            <form method="POST" action="{{ route('pay.buyTicket') }}">
                @csrf

                <div class="mb-5">
                    <label for="full_name" class="block text-sm font-medium text-gray-800">Nama Lengkap</label>
                    <input id="full_name" name="full_name" type="text" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm px-5 py-3">
                </div>

                <div class="mb-5">
                    <label for="phone_number" class="block text-sm font-medium text-gray-800">Nomor Telepon</label>
                    <input id="phone_number" name="phone_number" type="number" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm px-5 py-3">
                </div>

                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-800">Email</label>
                    <input id="email" name="email" type="email" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm px-5 py-3">
                </div>

                <div class="mb-5">
                    <label for="visit_date" class="block text-sm font-medium text-gray-800">Tanggal Kunjungan</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input id="visit_date" name="visit_date" required
                            value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" datepicker datepicker-autohide
                            type="text"
                            class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm ps-10 p-3"
                            placeholder="Pilih Tanggal Kunjungan">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="guest_count" class="block text-sm font-medium text-gray-800">Jumlah Pengunjung</label>
                    <input id="guest_count" name="guest_count" type="number" min="1" value="1" required
                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm px-5 py-3">
                </div>

                <div class="mb-8">
                    <label for="total_price" class="block text-sm font-medium text-gray-800">Total Harga (Rp)</label>
                    <input id="total_price" name="total_price" type="text" readonly
                        class="mt-1 block w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-green-500 shadow-sm px-5 py-3 text-gray-600">
                    <p class="text-sm font-medium text-gray-500">Harga tiket dihitung otomatis berdasarkan jumlah
                        pengunjung.</p>
                </div>

                <button type="submit"
                    class="flex gap-3 justify-center items-center w-full text-lg font-bold bg-green-500 text-white py-3 rounded-md hover:bg-green-700 transition cursor-pointer">
                    Lanjutkan Pembayaran
                    <i class="fa-solid fa-arrow-right ml-1"></i>
                </button>
            </form>
        </div>
    </div>

    <script>
        const guestCountInput = document.getElementById('guest_count');
        const totalPriceInput = document.getElementById('total_price');

        function updatePrice() {
            const guestCount = parseInt(guestCountInput.value) || 0;
            const total = guestCount * 10000;
            totalPriceInput.value = total.toLocaleString('id-ID');
        }

        guestCountInput.addEventListener('input', updatePrice);
        window.addEventListener('DOMContentLoaded', updatePrice);
    </script>
@endsection
