<!-- Navbar -->
<nav class="bg-white fixed w-full top-0 left-0 z-30 shadow">
    <div class="flex justify-between items-center px-10 py-5">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Sawah Lope" class="w-10 h-auto" />
            <h2 class="text-green-500 font-semibold text-xl">Sawah Lope</h2>
        </div>

        <!-- Hamburger (mobile) -->
        <div class="md:hidden">
            <button id="hamburgerBtn" class="text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Menu Desktop -->
        <ul class="hidden md:flex space-x-10 items-center">
            <li>
                <a href="/" class="relative text-[#111] hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Beranda
                </a>
            </li>
            <li>
                <a href="#" class="relative text-[#111] hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Makanan
                </a>
            </li>
            <li>
                <a href="#" class="relative text-[#111] hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Reservasi
                </a>
            </li>
            <li>
                <a href="/artikel" class="relative text-[#111] hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Artikel
                </a>
            </li>
            <li>
                <a href="#" class="relative text-[#111] hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Peta Panduan
                </a>
            </li>
        </ul>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden hidden px-6 pb-4">
        <ul class="flex flex-col space-y-4">
            <li><a href="/" class="text-[#111] hover:text-green-500">Beranda</a></li>
            <li><a href="#" class="text-[#111] hover:text-green-500">Makanan</a></li>
            <li><a href="#" class="text-[#111] hover:text-green-500">Reservasi</a></li>
            <li><a href="/artikel" class="text-[#111] hover:text-green-500">Artikel</a></li>
            <li><a href="#" class="text-[#111] hover:text-green-500">Peta Panduan</a></li>
        </ul>
    </div>
</nav>
<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>