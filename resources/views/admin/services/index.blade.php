@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Kelola Layanan</h1>
        <p class="text-gray-600 mt-1">Manage layanan yang ditawarkan</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="bg-[#70574D] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#8b7566] transition shadow-lg flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Layanan
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="p-6">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($services as $service)
                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                    <div class="grid grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="px-2 py-1 text-xs rounded {{ $service->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                    {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                <span class="text-xs text-gray-500">Order: {{ $service->sort_order }}</span>
                            </div>
                            <h3 class="font-bold text-lg mb-2">{{ $service->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $service->description }}</p>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="flex-1 text-center px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="bg-gray-200">
                            @if($service->image_path)
                                <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Layanan</h3>
                <p class="text-gray-500 mb-4">Tambahkan layanan yang ditawarkan</p>
                <a href="{{ route('admin.services.create') }}" class="inline-block bg-[#70574D] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#8b7566] transition">
                    Tambah Layanan Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection