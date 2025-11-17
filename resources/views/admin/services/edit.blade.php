@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.services.index') }}" class="text-[#A78B7D] hover:underline flex items-center mb-4">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Layanan
    </a>
    <h1 class="text-3xl font-bold text-gray-800">Edit Layanan: {{ $service->title }}</h1>
</div>

<form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Layanan</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Judul Layanan *</label>
                        <input type="text" name="title" value="{{ old('title', $service->title) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Deskripsi *</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" required>{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Link (Opsional)</label>
                        <input type="url" name="link" value="{{ old('link', $service->link) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]">
                        @error('link')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Gambar Layanan</label>
                        
                        @if($service->image_path)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar Saat Ini:</p>
                                <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif
                        
                        <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" id="imageInput">
                        <p class="text-sm text-gray-500 mt-1">Upload gambar baru untuk mengganti. Max 2MB</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Pengaturan</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Urutan Tampil *</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#A78B7D]" min="0" required>
                        <p class="text-sm text-gray-500 mt-1">Semakin kecil, semakin di atas</p>
                        @error('sort_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="w-4 h-4 text-[#A78B7D] rounded">
                            <span class="ml-2 text-gray-700">Aktifkan Layanan</span>
                        </label>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-[#A78B7D] text-white py-3 rounded-lg font-semibold hover:bg-[#8b7566] transition shadow-lg">
                Update Layanan
            </button>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <p class="text-sm text-gray-600 mb-2">Preview Gambar Baru:</p>
                <img src="${e.target.result}" class="w-full h-48 object-cover rounded-lg">
            `;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endpush