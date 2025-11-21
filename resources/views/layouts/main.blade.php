<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Optik Nasionalis Kacamata')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
    <style>
    @font-face {
    font-family: 'Mona';
    src: url('/fonts/mona-sans.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
    }

    .mona-sans {
        font-family: 'Mona', sans-serif;
        letter-spacing: 0.05em;
    }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md mona-sans">
        <div class="max-w-7xl mx-auto px-8 py-4 flex items-center gap-8">
            <img src="/image/logo/nasionalisoptik.png" alt="Logo Optik" class="w-[70px] h-[35px]">
            <ul class="flex justify-center list-none gap-8 flex-1">
                <li><a href="{{ route('home') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Beranda</a></li>
                <li><a href="{{ route('about') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Tentang Toko</a></li>
                <li><a href="{{ route('products.index') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Produk Layanan</a></li>
                <li><a href="{{ route('contact') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Kontak</a></li>
            </ul>
            
            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
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
                        <button @click="open = !open" class="flex items-center gap-2 text-[#70574D] font-medium hover:opacity-70 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 mt-2 w-48 bg-white shadow-lg border border-gray-200 z-50">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-[#70574D] hover:bg-gray-100 transition">Profile</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-[#70574D] hover:bg-gray-100 transition">Pesanan Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-[#70574D] hover:bg-gray-100 transition">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 text-[#70574D] font-medium border border-[#70574D] hover:bg-[#70574D] hover:text-white transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-[#70574D] text-white font-medium hover:opacity-90 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#70574D] text-white pt-12 px-8 pb-4 mt-auto mona-sans">
        <div class="max-w-7xl mx-auto grid grid-cols-[2fr_1fr_1fr] gap-12 mb-8">
            <div>
                <h3 class="mb-4 text-xl"><strong>Optik Nasionalis Kacamata</strong></h3> 
                <p>Optik terpercaya yang telah melayani masyarakat selama bertahun-tahun dengan mengutamakan kualitas dan layanan yang ramah.</p>
            </div>
            
            <div>
                <h3 class="mb-4 text-xl"><strong>Menu</strong></h3>
                <ul class="list-none">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white no-underline hover:opacity-80 transition">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white no-underline hover:opacity-80 transition">Tentang Toko</a></li>
                    <li class="mb-2"><a href="{{ route('products.index') }}" class="text-white no-underline hover:opacity-80 transition">Produk Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-white no-underline hover:opacity-80 transition">Kontak</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="mb-4 text-xl"><strong>Kontak</strong></h3>
                <p class="mb-2 leading-relaxed">Jl. Panglima Sudirman 206A<br>(Depan Bank Syariah Indonesia)<br>Turen, Malang</p>
                <p class="mb-2 leading-relaxed">+62 813 3129 6965</p>
                <p class="mb-2 leading-relaxed">Senin - Minggu: 08:00 - 19:00</p>
            </div>
        </div>
        
        <div class="text-center pt-8 border-t border-white/30">
            <p>© 2025 Optik Nasionalis Kacamata. Semua hak dilindungi.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>