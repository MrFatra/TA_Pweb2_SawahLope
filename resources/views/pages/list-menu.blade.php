@extends('layouts.app')

@section('content')
<div class="px-2 md:px-5 xl:px-10 py-8">

    <h2 class="text-4xl font-bold">Daftar Menu</h2>
    <div class="flex flex-col lg:flex-row gap-5">
        <!-- Kiri: Menu -->
        <div class="w-full lg:w-2/3 overflow-y-auto">
            <!-- Makanan Berat -->
            <h4 class="text-2xl font-bold my-4 text-gray-800">Makanan Berat</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="flex flex-col border-2 border-green-500 rounded overflow-hidden">
                    <div class="px-2 py-2">
                        <div class="group relative rounded overflow-hidden cursor-pointer hover:after:absolute after:inset-0 after:bg-[#34e0a1]/90">
                            <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/0896b65a-6d1e-4583-b60c-573359528121_Go-Biz_20220218_132132.jpeg"
                                alt="" class="w-full h-[200px] object-cover">
                            <h5 class="absolute bottom-5 pl-5 pr-3 rounded-r py-1 font-semibold text-white bg-[#34e0a1]">
                                Paket Nasi Timbel</h5>
                            <div class="group-hover:block hidden text-xs absolute bottom-0 lg:p-5 p-3 z-10 text-white">
                                <h2 class="font-semibold text-lg">Paket Nasi Timbel</h2>
                                <p class="mt-2 mb-4 text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quae facilis magnam corporis ipsa error excepturi!.</p>
                            </div>
                        </div>
                        <h4 class="font-semibold text-lg pt-5 pl-3">Rp. 192.500</h4>
                        <div class="flex justify-center gap-6 font-semibold text-white text-xl mt-3 mb-3">
                            <p class="rounded-full bg-red-500 py-1 px-3">-</p>
                            <p class="text-black">1</p>
                            <p class="rounded-full py-1 px-3 bg-green-500">+</p>
                        </div>
                    </div>
            </div>
            @endfor
        </div>

        <!-- Makanan Ringan -->
        <h4 class="text-2xl font-bold my-4 text-gray-800">Makanan Ringan</h4>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
            @for ($i = 1; $i <= 5; $i++)
                <div class="flex flex-col border-2 border-green-500 rounded overflow-hidden">
                <div class="px-2 py-2">
                    <div class="group relative rounded overflow-hidden cursor-pointer hover:after:absolute after:inset-0 after:bg-[#34e0a1]/90">
                        <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/ab6608e6-6af5-4f4a-a3d6-8550b32e371f_Go-Biz_20220218_135158.jpeg?auto=format"
                            alt="" class="w-full h-[200px] object-cover">
                        <h5 class="absolute bottom-5 pl-5 pr-3 rounded-r py-1 font-semibold text-white bg-[#34e0a1]">
                            Sosis dan Nugget</h5>
                        <div class="group-hover:block hidden text-xs absolute bottom-0 lg:p-5 p-3 z-10 text-white">
                            <h2 class="font-semibold text-lg">Sosis dan Nugget</h2>
                            <p class="mt-2 mb-4 text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, consequuntur qui possimus ducimus obcaecati nam!.</p>
                        </div>
                    </div>
                    <h4 class="font-semibold text-lg pt-5 pl-3">Rp. 13.000</h4>
                    <div class="flex justify-center gap-6 font-semibold text-white text-xl mt-3 mb-3">
                        <p class="rounded-full bg-red-500 py-1 px-3">-</p>
                        <p class="text-black">1</p>
                        <p class="rounded-full py-1 px-3 bg-green-500">+</p>
                    </div>
                </div>
        </div>
        @endfor
    </div>

    <!-- Minuman -->
    <h4 class="text-2xl font-bold my-4 text-gray-800">Minuman</h4>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @for ($i = 1; $i <= 5; $i++)
            <div class="flex flex-col border-2 border-green-500 rounded overflow-hidden">
            <div class="px-2 py-2">
                <div class="group relative rounded overflow-hidden cursor-pointer hover:after:absolute after:inset-0 after:bg-[#34e0a1]/90">
                    <img src="https://cdn1-production-images-kly.akamaized.net/OUqqLu3BtXjfJac0EtxLVMETVws=/1200x1200/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3128504/original/083078300_1589462572-shutterstock_435468841.jpg"
                        alt="" class="w-full h-[200px] object-cover">
                    <h5 class="absolute bottom-5 pl-5 pr-3 rounded-r py-1 font-semibold text-white bg-[#34e0a1]">
                        Es Teh Manis</h5>
                    <div class="group-hover:block hidden text-xs absolute bottom-0 lg:p-5 p-3 z-10 text-white">
                        <h2 class="font-semibold text-lg">Es Teh Manis</h2>
                        <p class="mt-2 mb-4 text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, consequuntur qui possimus ducimus obcaecati nam!.</p>
                    </div>
                </div>
                <h4 class="font-semibold text-lg pt-5 pl-3">Rp. 13.000</h4>
                <div class="flex justify-center gap-6 font-semibold text-white text-xl mt-3 mb-3">
                    <p class="rounded-full bg-red-500 py-1 px-3">-</p>
                    <p class="text-black">1</p>
                    <p class="rounded-full py-1 px-3 bg-green-500">+</p>
                </div>
            </div>
    </div>
    @endfor
</div>
</div>

<!-- Kanan: Cart -->
<div class="w-full lg:w-1/3 p-6 h-full block lg:sticky top-16  overflow-y-auto">
    <div class="p-5 rounded bg-gray-100 shadow-xl">
        <h2 class="text-2xl font-bold mb-4">Rincian Pesanan</h2>
        <div class="space-y-4">
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <p class="font-semibold">Nasi Timbel</p>
                    <p class="text-sm text-gray-500">x1</p>
                </div>
                <p class="font-medium">Rp 25.000</p>
            </div>
            <div class="flex justify-between">
                <h2 class="text-lg font-bold">SubTotal</h2>
                <p class="font-medium">Rp 25.000</p>
            </div>
            <div class="pt-2 border-t mt-3">
                <div class="my-10">
                    <x-button class="w-full">Pesan Sekarang</x-button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>
@endsection