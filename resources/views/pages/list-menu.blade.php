@extends('layouts.app')

@section('content')
    <div class="flex min-h-screen">
        <!-- List Makanan (Kiri - 2/3) -->
        <div class="w-2/3 p-6 bg-white overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Daftar Makanan</h2>
            <div class="grid grid-cols-3 gap-5">

                @for ($i = 1; $i <= 8; $i++)
                    <div class="flex flex-col">
                        <div
                            class="hoverCard group relative rounded overflow-hidden cursor-pointer after:content-[''] hover:after:absolute after:inset-0 after:bg-[#34e0a1]/90">
                            <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/0896b65a-6d1e-4583-b60c-573359528121_Go-Biz_20220218_132132.jpeg"
                                alt="" class="w-full h-[300px] object-cover">

                            <h5
                                class="titleHoverCard absolute bottom-5 pl-5 pr-3 rounded-r py-1 font-semibold text-white bg-[#34e0a1]">
                                Paket Nasi Timbel</h5>

                            <div
                                class="contentHoverCard group-hover:block hidden text-xs absolute bottom-0 lg:p-5 p-3 z-10 text-white">
                                <h5 class="font-semibold text-base">Paket Nasi Timbel</h5>
                                <p class="mt-2 mb-4 text-justify">Merupakan sebuah kampung adat yang masih lestari.
                                    Masyarakatnya masih memegang adat tradisi nenek moyang mereka </p>
                            </div>
                        </div>
                        <div class="flex justify-between font-semibold text-white text-xl mt-5">
                            <p class="rounded-full bg-red-500 py-1 px-3">-</p>
                            <p class="text-black">1</p>
                            <p class="rounded-full py-1 px-3 bg-green-500">+</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Drawer Cart (Kanan - 1/3) -->
        <div
            class="w-1/3 p-6 bg-green-100 drop-shadow-green-200 drop-shadow-xl h-screen sticky top-0 bottom-0 overflow-y-auto">
            <h2 class="text-2xl font-bold mb-4">Cart</h2>
            <div class="space-y-4">
                <!-- Item Cart contoh -->
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <p class="font-semibold">Makanan A</p>
                        <p class="text-sm text-gray-500">x1</p>
                    </div>
                    <p class="font-medium">Rp 25.000</p>
                </div>

                <!-- Tombol Checkout -->
                <div class="pt-4 border-t mt-6">
                    <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
