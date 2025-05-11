@extends('layouts.app')

@php
    $logged = session('ticket_id');
@endphp

@section('content')
    <div class="px-2 md:px-5 xl:px-10 py-8">

        <h2 class="text-4xl font-bold">Daftar Menu</h2>
        <div class="flex flex-col lg:flex-row gap-5">
            <!-- Kiri: Menu -->
            <div class="w-full lg:w-2/3 overflow-y-auto">
                <!-- Makanan Berat -->
                @foreach ($menus as $category)
                    @if ($category->menus->isNotEmpty())
                        <h4 class="text-2xl text-center font-bold my-10">{{ $category->name }}</h4>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                        @foreach ($category->menus as $menu)
                            <div class="flex flex-col border-2 border-green-500 rounded overflow-hidden">
                                <div class="px-2 py-2 flex flex-col">
                                    <div
                                        class="group relative rounded overflow-hidden cursor-pointer hover:after:absolute after:inset-0 after:bg-[#34e0a1]/90">
                                        <img src="{{ Storage::url($menu->image) }}" alt=""
                                            class="w-full h-[200px] object-cover">
                                        <h5
                                            class="absolute bottom-5 pl-5 pr-3 rounded-r py-1 font-semibold text-white bg-[#34e0a1]">
                                            {{ $menu->name }}</h5>
                                        <div
                                            class="group-hover:block hidden text-xs absolute bottom-0 lg:p-5 p-3 z-10 text-white">
                                            <h2 class="font-semibold text-lg">{{ $menu->name }}</h2>
                                            <p class="mt-2 mb-4 text-justify">{{ $menu->description }}</p>
                                        </div>
                                    </div>
                                    <h4 class="font-semibold text-lg pt-5 pl-3">Rp.
                                        {{ number_format($menu->price, 0, ',', '.') }}</h4>
                                    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col">
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        @csrf
                                        <div
                                            class="flex justify-between items-center gap-6 font-semibold text-white text-xl mt-3 mb-3 border-gray-300 border-2 rounded-full">
                                            <i
                                                class="fa-solid fa-minus btn-minus bg-red-500 hover:bg-red-700 rounded-full px-3 py-2 cursor-pointer"></i>
                                            <input type="number" value="1" name="quantity"
                                                class="menu-qty w-full text-black text-center focus:border focus:border-green-400 focus:outline-none focus:ring-0 text-base" />
                                            <i
                                                class="fa-solid fa-plus btn-plus bg-green-500 hover:bg-green-700 rounded-full px-3 py-2 cursor-pointer"></i>
                                        </div>
                                        <button type="submit"
                                            class="@if ($logged) bg-green-500 hover:bg-green-700 cursor-pointer @else bg-gray-300 cursor-not-allowed @endif rounded font-medium text-white text-sm p-2"
                                            @unless ($logged) disabled @endunless>
                                            Tambah ke keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Kanan: Cart -->
            @if (session('ticket_id'))
                <div class="w-full lg:w-1/3 p-6 h-full block lg:sticky top-16  overflow-y-auto">
                    <div class="p-5 rounded-md bg-white shadow-xl/30">
                        <h2 class="text-2xl font-bold mb-4">Rincian Pesanan</h2>
                        <div class="space-y-4">
                            @foreach ($carts as $cart)
                                <div class="relative flex justify-between items-center border-b pb-2">
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $cart->menu->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $cart->quantity }} x</p>
                                    </div>
                                    <p class="flex flex-1 font-medium justify-end mr-2">Rp.
                                        {{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</p>
                                    <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-700 rounded-md px-2 py-1 text-white cursor-pointer"><i
                                                class="fa-solid fa-xmark"></i></button>
                                    </form>
                                </div>
                            @endforeach
                            <div class="flex justify-between">
                                <h2 class="text-lg font-bold">Total:</h2>
                                @php
                                    $total = $carts->sum(function ($cart) {
                                        return $cart->menu->price * $cart->quantity;
                                    });
                                @endphp
                                <p class="font-medium">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                            <div class="pt-2 border-t mt-3">
                                <div class="my-10">
                                    <x-button class="w-full">Pesan Sekarang</x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="w-full lg:w-1/3 p-10 h-full block lg:sticky top-16 overflow-y-auto">
                    <div class="p-5 rounded bg-white shadow-xl/30">
                        <p class="font-bold text-xl text-center text-gray-500">Silahkan login terlebih dahulu untuk melakukan reservasi.</p>
                    </div>
                </div>
            @endif

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const plusButtons = document.querySelectorAll(".btn-plus");
            const minusButtons = document.querySelectorAll(".btn-minus");

            plusButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    const input = this.parentElement.querySelector(".menu-qty");
                    let value = parseInt(input.value) || 0;
                    input.value = value + 1;
                });
            });

            minusButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    const input = this.parentElement.querySelector(".menu-qty");
                    let value = parseInt(input.value) || 0;
                    if (value > 1) input.value = value - 1;
                });
            });
        });
    </script>
@endsection
