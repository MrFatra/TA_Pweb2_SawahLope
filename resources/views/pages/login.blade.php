@extends('layouts.auth')

@section('content')
    <div class="max-h-screen flex">

        <div class="w-1/2 h-screen hidden md:flex items-center justify-center bg-gray-100">
            <img src="{{ asset('images/login-banner-2.jpg') }}" alt="Login Image" class="object-cover h-full w-full">
        </div>

        <div class="w-full md:w-1/2 flex justify-center p-10 flex-col">
            {{-- TODO add logo from navbar --}}
            <h1 class="text-green-500 font-semibold text-4xl mb-5">Sawah Lope</h1>
            <h2 class="text-3xl font-bold">Login</h2>
            <p class="text-gray-500 mb-10">Silahkan masukkan kode tiket pada form dibawah ini untuk melanjutkan pesanan.</p>
            <form method="POST" action="{{ route('login') }}" class="">
                @csrf
                <div class="mb-4">
                    <label for="ticket" class="block text-sm font-medium text-gray-700">Kode Tiket</label>
                    <input id="ticket" name="ticket" type="text" required autofocus
                    placeholder="Masukkan Kode Tiket"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-5 py-4">
                </div>
                <button type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-md hover:bg-green-700 transition cursor-pointer">Login</button>
            </form>
        </div>
    </div>
@endsection
