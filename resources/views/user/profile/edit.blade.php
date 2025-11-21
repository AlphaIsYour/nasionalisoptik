@extends('layouts.main')

@section('title', 'Edit Profile - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-2xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('profile.index') }}" class="inline-flex items-center text-[#70574D] hover:opacity-70 mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <h1 class="text-3xl font-bold text-[#70574D]">Edit Profile</h1>
            <p class="text-gray-600 mt-2">Perbarui informasi profile Anda</p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white border border-gray-200 p-8">
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', Auth::user()->name) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('name') border-red-500 @enderror"
                        placeholder="John Doe"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', Auth::user()->email) }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('email') border-red-500 @enderror"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Nomor Telepon
                    </label>
                    <input 
                        type="tel" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone', Auth::user()->phone) }}"
                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('phone') border-red-500 @enderror"
                        placeholder="08123456789"
                    >
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4">
                    <a 
                        href="{{ route('profile.index') }}"
                        class="flex-1 text-center px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit"
                        class="flex-1 px-6 py-3 bg-[#70574D] text-white font-medium hover:opacity-90 transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection