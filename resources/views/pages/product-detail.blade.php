@extends('layouts.main')

@section('title', $product->name . ' - Optik Nasionalis')

@section('content')
<!-- Breadcrumb -->
<div class="bg-[#70574D] py-4">
    <div class="container mx-auto px-20">
        <div class="flex items-center text-sm text-white">
            <a href="{{ route('home') }}" class="hover:text-gray-200">Beranda</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <a href="{{ route('products.index') }}" class="hover:text-gray-200">Produk</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-white font-semibold">{{ $product->name }}</span>
        </div>
    </div>
</div>

<!-- Product Detail -->
<div class="container mx-auto px-5 sm:px-20 py-3 sm:py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- Product Images -->
        <div>
            <!-- Main Image -->
            <div class="bg-gray-100 rounded-lg overflow-hidden mb-4" style="height: 500px;">
                @if($product->images->count() > 0)
                    <img id="mainImage" src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Thumbnail Images -->
            @if($product->images->count() > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                        <button onclick="changeImage('{{ asset('storage/' . $image->image_path) }}')" class="bg-gray-100 rounded-lg overflow-hidden hover:ring-2 ring-[#A78B7D] transition" style="height: 100px;">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div>
            <div class="mb-4">
                @if($product->is_new)
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold mr-2">New</span>
                @endif
                @if($product->is_featured)
                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Featured</span>
                @endif
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
            
            @if($product->brand)
                <p class="text-gray-600 mb-4">Brand: <span class="font-semibold">{{ $product->brand }}</span></p>
            @endif

            <div class="flex items-center mb-6">
                <div class="flex text-yellow-400 text-xl">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($product->rating))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <span class="text-gray-600 ml-3">{{ number_format($product->rating, 1) }} ({{ $product->review_count }} ulasan)</span>
            </div>

            <div class="mb-8">
                @if($product->discount_price)
                    <div class="flex items-baseline gap-3 mb-2">
                        <span class="text-4xl font-bold text-[#A78B7D]">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                        <span class="text-2xl text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">-{{ $product->discount_percentage }}%</span>
                    </div>
                    <p class="text-sm text-gray-600">Hemat: Rp {{ number_format($product->price - $product->discount_price, 0, ',', '.') }}</p>
                @else
                    <span class="text-4xl font-bold text-[#A78B7D]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                @endif
            </div>

            <!-- Stock Status -->
            <div class="mb-8">
                @if($product->stock > 0)
                    <div class="flex items-center text-green-600">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">Stok Tersedia ({{ $product->stock }} unit)</span>
                    </div>
                @else
                    <div class="flex items-center text-red-600">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold">Stok Habis</span>
                    </div>
                @endif
            </div>

            <!-- Specifications -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="font-bold text-lg mb-4">Spesifikasi</h3>
                <div class="space-y-3">
                    <div class="flex">
                        <span class="text-gray-600 w-32">Kategori:</span>
                        <span class="font-semibold">{{ $product->category->name }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-gray-600 w-32">Gender:</span>
                        <span class="font-semibold capitalize">{{ $product->gender }}</span>
                    </div>
                    @if($product->color)
                        <div class="flex">
                            <span class="text-gray-600 w-32">Warna:</span>
                            <span class="font-semibold">{{ $product->color }}</span>
                        </div>
                    @endif
                    @if($product->shape)
                        <div class="flex">
                            <span class="text-gray-600 w-32">Bentuk:</span>
                            <span class="font-semibold">{{ $product->shape }}</span>
                        </div>
                    @endif
                    @if($product->material)
                        <div class="flex">
                            <span class="text-gray-600 w-32">Material:</span>
                            <span class="font-semibold">{{ $product->material }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Description -->
            @if($product->description)
                <div class="mb-8">
                    <h3 class="font-bold text-lg mb-3">Deskripsi Produk</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif

            <!-- CTA Buttons -->
            <div class="flex gap-4">
                <button onclick="showLoginModal()" class="flex-1 bg-[#70574D] text-white py-4 rounded-lg font-semibold hover:bg-[#8b7566] transition shadow-lg flex items-center justify-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Beli Sekarang
                </button>
                {{-- <button onclick="showLoginModal()" class="flex-1 border-2 border-[#70574D] text-[#70574D] py-4 rounded-lg font-semibold hover:bg-[#70574D] hover:text-white transition flex items-center justify-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                    Tambah ke Keranjang
                </button> --}}
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    @include('partials.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Login Modal (Simple) -->
<div id="loginModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-8">
        <h3 class="text-2xl font-bold mb-4">Login Diperlukan</h3>
        <p class="text-gray-600 mb-6">Silakan login terlebih dahulu untuk melakukan pembelian.</p>
        <div class="flex gap-4">
            <button onclick="hideLoginModal()" class="flex-1 border border-gray-300 py-2 rounded-lg hover:bg-gray-50">
                Batal
            </button>
            <button class="flex-1 bg-[#A78B7D] text-white py-2 rounded-lg hover:bg-[#8b7566]">
                Login
            </button>
        </div>
    </div>
</div>

<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

function showLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
}

function hideLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
}

// Close modal on background click
document.getElementById('loginModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideLoginModal();
    }
});
</script>
@endsection