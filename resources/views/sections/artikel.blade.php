<section class="container mx-auto grid xl:grid-cols-4 gap-10 pt-10 xl:px-16 md:px-5 px-3">
    {{-- Artikel Utama --}}
    <div class="xl:col-span-3 h-[280px] md:h-[350px] xl:h-[450px] relative z-10 flex items-end rounded-xl overflow-hidden bg-cover bg-center after:content-[''] after:absolute after:inset-0 after:bg-black/40 after:-z-10 p-4 md:p-10"
        style="background-image: url('https://i.pinimg.com/736x/14/ad/31/14ad3171038b99261210a9fbe6785d41.jpg');">

        <div class="w-full max-w-3xl">
            <h6 class="text-green-500 font-semibold text-sm md:text-base mb-1 md:mb-3">
                {{ $articles[0]->category }}
            </h6>
            <a href="detail.html">
                <h2 class="text-white font-bold text-xl md:text-2xl xl:text-3xl leading-snug">
                    {{ $articles[0]->title }}
                </h2>
            </a>
            <p class="text-gray-200 mt-3 text-sm leading-relaxed hidden xl:block">
                {{ $articles[0]->description }}
            </p>
        </div>
    </div>

    {{-- Video Samping (Hanya tampil di XL) --}}
    <div class="hidden xl:block">
        <div class="w-full h-full max-w-[245px] mx-auto">
            <video class="w-full h-full rounded-lg shadow-lg object-cover" autoplay muted loop>
                <source src="https://v1.pinimg.com/videos/mc/720p/5f/fb/b3/5ffbb3be23d853129a1bd0597c45e41b.mp4"
                    type="video/mp4" />
            </video>
        </div>
    </div>
</section>

<section class="container mx-auto mt-10 xl:px-20 md:px-10 px-3">
    <hr class="my-10 border-green-500" />
    <div class="grid xl:grid-cols-4 gap-10 mt-10">
        <div class="xl:col-span-3 md:w-auto w-[95%]">
            @foreach ($articles->slice(1) as $article)
                <div class="md:grid md:grid-cols-5 items-center xl:gap-10 md:gap-5 md:mb-5 mb-16">
                    <div class="md:col-span-2">
                        <img src="{{ Storage::url($article->image) }}"
                            class="w-full h-[250px] rounded-xl object-cover" />
                    </div>
                    <div class="md:col-span-3 md:mt-0 mt-3">
                        <p class="text-green-500 font-semibold">{{ $article->category }}</p>

                        <a href="{{ route('article.view', $article->slug) }}">
                            <h3 class="text-xl font-bold mb-3 text-gray-900 ">
                                {{ $article->title }}
                            </h3>
                        </a>
                        <p class="text-gray-800 xl:text-base text-justify md:text-sm text-[12px]">
                            {{ $article->description }}
                        </p>

                        <div class="mt-5 lg:flex gap-10">
                            <p class="flex gap-2 text-sm text-gray-800 items-center">
                                <i class="fa-regular fa-calendar"></i>
                                <span>{{ $article->created_at->isoFormat('dddd, D MMMM Y') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!--Pagination-->
    <div class="flex justify-center mt-10 mb-10">
        <ul class="inline-flex items-center gap-2 -space-x-px text-sm">
            {{-- Tombol "Sebelumnya" --}}
            <li>
                <a href="{{ $articles->onFirstPage() ? '#' : $articles->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight rounded-l-md
                    {{ $articles->onFirstPage() ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-gray-200 text-gray-900 hover:bg-green-700 hover:text-white' }}">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </li>

            {{-- Nomor Halaman --}}
            @for ($i = 1; $i <= $articles->lastPage(); $i++)
                <li>
                    <a href="{{ $articles->url($i) }}"
                        class="flex items-center justify-center px-3 h-8 rounded-md
                        {{ $i == $articles->currentPage() ? 'text-white bg-green-500' : 'bg-gray-200 text-gray-900 hover:bg-green-700 hover:text-white' }}">
                        {{ $i }}
                    </a>
                </li>
            @endfor

            {{-- Tombol "Berikutnya" --}}
            <li>
                <a href="{{ $articles->hasMorePages() ? $articles->nextPageUrl() : '#' }}"
                    class="flex items-center justify-center px-3 h-8 leading-tight rounded-r-md
                    {{ $articles->hasMorePages() ? 'bg-gray-200 text-gray-900 hover:bg-green-700 hover:text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>

</section>
