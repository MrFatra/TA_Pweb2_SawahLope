<footer class="text-center mt-20">
    <hr class="border-t-4 border-green-500 w-4/5 mx-auto my-10">
    <div class="flex flex-col gap-10 pb-10">

        <div class="links flex flex-wrap justify-center gap-4 mb-4">
            <a href="{{ route('landing') }}"
                class="relative text-gray-800 font-medium hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">Beranda</a>
            <a href="{{ route('menu.list') }}"
                class="relative text-gray-800 font-medium hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">Makanan</a>
            <a href="{{ route('article.list') }}"
                class="relative text-gray-800 font-medium hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">Artikel</a>
            <a href="{{ route('map.view') }}"
                class="relative text-gray-800 font-medium hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">Peta</a>
        </div>

        <div class="socials flex justify-center gap-6 text-xl mb-4 text-gray-800">
            <a href="#"><i class="fa-brands fa-instagram hover:text-pink-500"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok hover:text-black"></i></a>
            <a href="#"><i class="fa-brands fa-x-twitter hover:text-black"></i></a>
            <a href="#"><i class="fa-brands fa-youtube hover:text-red-500"></i></a>
        </div>

        <div class="font-semibold text-sm text-gray-800">
            <p>SAWAH LOPE | &copy; 2025</p>
        </div>
    </div>
</footer>
