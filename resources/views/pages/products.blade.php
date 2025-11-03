@extends('layouts.main')

@section('title', 'Produk - Optik Nasionalis Kacamata')

@section('content')
<!-- Hero Section -->
<div class="bg-[#A78B7D] py-16 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-3xl md:text-4xl text-white font-bold mb-4">
            KAMI MENYEDIAKAN SOLUSI PENGLIHATAN TERBAIK UNTUK KEBUTUHAN ANDA
        </h1>
    </div>
</div>

<!-- Category Slider -->
<div class="py-8 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="relative">
            <div class="slider-container overflow-hidden">
                <div class="slider-track flex gap-4 my-2">
                    <!-- Original Items -->
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap border-2 border-[#A78B7D] text-[#A78B7D] font-semibold flex-shrink-0">
                        Semua Produk
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Kacamata
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Optik (Fotokromik, plus, minus, progresif)
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Frame Kacamata
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Kacamata Hitam
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Aksesoris & Fashion
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Kontak
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Pembersih Kacamata
                    </button>
                    
                    <!-- Duplicate Items untuk Infinity Effect -->
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap border-2 border-[#A78B7D] text-[#A78B7D] font-semibold flex-shrink-0">
                        Semua Produk
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Kacamata
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Optik (Fotokromik, plus, minus, progresif)
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Frame Kacamata
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Kacamata Hitam
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Aksesoris & Fashion
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Lensa Kontak
                    </button>
                    <button class="px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0">
                        Pembersih Kacamata
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.slider-track {
    animation: scroll 30s linear infinite;
}

.slider-track:hover {
    animation-play-state: paused;
}

.slider-container::-webkit-scrollbar {
    display: none;
}
</style>

<!-- Services Section -->
<div class="container mx-auto px-20 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        <!-- Service 1 -->
        <a href="#" class="bg-white grid grid-cols-2 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
            <div class="p-6">
                <h3 class="font-bold text-lg mb-2">PEMERIKSAAN MATA GRATIS</h3>
                <p class="text-gray-600 text-sm mb-[70%]">Dapatkan pemeriksaan mata gratis oleh tenaga profesional kami</p>
                <div class="flex items-center text-[#A78B7D] font-semibold">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            <div class="h-full bg-gray-200 overflow-hidden">
                <img src="{{ asset('/image/about/image1.png') }}" alt="Pemeriksaan Mata Gratis" class="w-full h-full object-cover ">
            </div>
        </a>

        <!-- Service 2 -->
        <a href="#" class="bg-white grid grid-cols-2 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
            
            <div class="p-6">
                <h3 class="font-bold text-lg mb-2">KONSULTASI FRAME & LENSA</h3>
                <p class="text-gray-600 text-sm mb-[70%]">Tim ahli kami siap membantu memilih frame dan lensa yang tepat</p>
                <div class="flex items-center text-[#A78B7D] font-semibold">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            <div class="h-full bg-gray-200 overflow-hidden">
                <img src="{{ asset('/image/about/image1.png') }}" alt="Konsultasi Frame & Lensa" class="w-full h-full object-cover ">
            </div>
        </a>

        <!-- Service 3 -->
        <a href="#" class="bg-white grid grid-cols-2 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
            
            <div class="p-6">
                <h3 class="font-bold text-lg mb-2">PERBAIKAN & SERVICE</h3>
                <p class="text-gray-600 text-sm mb-[70%]">Layanan perbaikan dan perawatan kacamata Anda</p>
                <div class="flex items-center text-[#A78B7D] font-semibold">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            <div class="h-full bg-gray-200 overflow-hidden">
                <img src="{{ asset('/image/about/image1.png') }}" alt="Perbaikan & Service" class="w-full h-full object-cover ">
            </div>
        </a>

        <!-- Service 4 -->
        <a href="#" class="bg-white grid grid-cols-2 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
            
            <div class="p-6">
                <h3 class="font-bold text-lg mb-2">PESAN ONLINE & ANTAR KE RUMAH</h3>
                <p class="text-gray-600 text-sm mb-[70%]">Kemudahan pesan online dengan layanan antar</p>
                <div class="flex items-center text-[#A78B7D] font-semibold">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            <div class="h-full bg-gray-200 overflow-hidden">
                <img src="{{ asset('/image/about/image1.png') }}" alt="Pesan Online & Antar" class="w-full h-full object-cover ">
            </div>
        </a>
    </div>
</div>

<!-- Products Section -->
<div class="py-16">
    <div class="container mx-auto px-20">
        <!-- Section Title -->
        <div class="text-center mb-12">
            <button class="bg-[#A78B7D] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#8b7566] transition">
                Lihat ke produk kami
            </button>
        </div>

        <!-- Filter & Products Grid -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filter -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <!-- Frame Filter -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">Frame</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Pria</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Wanita</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Anak-anak</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Unisex</span>
                            </label>
                        </div>
                    </div>

                    <!-- Color Filter -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">Warna</h3>
                        <div class="flex flex-wrap gap-3">
                            <button class="w-8 h-8 rounded-full bg-red-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-blue-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-green-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-yellow-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-purple-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-pink-500 border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-black border-2 border-gray-300 hover:border-gray-600"></button>
                            <button class="w-8 h-8 rounded-full bg-white border-2 border-gray-300 hover:border-gray-600"></button>
                        </div>
                    </div>

                    <!-- Shape Filter -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">Bentuk</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Bulat</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Kotak</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Aviator</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Cat Eye</span>
                            </label>
                        </div>
                    </div>

                    <!-- Material Filter -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-4">Material</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Metal</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Plastik</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Titanium</span>
                            </label>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    <div>
                        <h3 class="font-bold text-lg mb-4">Brand</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Ray-Ban</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Oakley</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-[#A78B7D] rounded">
                                <span class="ml-2 text-gray-700">Prada</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort & View Options -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">Showing 1-12 of 48 Products</p>
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-[#A78B7D]">
                        <option>Sort by: Most Popular</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest</option>
                    </select>
                </div>

                <!-- Product Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Product Card 1 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product1.jpg') }}" alt="Ray-Ban Wayfarer" class="w-full h-full object-cover ">
                            <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">-20%</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Ray-Ban Wayfarer</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★★
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.5)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 800.000</span>
                                <span class="text-sm text-gray-400 line-through">Rp 1.000.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product2.jpg') }}" alt="Ray-Ban Clubmaster" class="w-full h-full object-cover ">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Ray-Ban Clubmaster</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★☆
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.0)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 750.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product3.jpg') }}" alt="Ray-Ban Aviator" class="w-full h-full object-cover ">
                            <span class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">New</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Ray-Ban Aviator</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★★
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(5.0)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 900.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product4.jpg') }}" alt="Ray-Ban Round Metal" class="w-full h-full object-cover ">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Ray-Ban Round Metal</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★☆
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.2)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 850.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 5 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product5.jpg') }}" alt="Ray-Ban RX5154" class="w-full h-full object-cover ">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Ray-Ban RX5154</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★★
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.8)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 700.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 6 -->
                    <div class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group">
                        <div class="relative h-64 bg-gray-100 overflow-hidden">
                            <img src="{{ asset('/image/products/product6.jpg') }}" alt="Hollbrook" class="w-full h-full object-cover ">
                            <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">-15%</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-1">Hollbrook</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 text-sm">
                                    ★★★★☆
                                </div>
                                <span class="text-gray-500 text-sm ml-2">(4.3)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xl font-bold text-[#A78B7D]">Rp 680.000</span>
                                <span class="text-sm text-gray-400 line-through">Rp 800.000</span>
                            </div>
                        </div>
                    </div>

                    <!-- More products... -->
                </div>

                <!-- Pagination -->
                <div class="flex justify-center items-center gap-2 mt-12">
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        ←
                    </button>
                    <button class="px-4 py-2 bg-[#A78B7D] text-white rounded-lg">1</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">...</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">10</button>
                    <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        →
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
@endsection