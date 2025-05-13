@extends('layouts.app')

@section('content')
    <section class="container mx-auto pt-32 xl:px-20 md:px-5 px-3 grid xl:grid-cols-4 gap-10">
        <!-- Konten Kiri (Artikel) -->
        <div class="xl:col-span-3">
            <h6 class="text-green-500 font-semibold text-sm md:text-base mb-1 md:mb-3">
                {{ $article->category }}
            </h6>
            <h3 class="text-3xl font-bold mb-3">
                {{ $article->title }}
            </h3>

            <p class="font-semibold">Dipublikasikan Oleh: <span
                    class="text-green-500 font-semibold">{{ $article->user->name }}</span></p>
            <div class="mt-5 flex gap-10 font-medium text-sm text-gray-500">
                <p class="flex gap-2 pb-5 items-center">
                    <i class="fa-regular fa-calendar"></i>
                    <span>10 Juni 2025</span>
                </p>
            </div>

            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                class="w-full h-auto object-cover rounded mb-6">

            <article class="prose max-w-none text-justify">
                {{ $article->description }}
            </article>
        </div>

        <!-- Konten Kanan (Sidebar Sticky) -->
        <div class="hidden xl:block sticky top-32 self-start">
            <div
                class="xl:h-[250px]  h-[230px] after:rounded relative after:content-[''] after:bg-black/20 after:absolute after:inset-0">
                <img src="https://assets.promediateknologi.id/crop/0x182:2048x1509/750x500/webp/photo/2023/01/10/24757301.jpg"
                    class="w-full xl:h-[250px] h-[230px] rounded-xl object-cover" />
            </div>
            <div>
                @foreach ($suggestedArticles as $article)
                    <div class="xl:my-5 my-3">
                        <p class="text-green-500 font-semibold">{{ $article->category }}</p>
                        <a href="{{ route('article.view', $article->slug) }}">
                            <h5 class="font-semibold xl:text-xl text-base text-gray-900">
                                {{ $article->title }}
                            </h5>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
