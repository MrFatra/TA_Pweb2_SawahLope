<section class="relative bg-gradient-to-br from-green-100 via-white to-green-200 py-30 mx-0 overflow-hidden">
    <!-- Decorative wave -->
    <div class="absolute top-0 left-0 w-full h-40 bg-white rounded-b-full -z-10"></div>

    <div class="max-w-3xl mx-auto text-center">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-green-600 leading-tight mb-6">
            Ayo tunggu apa lagi?
        </h1>
        <p class="text-lg text-gray-700 mb-8">
            Petualangan seru menantimu! Pesan tiketmu sekarang dan rasakan pengalaman tak terlupakan.
        </p>
        <a href="{{ route('pay.buyTicket.view') }}"
            class="inline-block bg-green-500 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg">
            Ambil Tiketmu Sekarang!
        </a>
    </div>

    <!-- Floating shapes for aesthetic -->
    <div class="absolute -top-10 -left-10 w-40 h-40 bg-green-300 rounded-full opacity-20 animate-pulse"></div>
    <div class="absolute -bottom-16 -right-16 w-52 h-52 bg-green-400 rounded-full opacity-10 animate-bounce"></div>
</section>
