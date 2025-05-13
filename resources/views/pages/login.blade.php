@extends('layouts.auth')

@section('content')
    <div class="max-h-screen flex">

        <div class="w-1/2 h-screen hidden md:flex items-center justify-center bg-gray-100">
            <img src="{{ asset('images/login-banner-2.jpg') }}" alt="Login Image" class="object-cover h-full w-full">
        </div>

        <div class="w-full md:w-1/2 flex justify-center p-10 flex-col text-gray-800">
            <div class="flex items-center mb-5 gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Sawah Lope" class="w-10 h-auto" />
                <h1 class="text-green-500 font-semibold text-4xl">Sawah Lope</h1>
            </div>
            <h2 class="text-3xl font-bold">Login</h2>
            <p class="text-gray-500 mb-8">Silahkan masukkan kode tiket pada form dibawah ini untuk melanjutkan pesanan.</p>
            <form method="POST" action="{{ route('auth.login') }}" class="">
                @csrf
                <div class="mb-10">
                    <label for="ticket_code" class="block text-sm font-medium text-gray-700">Kode Tiket</label>
                    <div class="relative">
                        <input id="ticket_code" name="ticket_code" type="text" required autofocus
                            placeholder="Masukkan Kode Tiket"
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm px-5 py-3 pr-12">

                        <!-- Ikon Eye -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 cursor-pointer">
                            <i class="fa-solid fa-eye-slash fa-lg text-gray-500"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 font-medium mt-1">Kode tiket dikirim melalui email. Silahkan cek email
                        anda.</p>
                </div>
                <button type="submit"
                    class="w-full text-lg font-bold tracking-wide bg-green-500 text-white py-3 rounded-md hover:bg-green-700 transition cursor-pointer">Login</button>
            </form>
            <p class="font-medium mt-3">Belum membeli tiket? <a href="{{ route('pay.buyTicket.view') }}"
                    class="text-green-500 hover:underline">Beli sekarang!</a></p>
        </div>
    </div>

    <script>
        const input = document.getElementById('ticket_code');
        const eyeIcon = document.querySelector('.fa-eye-slash');

        eyeIcon.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
@endsection
