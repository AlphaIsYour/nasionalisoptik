@extends('layouts.main')

@section('title', 'Profile - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#70574D]">Profile Saya</h1>
            <p class="text-gray-600 mt-2">Kelola informasi profile Anda</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-white border border-gray-200 p-8 mb-6">
            <div class="flex items-start justify-between mb-6 pb-6 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-bold text-[#70574D] mb-4">Informasi Personal</h2>
                </div>
                <a href="{{ route('profile.edit') }}" class="px-6 py-2 bg-[#70574D] text-white font-medium hover:opacity-90 transition">
                    Edit Profile
                </a>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-3 gap-4">
                    <div class="text-gray-600 font-medium">Nama Lengkap</div>
                    <div class="col-span-2 text-gray-900">{{ Auth::user()->name }}</div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="text-gray-600 font-medium">Email</div>
                    <div class="col-span-2 text-gray-900">{{ Auth::user()->email }}</div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="text-gray-600 font-medium">Nomor Telepon</div>
                    <div class="col-span-2 text-gray-900">
                        {{ Auth::user()->phone ?? '-' }}
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div class="text-gray-600 font-medium">Bergabung Sejak</div>
                    <div class="col-span-2 text-gray-900">
                        {{ Auth::user()->created_at->format('d F Y') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Card -->
        <div class="bg-white border border-gray-200 p-8">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-xl font-bold text-[#70574D] mb-2">Keamanan</h2>
                    <p class="text-gray-600 text-sm">Password terakhir diubah {{ Auth::user()->updated_at->diffForHumans() }}</p>
                </div>
                <button 
                    onclick="document.getElementById('passwordModal').classList.remove('hidden')"
                    class="px-6 py-2 border border-[#70574D] text-[#70574D] font-medium hover:bg-[#70574D] hover:text-white transition"
                >
                    Ubah Password
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div id="passwordModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white max-w-md w-full p-8">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl font-bold text-[#70574D]">Ubah Password</h3>
            <button onclick="document.getElementById('passwordModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('profile.password') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password Saat Ini
                </label>
                <input 
                    type="password" 
                    name="current_password" 
                    id="current_password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition"
                    placeholder="Masukkan password lama"
                >
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password Baru
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition"
                    placeholder="Minimal 8 karakter"
                >
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password Baru
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition"
                    placeholder="Ketik ulang password baru"
                >
            </div>

            <div class="flex gap-4 pt-4">
                <button 
                    type="button"
                    onclick="document.getElementById('passwordModal').classList.add('hidden')"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition"
                >
                    Batal
                </button>
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-[#70574D] text-white font-medium hover:opacity-90 transition"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@if($errors->any())
<script>
    document.getElementById('passwordModal').classList.remove('hidden');
</script>
@endif
@endsection