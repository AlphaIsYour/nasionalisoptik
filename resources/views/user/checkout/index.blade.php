@extends('layouts.main')

@section('title', 'Checkout - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#70574D]">Checkout</h1>
            <p class="text-gray-600 mt-2">Lengkapi data pengiriman Anda</p>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf
            
            <!-- Hidden input untuk selected items -->
            @foreach($cartItems as $item)
                <input type="hidden" name="selected_items[]" value="{{ $item->id }}">
            @endforeach
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shipping Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Customer Information -->
                    <div class="bg-white border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-[#70574D] mb-6">Informasi Penerima</h2>
                        
                        <div class="space-y-4">
                            <!-- Name -->
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="customer_name" 
                                    id="customer_name" 
                                    value="{{ old('customer_name', Auth::user()->name) }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('customer_name') border-red-500 @enderror"
                                    placeholder="John Doe"
                                >
                                @error('customer_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    name="customer_email" 
                                    id="customer_email" 
                                    value="{{ old('customer_email', Auth::user()->email) }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('customer_email') border-red-500 @enderror"
                                    placeholder="nama@email.com"
                                >
                                @error('customer_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nomor Telepon <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    name="customer_phone" 
                                    id="customer_phone" 
                                    value="{{ old('customer_phone', Auth::user()->phone) }}"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('customer_phone') border-red-500 @enderror"
                                    placeholder="08123456789"
                                >
                                @error('customer_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="bg-white border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-[#70574D] mb-6">Alamat Pengiriman</h2>
                        
                        <div class="space-y-4">
                            <!-- Address -->
                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Lengkap <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    name="shipping_address" 
                                    id="shipping_address" 
                                    rows="3"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('shipping_address') border-red-500 @enderror"
                                    placeholder="Jl. Contoh No. 123, RT/RW, Kelurahan"
                                >{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City & Postal Code -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kota <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="city" 
                                        id="city" 
                                        value="{{ old('city') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('city') border-red-500 @enderror"
                                        placeholder="Malang"
                                    >
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kode Pos <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="postal_code" 
                                        id="postal_code" 
                                        value="{{ old('postal_code') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition @error('postal_code') border-red-500 @enderror"
                                        placeholder="65175"
                                    >
                                    @error('postal_code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-[#70574D] mb-6">Metode Pembayaran</h2>
                        
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border-2 border-gray-300 cursor-pointer hover:border-[#70574D] transition">
                                <input type="radio" name="payment_method" value="bank_transfer" checked class="w-5 h-5 text-[#70574D]">
                                <div class="ml-4">
                                    <p class="font-semibold">Transfer Bank</p>
                                    <p class="text-sm text-gray-600">Bayar melalui transfer bank</p>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 cursor-pointer hover:border-[#70574D] transition">
                                <input type="radio" name="payment_method" value="e_wallet" class="w-5 h-5 text-[#70574D]">
                                <div class="ml-4">
                                    <p class="font-semibold">E-Wallet</p>
                                    <p class="text-sm text-gray-600">OVO, GoPay, Dana, dll (via Xendit)</p>
                                </div>
                            </label>

                            <label class="flex items-center p-4 border-2 border-gray-300 cursor-pointer hover:border-[#70574D] transition">
                                <input type="radio" name="payment_method" value="credit_card" class="w-5 h-5 text-[#70574D]">
                                <div class="ml-4">
                                    <p class="font-semibold">Kartu Kredit/Debit</p>
                                    <p class="text-sm text-gray-600">Visa, Mastercard, dll (via Xendit)</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="bg-white border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-[#70574D] mb-6">Catatan Pesanan</h2>
                        <textarea 
                            name="notes" 
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition"
                            placeholder="Catatan tambahan untuk pesanan (opsional)"
                        >{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 p-6 sticky top-4">
                        <h2 class="text-xl font-bold text-[#70574D] mb-6">Ringkasan Pesanan</h2>
                        
                        <!-- Order Items -->
                        <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                            @foreach($cartItems as $item)
                                <div class="flex gap-3">
                                    <div class="w-16 h-16 bg-gray-100 flex-shrink-0">
                                        @if($item->product->primaryImage)
                                            <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-sm">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        <p class="text-sm font-bold text-[#70574D]">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Summary -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span>Rp 0</span>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-xl font-bold text-[#70574D]">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-[#70574D] text-white py-3 px-4 font-medium hover:opacity-90 transition">
                            Buat Pesanan
                        </button>

                        <a href="{{ route('cart.index') }}" class="block w-full text-center border border-[#70574D] text-[#70574D] py-3 px-4 font-medium hover:bg-[#70574D] hover:text-white transition mt-3">
                            Kembali ke Keranjang
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection