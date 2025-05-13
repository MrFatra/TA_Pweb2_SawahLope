<section class="px-4 lg:px-16 mt-10">
  <h1 class="lg:text-4xl font-semibold text-green-500 mb-5">
    🌿 Sekilas Artikel
  </h1>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
    <!-- Hero Artikel -->
    <div class="relative h-[320px] md:h-[480px] rounded-3xl overflow-hidden group shadow-lg">
      <img src="https://assets.promediateknologi.id/crop/0x182:2048x1509/750x500/webp/photo/2023/01/10/24757301.jpg"
        alt="Sawah Lope"
        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
      <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>
      <div class="absolute inset-0 flex flex-col justify-end px-6 md:px-10 pb-8 text-white">
        <a href="#" class="block">
          <h2 class="text-2xl md:text-4xl font-bold leading-snug drop-shadow-lg">
            Sawah Lope: Rekomendasi Wisata Alam di Jawa Barat
          </h2>
          <p class="text-green-300 font-semibold mt-3 hover:underline">
            Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
          </p>
        </a>
      </div>
    </div>

    <!-- Artikel Lain -->
    <div class="flex flex-col gap-6">
      <!-- Card Artikel -->
      @foreach ([1,2,3] as $index)
      <div class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition duration-300">
        <img src="https://i.gojekapi.com/darkroom/gofood-indonesia/v2/images/uploads/0896b65a-6d1e-4583-b60c-573359528121_Go-Biz_20220218_132132.jpeg"
          alt="Artikel"
          class="w-24 h-24 md:w-32 md:h-28 object-cover rounded-lg">
        <div class="flex-1">
          <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-2">
            Eksplorasi Alam dan Rasa: Menyatu dengan Sawah Lope
          </h3>
          <a href="#" class="text-green-500 font-medium hover:underline text-sm">
            Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-1"></i>
          </a>
        </div>
      </div>
      @endforeach

      <!-- CTA Button -->
      <div class="pt-4 text-center">
        <a href="{{ route('article.list') }}"
          class="inline-flex gap-3 items-center justify-center text-green-500 border border-green-500 hover:text-white px-6 py-3 rounded-full text-sm md:text-base font-semibold shadow-md hover:bg-green-500 transition duration-300">
          Telusuri Semua Artikel
          <i class="fa-solid fa-search"></i>
        </a>
      </div>
    </div>
  </div>
</section>
