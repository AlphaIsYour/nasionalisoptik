<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin Optik Nasionalis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#70574D] text-white flex-shrink-0">
            <div class="p-6 border-b border-white/10">
                <h1 class="text-2xl font-bold">Optik Nasionalis</h1>
                <p class="text-sm opacity-75 mt-1">Admin Panel</p>
            </div>
            
            <nav class="p-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-white/20' : 'hover:bg-white/10' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Produk
                </a>
                
                <a href="{{ route('admin.services.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-white/20' : 'hover:bg-white/10' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Layanan
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                class="flex items-center px-4 py-3 mb-2 rounded-lg 
                {{ request()->routeIs('admin.orders.*') ? 'bg-white/20' : 'hover:bg-white/10' }} transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z" />
                    </svg>
                    Pesanan
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-4 border-t border-white/10">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                        <span class="font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-xs opacity-75">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('title')</h2>
                    </div>
                    <a href="{{ route('home') }}" target="_blank" class="text-[#70574D] hover:underline text-sm font-semibold">
                        Lihat Website →
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Toast Notifications -->
    @if(session('success') || session('error'))
        <div id="adminToast" class="fixed top-4 right-4 z-50 transform transition-all duration-500 ease-in-out translate-x-0 opacity-100">
            @if(session('success'))
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 min-w-[350px] max-w-md">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium flex-1">{{ session('success') }}</p>
                    <button onclick="closeAdminToast()" class="ml-auto hover:bg-white/20 rounded p-1 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center gap-3 min-w-[350px] max-w-md">
                    <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="font-medium flex-1">{{ session('error') }}</p>
                    <button onclick="closeAdminToast()" class="ml-auto hover:bg-white/20 rounded p-1 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <script>
            // Slide in animation
            window.addEventListener('DOMContentLoaded', function() {
                const toast = document.getElementById('adminToast');
                if (toast) {
                    toast.classList.add('translate-x-[400px]', 'opacity-0');
                    setTimeout(() => {
                        toast.classList.remove('translate-x-[400px]', 'opacity-0');
                    }, 100);
                }
            });

            // Auto hide toast after 5 seconds
            setTimeout(function() {
                closeAdminToast();
            }, 5000);

            function closeAdminToast() {
                const toast = document.getElementById('adminToast');
                if (toast) {
                    toast.classList.add('translate-x-[400px]', 'opacity-0');
                    setTimeout(() => toast.remove(), 500);
                }
            }
        </script>
    @endif

    @stack('scripts')
</body>
</html>