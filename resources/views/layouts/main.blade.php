<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Optik Nasionalis Kacamata')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css'])
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-8 py-4 flex items-center gap-8">
            <img src="/image/logo/nasionalisoptik.png" alt="Logo Optik" class="w-[70px] h-[35px]">
            <ul class="flex justify-center list-none gap-8 flex-1">
                <li><a href="{{ route('home') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Beranda</a></li>
                <li><a href="{{ route('about') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Tentang Toko</a></li>
                <li><a href="{{ route('products') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Produk Layanan</a></li>
                <li><a href="{{ route('contact') }}" class="text-[#70574D] font-medium no-underline hover:opacity-70 transition">Kontak</a></li>
            </ul>
            <div class="flex">
                <input type="text" placeholder="Cari..." class="px-4 py-1 border border-[#70574D] rounded-l-xl outline-none">
                <button type="submit" class="px-4 py-1 bg-[#70574D] text-white border-none rounded-r-xl cursor-pointer hover:opacity-90 transition">Cari</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#70574D] text-white pt-12 px-8 pb-4 mt-auto">
        <div class="max-w-7xl mx-auto grid grid-cols-[2fr_1fr_1fr] gap-12 mb-8">
            <div>
                <h3 class="mb-4 text-xl">Optik Nasionalis Kacamata</h3>
                <p>Optik terpercaya yang telah melayani masyarakat selama bertahun-tahun dengan mengutamakan kualitas dan layanan yang ramah.</p>
            </div>
            
            <div>
                <h3 class="mb-4 text-xl">Menu</h3>
                <ul class="list-none">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-white no-underline hover:opacity-80 transition">Beranda</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-white no-underline hover:opacity-80 transition">Tentang Toko</a></li>
                    <li class="mb-2"><a href="{{ route('products') }}" class="text-white no-underline hover:opacity-80 transition">Produk Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-white no-underline hover:opacity-80 transition">Kontak</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="mb-4 text-xl">Kontak</h3>
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