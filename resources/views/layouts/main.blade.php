<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Optik Nasionalis Kacamata')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
    @font-face {
    font-family: 'Mona';
    src: url('{{ asset("fonts/mona-sans.ttf") }}') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
    }

    .mona-sans {
        font-family: 'Mona', sans-serif;
        letter-spacing: 0.05em;
    }

    /* Navbar scroll animation */
    nav {
        transition: transform 0.3s ease-in-out;
    }

    nav.nav-hidden {
        transform: translateY(-100%);
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav id="navbar" class="bg-white shadow-md mona-sans fixed top-0 left-0 right-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex items-center justify-between gap-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <img src="{{ asset('image/logo/nasionalisoptik.png') }}" alt="Logo Optik" class="w-[70px] h-[35px] object-contain">
            </a>

            <!-- Desktop Menu Links -->
            <ul class="hidden md:flex justify-center list-none gap-8 flex-1 mb-0">
                <li><a href="{{ route('home') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Beranda</a></li>
                <li><a href="{{ route('about') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Tentang Toko</a></li>
                <li><a href="{{ route('products.index') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Produk Layanan</a></li>
                <li><a href="{{ route('contact') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Kontak</a></li>
            </ul>
            
            <!-- Desktop Auth Buttons -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('cart.index') }}" class="relative text-[#70574D] hover:opacity-70 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(Auth::user()->cart && Auth::user()->cart->total_items > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ Auth::user()->cart->total_items }}
                            </span>
                        @endif
                    </a>
                                    
                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 text-[#70574D] font-medium hover:opacity-70 transition focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white shadow-lg border border-gray-200 z-50 py-1">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-[#70574D] hover:bg-gray-100 transition no-underline">Profile</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-[#70574D] hover:bg-gray-100 transition no-underline">Pesanan Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-[#70574D] hover:bg-gray-100 transition">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 text-[#70574D] font-medium border border-[#70574D] hover:bg-[#70574D] hover:text-white transition no-underline">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-[#70574D] text-white font-medium hover:opacity-90 transition no-underline">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Buttons (Cart + Hamburger) -->
            <div class="flex items-center gap-4 md:hidden">
                @auth
                    <a href="{{ route('cart.index') }}" class="relative text-[#70574D] hover:opacity-70 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(Auth::user()->cart && Auth::user()->cart->total_items > 0)
                            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ Auth::user()->cart->total_items }}
                            </span>
                        @endif
                    </a>
                @endauth
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-[#70574D] focus:outline-none focus:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-4" 
             x-transition:enter-end="opacity-100 translate-y-0" 
             x-transition:leave="transition ease-in duration-150" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-4" 
             x-cloak 
             class="md:hidden border-t border-gray-200 bg-white px-4 py-4 space-y-3 shadow-inner">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Beranda</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Tentang Toko</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Produk & Layanan</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Kontak</a>
            
            <hr class="border-gray-200 my-2">
            
            <div class="px-3 py-2">
                @auth
                    <p class="text-xs text-gray-500 mb-2">Masuk sebagai: <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span></p>
                    <a href="{{ route('profile.index') }}" class="block py-2 text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Profile</a>
                    <a href="{{ route('orders.index') }}" class="block py-2 text-[#70574D] font-medium hover:bg-gray-50 no-underline transition">Pesanan Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 text-[#70574D] font-medium hover:bg-gray-50 transition">Logout</button>
                    </form>
                @else
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="w-full text-center py-2 text-[#70574D] font-medium border border-[#70574D] hover:bg-[#70574D] hover:text-white transition no-underline">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="w-full text-center py-2 bg-[#70574D] text-white font-medium hover:opacity-90 transition no-underline">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Spacer for fixed navbar -->
    <div class="h-[71px] md:h-[73px]"></div>

    <!-- Main Content -->
    <main class="flex-1 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#70574D] text-white pt-12 px-8 pb-4 mt-auto mona-sans">
        <div class="max-w-7xl mx-auto grid grid-cols-[2fr_1fr_1fr] gap-12 mb-8">
            <div>
                <h3 class="mb-4 text-lg"><strong>Optik Nasionalis Kacamata</strong></h3> 
                <p class="text-[14px]">Optik terpercaya yang telah melayani masyarakat selama bertahun-tahun dengan mengutamakan kualitas dan layanan yang ramah.</p>
            </div>
            
            <div>
                <h3 class="mb-4 text-lg"><strong>Menu</strong></h3>
                <ul class="list-none text-[14px]">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white no-underline hover:opacity-80 transition">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white no-underline hover:opacity-80 transition">Tentang Toko</a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}" class="text-white no-underline hover:opacity-80 transition">Produk Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-white no-underline hover:opacity-80 transition">Kontak</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="mb-4 text-lg"><strong>Kontak</strong></h3>
                <p class="mb-2 leading-relaxed text-[14px]">Jl. Panglima Sudirman 206A<br>(Depan Bank Syariah Indonesia)<br>Turen, Malang</p>
                <p class="mb-2 leading-relaxed text-[14px]">+62 813 3129 6965</p>
                <p class="mb-2 leading-relaxed text-[14px]">Senin - Minggu: 08:00 - 19:00</p>
            </div>
        </div>
        
        <div class="text-center pt-8 border-t border-white/30 text-[14px]">
            <p>© 2025 Optik Nasionalis Kacamata. Semua hak dilindungi.</p>
        </div>
    </footer>

    <!-- Navbar Scroll Script -->
    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById('navbar');
        const scrollThreshold = 10; // Minimum scroll untuk trigger hide/show

        window.addEventListener('scroll', function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Jangan hide navbar jika masih di paling atas
            if (scrollTop <= scrollThreshold) {
                navbar.classList.remove('nav-hidden');
                return;
            }
            
            // Scroll ke bawah - hide navbar
            if (scrollTop > lastScrollTop) {
                navbar.classList.add('nav-hidden');
            } 
            // Scroll ke atas - show navbar
            else {
                navbar.classList.remove('nav-hidden');
            }
            
            lastScrollTop = scrollTop;
        });
    </script>

    <!-- Toast Notifications -->
    @if(session('success') || session('error'))
        <div id="toast" class="fixed top-4 right-4 z-50 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100">
            @if(session('success'))
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 min-w-[300px]">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                    <button onclick="closeToast()" class="ml-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 min-w-[300px]">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium">{{ session('error') }}</p>
                    <button onclick="closeToast()" class="ml-auto">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <script>
            // Slide in animation
            window.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.classList.add('-translate-x-[400px]', 'opacity-0');
                    setTimeout(() => {
                        toast.classList.remove('-translate-x-[400px]', 'opacity-0');
                    }, 100);
                }
            });

            // Auto hide toast after 5 seconds
            setTimeout(function() {
                closeToast();
            }, 3000);

            function closeToast() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.classList.add('translate-x-[400px]', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }
        </script>
    @endif

    @include('components.chatbot')

    @yield('scripts')
</body>
</html>