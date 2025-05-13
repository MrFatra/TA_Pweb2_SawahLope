<!-- Navbar -->
<nav class="w-full bg-white sticky w-full top-0 left-0 z-30 shadow">
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
        <ul class="hidden md:flex space-x-10 items-center text-gray-800 font-medium">
            <li>
                <a href="{{ route('landing') }}"
                    class="relative hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('menu.list') }}"
                    class="relative hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Makanan
                </a>
            </li>
            <li>
                <a href="{{ route('article.list') }}"
                    class="relative hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Artikel
                </a>
            </li>
            <li>
                <a href="{{ route('map.view') }}"
                    class="relative hover:text-green-500 after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-full after:bg-green-500 after:scale-x-0 after:origin-left hover:after:scale-x-100 after:transition-transform after:duration-500">
                    Peta Panduan
                </a>
            </li>
            @if (session('ticket_id'))
                <li class="relative group">
                    <!-- Avatar -->
                    <button class="focus:outline-none">
                        <img class="w-10 h-10 rounded-full"
                            src="https://ui-avatars.com/api/?name={{ session('full_name') }}&background=random&rounded=true"
                            alt="Avatar">
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl/30 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-200 z-50">
                        <a
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:rounded-tl-md hover:rounded-tr-md">
                            <i class="mr-2 fa-solid fa-user"></i>
                            Profile
                        </a>
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button id="logout-button" type="submit"
                                class="w-full text-left px-4 py-2 text-gray-800 hover:text-white hover:bg-red-500 hover:rounded-bl-md hover:rounded-br-md">
                                <i class="mr-2 fa-solid fa-arrow-right-from-bracket"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li>
                    <a href="{{ route('auth.login') }}"
                        class="border border-green-500 rounded-md py-3 px-5 hover:bg-green-500 hover:text-white cursor-pointer">Login</a>
                </li>
                <li>
                    <a href="{{ route('pay.buyTicket.view') }}"
                        class="bg-green-500 rounded-md py-3 px-5 hover:bg-green-700 text-white cursor-pointer">Beli
                        Tiket</a>
                </li>
            @endif
        </ul>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden hidden px-6 pb-4">
        <ul class="flex flex-col space-y-4">
            <li><a href="{{ route('landing') }}" class="hover:text-green-500">Beranda</a></li>
            <li><a href="{{ route('menu.list') }}" class="hover:text-green-500">Makanan</a></li>
            <li><a href="{{ route('article.list') }}" class="hover:text-green-500">Artikel</a></li>
            <li><a href="{{ route('map.view') }}" class="hover:text-green-500">Peta Panduan</a></li>
            <li>
                <img class=""
                    src="https://ui-avatars.com/api/?name={{ session('full_name') }}&background=random&rounded=true"
                    alt="">
            </li>
        </ul>
    </div>
</nav>

<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburgerBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    document.getElementById('logout-button').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            text: "Sesi Anda akan berakhir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, logout',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded-md mr-5 cursor-pointer',
                cancelButton: 'border border-gray-500 hover:bg-gray-500 hover:text-white px-4 py-2 rounded-md cursor-pointer'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Logging out...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch("{{ route('auth.logout') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    Swal.close();
                    if (response.ok) {
                        window.location.href = "{{ route('landing') }}";
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Logout Gagal',
                            text: 'Terjadi kesalahan saat logout. Silakan coba lagi.'
                        });
                    }
                }).catch(error => {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Logout Gagal',
                        text: 'Terjadi kesalahan saat logout. Silakan coba lagi.'
                    });
                });
            }
        });
    });
</script>
