@extends('layouts.app')

@section('content')
<section class="container mx-auto pt-32 xl:px-20 md:px-5 px-3 grid xl:grid-cols-4 gap-10">
    <!-- Konten Kiri (Artikel) -->
    <div class="xl:col-span-3">
        <h3 class="text-3xl font-bold mb-3 text-gray-900 dark:text-gray-200">
            Papalidan: Serunya Mengarungi Sungai dengan Ban Bekas, Pengalaman Tak Terlupakan
        </h3>

        <h2 class="text-green-500 font-semibold text-xl">Sawah Lope</h2>
        <div class="mt-5 flex gap-10">
            <p class="flex gap-2 text-lg pb-5 text-gray-800 dark:text-gray-400 items-center">
                <i class="fa-regular fa-calendar"></i>
                <span>10 Juni 2025</span>
            </p>
        </div>

        <img src="https://kuninganreligi.com/wp-content/uploads/1743570636777-1.jpg" alt="" class="w-full h-auto object-cover rounded mb-6">

        <article class="prose dark:prose-invert max-w-none text-justify">
            <p class="py-6">Papalidan merupakan salah satu kegiatan tradisional masyarakat yang tinggal di sekitar aliran sungai di daerah Sawah Lope, Kuningan. Aktivitas ini dilakukan dengan cara mengarungi sungai menggunakan ban dalam bekas mobil atau truk. Meski sederhana, sensasi yang dihadirkan sungguh luar biasa dan menjadi pengalaman yang tak terlupakan bagi para pesertanya.</p>

            <p class="pb-6">Peserta akan menyusuri sungai dengan arus yang cukup deras, melewati bebatuan dan pemandangan alam yang masih asri. Di sepanjang perjalanan, suara gemericik air sungai dan semilir angin membuat suasana menjadi sangat menyenangkan dan menenangkan. Papalidan bukan hanya aktivitas seru, tapi juga menjadi cara masyarakat menjaga dan mengenalkan sungai sebagai bagian dari budaya lokal.</p>

            <p class="pb-6">Biasanya, papalidan dilakukan bersama-sama, baik oleh anak-anak, remaja, hingga orang dewasa. Hal ini mempererat kebersamaan dan menjadi sarana hiburan murah meriah di tengah kehidupan pedesaan. Bahkan, beberapa pengunjung dari luar kota sengaja datang ke Kuningan hanya untuk mencoba aktivitas seru ini.</p>
        </article>
    </div>

    <!-- Konten Kanan (Sidebar Sticky) -->
    <div class="hidden xl:block sticky top-32 self-start">
        <div
            class="xl:h-[250px]  h-[230px] after:rounded relative after:content-[''] after:bg-black/20 after:absolute after:inset-0">
            <img
                src="https://assets.promediateknologi.id/crop/0x182:2048x1509/750x500/webp/photo/2023/01/10/24757301.jpg"

                class="w-full xl:h-[250px] h-[230px] rounded-xl object-cover" />
        </div>
        <div>
            <div class="xl:my-5 my-3">
                <p class="text-green-500 font-semibold">Alam</p>
                <a href="detail.html">
                    <h5
                        class="font-semibold xl:text-2xl text-base text-gray-900 dark:text-gray-200">
                        Yuk Wisata Murah ke Sawah Lope Kuningan
                    </h5>
                </a>
            </div>
            <div class="xl:my-5 my-3">
                <p class="text-green-500 font-semibold">FUN EVENT</p>
                <a href="detail.html">
                    <h5
                        class="font-semibold xl:text-2xl tex-base text-gray-900 dark:text-gray-200">
                        Hiburan Rakyat Music Dangdut
                    </h5>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection