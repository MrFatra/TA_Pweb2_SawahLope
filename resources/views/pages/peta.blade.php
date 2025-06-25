@extends('layouts.app')

@section('content')
    <div class="pt-10 xl:px-16 md:px-5 px-3 text-gray-800">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <div class="text-3xl font-bold mb-4 flex gap-3">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <p>Lokasi Sawah Lope</p>
                </div>
                <p class="text-gray-700 mb-4 text-justify">
                    Sawah Lope berlokasi di Desa Cikaso, menghadirkan nuansa pedesaan yang asri dan kuliner khas Sunda
                    seperti nasi oncom yang menggugah selera. Cocok untuk wisata kuliner dan edukasi budaya lokal.
                </p>
                <a href="https://maps.app.goo.gl/UwryEKgk6uY1Us3z6" target="_blank"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                    <span>Buka di Google Maps</span>
                    <i class="fa-solid fa-arrow-right-long ml-3"></i>
                </a>
            </div>

            <div class="relative w-full pb-[56.25%] overflow-hidden rounded-xl shadow-md">
                <iframe class="absolute top-0 left-0 w-full h-full"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1578.0571719307322!2d108.49782447168327!3d-6.9366423400097865!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f17d25e681577%3A0xb1391080d3755886!2sSawah%20Lope%20Desa%20Cikaso!5e1!3m2!1sid!2sid!4v1746630662094!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
@endsection
