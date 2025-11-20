@extends('layouts.main')

@section('title', 'Produk - Optik Nasionalis Kacamata')

@section('content')
<style>
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
.slider-track { 
    animation: scroll 30s linear infinite;
    transition: none; /* Penting: hilangkan transition */
}
.slider-track:hover { animation-play-state: paused; }
.slider-container::-webkit-scrollbar { display: none; }

  @font-face {
    font-family: 'CustomFont';
    src: url('/fonts/Bebaskai.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }

  .custom-font {
    font-family: 'CustomFont', sans-serif;
    letter-spacing: 0.05em;
  }

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
<!-- Hero Section -->
<div class="bg-[#70574D] py-8 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-3xl md:text-4xl text-white custom-font">
            KAMI MENYEDIAKAN SOLUSI PENGLIHATAN TERBAIK UNTUK KEBUTUHAN ANDA
        </h1>
    </div>
</div>

<!-- Category Slider -->
<div class="overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="relative">
            <div class="slider-container overflow-hidden">
                <div class="slider-track flex gap-4 my-6">

                    
                    @foreach($categories as $category)
                        <button data-category="{{ $category->id }}" class="category-filter px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0 mona-sans text-sm">
                            {{ $category->name }}
                        </button>
                    @endforeach
                    
                    @foreach($categories as $category)
                        <button data-category="{{ $category->id }}" class="category-filter px-6 py-3 bg-white rounded-full shadow hover:shadow-lg transition whitespace-nowrap hover:border-[#A78B7D] border-2 border-transparent flex-shrink-0 mona-sans text-sm">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Services Section -->
<div class="max-w-7xl mx-auto px-20 py-10 ">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        @foreach($services as $service)
        <a href="{{ $service->link ?? '#' }}" class="bg-white grid grid-cols-2 h-64 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition group">
            <div class="p-6 flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl mb-2 custom-font">{{ strtoupper($service->title) }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mona-sans">{{ $service->description }}</p>
                </div>
                <div class="flex items-center text-[#A78B7D] font-semibold mona-sans">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 mt-1 ml-2 group-hover:translate-x-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </div>
            <div class="h-full bg-gray-200 overflow-hidden">
                @if($service->image_path)
                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('/image/about/image1.png') }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                @endif
            </div>
        </a>
        @endforeach
    </div>
</div>

<!-- Products Section -->
<div class="py-16">
    <div class="container mx-auto px-20">
        <!-- Section Title -->
        <div class="text-center mb-12">
            <button class="bg-[#70574D] text-white px-8 py-3 rounded-full font-semibold hover:bg-[#8b7566] transition mona-sans">
                Lihat Produk Kami
            </button>
        </div>

        <!-- Filter & Products Grid -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filter -->
            <div class="w-full lg:w-64 flex-shrink-0 mona-sans">
                <div class="bg-white rounded-lg shadow p-6 sticky top-4">
                    <form id="filterForm">
                        <!-- Gender Filter -->
                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-4">Gender</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="gender[]" value="pria" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Pria</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="gender[]" value="wanita" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Wanita</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="gender[]" value="anak" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Anak-anak</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="gender[]" value="unisex" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Unisex</span>
                                </label>
                            </div>
                        </div>

                        <!-- Shape Filter -->
                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-4">Bentuk</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="shape[]" value="Bulat" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Bulat</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="shape[]" value="Kotak" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Kotak</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="shape[]" value="Aviator" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Aviator</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="shape[]" value="Cat Eye" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Cat Eye</span>
                                </label>
                            </div>
                        </div>

                        <!-- Material Filter -->
                        <div class="mb-6">
                            <h3 class="font-bold text-lg mb-4">Material</h3>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="material[]" value="Metal" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Metal</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="material[]" value="Plastik" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Plastik</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="material[]" value="Titanium" class="filter-checkbox w-4 h-4 text-[#A78B7D] rounded">
                                    <span class="ml-2 text-gray-700 text-sm">Titanium</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1">
                <!-- Sort & View Options -->
                <div class="flex justify-between items-center mb-6 mona-sans">
                    <p class="text-gray-600" id="productCount">Menampilkan {{ $products->total() }} Produk</p>
                    <select id="sortSelect" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-[#A78B7D]">
                        <option value="popular">Paling Populer</option>
                        <option value="price_low">Harga: Rendah ke Tinggi</option>
                        <option value="price_high">Harga: Tinggi ke Rendah</option>
                        <option value="newest">Terbaru</option>
                    </select>
                </div>

                <!-- Loading Indicator -->
                <div id="loading" class="hidden text-center py-8 mona-sans">
                    <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#A78B7D]"></div>
                    <p class="text-gray-600 mt-2">Memuat produk...</p>
                </div>

                <!-- Product Cards -->
                <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mona-sans">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <!-- No Products -->
                <div id="noProducts" class="hidden text-center py-12 mona-sans">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Produk Tidak Ditemukan</h3>
                    <p class="text-gray-500">Coba ubah filter pencarian Anda</p>
                </div>

                <!-- Pagination -->
                <div id="paginationContainer" class="flex justify-center items-center gap-2 mt-12 mona-sans">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let currentCategory = '';
    let currentPage = 1;

    // Category filter
    $('.category-filter').on('click', function() {
        $('.category-filter').removeClass('border-[#A78B7D] text-[#A78B7D] font-semibold').addClass('border-transparent');
        $(this).removeClass('border-transparent').addClass('border-[#A78B7D] text-[#A78B7D] font-semibold');
        
        currentCategory = $(this).data('category');
        currentPage = 1;
        loadProducts();
    });

    // Checkbox filters
    $('.filter-checkbox').on('change', function() {
        currentPage = 1;
        loadProducts();
    });

    // Sort select
    $('#sortSelect').on('change', function() {
        currentPage = 1;
        loadProducts();
    });

    function loadProducts() {
        const formData = {
            category: currentCategory,
            sort: $('#sortSelect').val(),
            gender: $('input[name="gender[]"]:checked').map(function() { return $(this).val(); }).get(),
            shape: $('input[name="shape[]"]:checked').map(function() { return $(this).val(); }).get(),
            material: $('input[name="material[]"]:checked').map(function() { return $(this).val(); }).get(),
            page: currentPage
        };

        $('#loading').removeClass('hidden');
        $('#productGrid').addClass('opacity-50');

        $.ajax({
            url: '{{ route("products.index") }}',
            method: 'GET',
            data: formData,
            success: function(response) {
                $('#loading').addClass('hidden');
                $('#productGrid').removeClass('opacity-50');

                if (response.products.length > 0) {
                    $('#noProducts').addClass('hidden');
                    $('#productGrid').removeClass('hidden');
                    
                    let html = '';
                    response.products.forEach(product => {
                        html += generateProductCard(product);
                    });
                    $('#productGrid').html(html);

                    $('#productCount').text(`Menampilkan ${response.pagination.total} Produk`);
                    generatePagination(response.pagination);
                } else {
                    $('#productGrid').addClass('hidden');
                    $('#noProducts').removeClass('hidden');
                    $('#paginationContainer').html('');
                }
            },
            error: function() {
                $('#loading').addClass('hidden');
                $('#productGrid').removeClass('opacity-50');
                alert('Terjadi kesalahan saat memuat produk');
            }
        });
    }

    function generateProductCard(product) {
        const imageUrl = product.primary_image ? `/storage/${product.primary_image.image_path}` : '/image/products/default.jpg';
        const discountBadge = product.discount_percentage > 0 ? `<span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">-${product.discount_percentage}%</span>` : '';
        const newBadge = product.is_new ? '<span class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">New</span>' : '';
        const priceDisplay = product.discount_price ? 
            `<span class="text-xl font-bold text-[#A78B7D]">Rp ${formatPrice(product.discount_price)}</span>
             <span class="text-sm text-gray-400 line-through">Rp ${formatPrice(product.price)}</span>` :
            `<span class="text-xl font-bold text-[#A78B7D]">Rp ${formatPrice(product.price)}</span>`;

        return `
            <a href="/produk/${product.slug}" class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group block">
                <div class="relative h-64 bg-gray-100 overflow-hidden">
                    <img src="${imageUrl}" alt="${product.name}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    ${discountBadge || newBadge}
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1">${product.name}</h3>
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400 text-sm">
                            ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5 - Math.floor(product.rating))}
                        </div>
                        <span class="text-gray-500 text-sm ml-2">(${product.rating})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        ${priceDisplay}
                    </div>
                </div>
            </a>
        `;
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('id-ID').format(price);
    }

    function generatePagination(pagination) {
        if (pagination.last_page <= 1) {
            $('#paginationContainer').html('');
            return;
        }

        let html = '';
        
        // Previous button
        if (pagination.current_page > 1) {
            html += `<button onclick="changePage(${pagination.current_page - 1})" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">←</button>`;
        }

        // Page numbers
        for (let i = 1; i <= pagination.last_page; i++) {
            if (i === pagination.current_page) {
                html += `<button class="px-4 py-2 bg-[#A78B7D] text-white rounded-lg">${i}</button>`;
            } else if (i === 1 || i === pagination.last_page || (i >= pagination.current_page - 1 && i <= pagination.current_page + 1)) {
                html += `<button onclick="changePage(${i})" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">${i}</button>`;
            } else if (i === pagination.current_page - 2 || i === pagination.current_page + 2) {
                html += `<button class="px-4 py-2 border border-gray-300 rounded-lg">...</button>`;
            }
        }

        // Next button
        if (pagination.current_page < pagination.last_page) {
            html += `<button onclick="changePage(${pagination.current_page + 1})" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">→</button>`;
        }

        $('#paginationContainer').html(html);
    }

    window.changePage = function(page) {
        currentPage = page;
        loadProducts();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
});
</script>
@endpush