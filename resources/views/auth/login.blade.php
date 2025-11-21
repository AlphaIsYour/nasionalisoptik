@extends('layouts.main')

@section('title', 'Login - Optik Nasionalis')

@section('content')
<div class="min-h-screen flex mona-sans">
    <!-- Left Side - Image -->
    <div class="hidden lg:flex lg:w-1/2 bg-[#70574D] items-center justify-center p-12">
        <div class="max-w-md text-white">
            <h1 class="text-5xl font-bold mb-6">Selamat Datang Kembali</h1>
            <p class="text-lg leading-relaxed opacity-90">
                Login untuk melanjutkan belanja kacamata berkualitas dan mendapatkan layanan terbaik dari Optik Nasionalis.
            </p>
            <div class="mt-12">
                <img src="/image/logo/nasionalisoptik.png" alt="Optik Nasionalis" class="w-48 brightness-0 invert">
            </div>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-[#70574D] mb-2">Login</h2>
                <p class="text-gray-600">Masukkan email dan password Anda</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('email') border-red-500 @enderror"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            class="w-4 h-4 text-[#70574D] border-gray-300 focus:ring-[#70574D]"
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    {{-- Uncomment jika sudah ada fitur forgot password
                    <a href="#" class="text-sm text-[#70574D] hover:opacity-70">
                        Lupa password?
                    </a>
                    --}}
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-[#70574D] text-white py-3 px-4 font-medium hover:opacity-90 transition focus:outline-none focus:ring-2 focus:ring-[#70574D] focus:ring-offset-2"
                >
                    Login
                </button>

                <!-- Register Link -->
                <div class="text-center text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-[#70574D] font-medium hover:opacity-70">
                        Daftar sekarang
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection