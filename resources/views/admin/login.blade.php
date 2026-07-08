<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Optik Nasionalis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
          @font-face {
    font-family: 'CustomFont';
    src: url('/fonts/titling.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }

  .custom-font {
    font-family: 'CustomFont', sans-serif;
    letter-spacing: 0.1em;
  }
    </style>
</head>
<body class="bg-[#e6e5e5] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-sm shadow-2xl w-full max-w-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gray-100 text-black p-8 text-center">
            <h1 class="text-3xl font-bold mb-2 custom-font">Optik Nasionalis</h1>
            <p class="text-sm opacity-90">Admin Dashboard Login</p>
        </div>

        <!-- Login Form -->
        <div class="p-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">
                        Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#A78B7D] focus:ring-2 focus:ring-[#A78B7D]/20 transition"
                        placeholder="admin@optiknasionalis.com"
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="password">
                        Password
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#A78B7D] focus:ring-2 focus:ring-[#A78B7D]/20 transition"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-6 flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember" 
                        class="w-4 h-4 text-[#A78B7D] border-gray-300 rounded focus:ring-[#A78B7D]"
                    >
                    <label for="remember" class="ml-2 text-gray-700 text-sm">
                        Ingat Saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-[#A78B7D] text-white py-3 rounded-lg font-semibold hover:bg-[#8b7566] transition shadow-lg hover:shadow-xl"
                >
                    Login
                </button>
            </form>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-[#A78B7D] hover:underline text-sm">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Footer -->
        {{-- <div class="bg-gray-50 px-8 py-4 text-center text-gray-600 text-sm border-t">
            <p>Default: admin@optiknasionalis.com / admin123</p>
        </div> --}}
    </div>
</body>
</html>