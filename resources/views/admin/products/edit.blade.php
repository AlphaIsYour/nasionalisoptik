@extends('layouts.admin')

@section('title', 'Edit Produk')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.products.index') }}" class="text-[#A78B7D] hover:underline flex items-center mb-4">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Produk
    </a>
    <h1 class="text-3xl font-bold text-gray-800">Edit Produk: {{ $product->name }}</h1>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Produk</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Nama Produk *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Harga Normal *</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Harga Diskon</label>
                            <input type="number" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]">
                            @error('discount_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Brand</label>
                        <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" placeholder="Ray-Ban, Oakley, dll">
                        @error('brand')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Stok *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Product Images -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Gambar Produk</h2>
                
                <!-- Existing Images -->
                @if($product->images->count() > 0)
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Gambar Saat Ini</label>
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($product->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="w-full h-24 object-cover rounded">
                                    @if($image->is_primary)
                                        <span class="absolute top-1 left-1 bg-green-500 text-white text-xs px-2 py-0.5 rounded">Primary</span>
                                    @else
                                        <button type="button" onclick="setPrimary({{ $image->id }})" class="absolute top-1 left-1 bg-gray-800/70 text-white text-xs px-2 py-0.5 rounded hover:bg-gray-900 opacity-0 group-hover:opacity-100 transition">
                                            Set Primary
                                        </button>
                                    @endif
                                    <label class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-0.5 rounded cursor-pointer opacity-0 group-hover:opacity-100 transition">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="hidden">
                                        <span>Hapus</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Upload New Images -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Upload Gambar Baru (Multiple)</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" id="imageInput">
                    <p class="text-sm text-gray-500 mt-1">Max 2MB per gambar.</p>
                    @error('images.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    
                    <div id="imagePreview" class="grid grid-cols-4 gap-4 mt-4"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Category & Status -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Kategori & Status</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Kategori *</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Gender *</label>
                        <select name="gender" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                            <option value="unisex" {{ old('gender', $product->gender) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                            <option value="pria" {{ old('gender', $product->gender) == 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ old('gender', $product->gender) == 'wanita' ? 'selected' : '' }}>Wanita</option>
                            <option value="anak" {{ old('gender', $product->gender) == 'anak' ? 'selected' : '' }}>Anak-anak</option>
                        </select>
                        @error('gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_new" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }} class="w-4 h-4 text-[#A78B7D] rounded">
                            <span class="ml-2 text-gray-700">Produk Baru</span>
                        </label>
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-4 h-4 text-[#A78B7D] rounded">
                            <span class="ml-2 text-gray-700">Featured</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Specifications -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Spesifikasi</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Warna</label>
                        <input type="text" name="color" value="{{ old('color', $product->color) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" placeholder="Hitam, Coklat, dll">
                        @error('color')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Bentuk</label>
                        <select name="shape" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]">
                            <option value="">Pilih Bentuk</option>
                            <option value="Bulat" {{ old('shape', $product->shape) == 'Bulat' ? 'selected' : '' }}>Bulat</option>
                            <option value="Kotak" {{ old('shape', $product->shape) == 'Kotak' ? 'selected' : '' }}>Kotak</option>
                            <option value="Aviator" {{ old('shape', $product->shape) == 'Aviator' ? 'selected' : '' }}>Aviator</option>
                            <option value="Cat Eye" {{ old('shape', $product->shape) == 'Cat Eye' ? 'selected' : '' }}>Cat Eye</option>
                        </select>
                        @error('shape')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Material</label>
                        <select name="material" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]">
                            <option value="">Pilih Material</option>
                            <option value="Metal" {{ old('material', $product->material) == 'Metal' ? 'selected' : '' }}>Metal</option>
                            <option value="Plastik" {{ old('material', $product->material) == 'Plastik' ? 'selected' : '' }}>Plastik</option>
                            <option value="Titanium" {{ old('material', $product->material) == 'Titanium' ? 'selected' : '' }}>Titanium</option>
                        </select>
                        @error('material')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-[#A78B7D] text-white py-3 rounded-lg font-semibold hover:bg-[#8b7566] transition shadow-lg">
                Update Produk
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
// Image preview for new uploads
document.getElementById('imageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative';
            div.innerHTML = `<img src="${e.target.result}" class="w-full h-24 object-cover rounded">`;
            preview.appendChild(div);
        }
        reader.readAsDataURL(file);
    });
});

// Delete image checkbox styling
document.querySelectorAll('input[name="delete_images[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            this.closest('.relative').classList.add('opacity-50', 'ring-2', 'ring-red-500');
        } else {
            this.closest('.relative').classList.remove('opacity-50', 'ring-2', 'ring-red-500');
        }
    });
});

// Set primary image
function setPrimary(imageId) {
    $.ajax({
        url: '{{ route("admin.products.set-primary", $product) }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            image_id: imageId
        },
        success: function(response) {
            if (response.success) {
                location.reload();
            }
        }
    });
}
</script>
@endpush