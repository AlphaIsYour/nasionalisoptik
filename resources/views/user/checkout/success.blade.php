@extends('layouts.main')

@section('title', 'Pesanan Berhasil - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-3xl mx-auto px-4">
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 rounded-full mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h1>
            <p class="text-gray-600">Terima kasih atas pesanan Anda</p>
        </div>

        <!-- Order Info -->
        <div class="bg-white border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-200">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nomor Pesanan</p>
                    <p class="text-2xl font-bold text-[#70574D]">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Tanggal Pesanan</p>
                    <p class="font-semibold">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="mb-6">
                <h3 class="font-bold text-lg text-[#70574D] mb-3">Informasi Penerima</h3>
                <div class="space-y-2 text-gray-700">
                    <p><span class="font-semibold">Nama:</span> {{ $order->customer_name }}</p>
                    <p><span class="font-semibold">Email:</span> {{ $order->customer_email }}</p>
                    <p><span class="font-semibold">Telepon:</span> {{ $order->customer_phone }}</p>
                    <p><span class="font-semibold">Alamat:</span> {{ $order->shipping_address }}, {{ $order->city }}, {{ $order->postal_code }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="mb-6">
                <h3 class="font-bold text-lg text-[#70574D] mb-3">Detail Pesanan</h3>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex justify-between py-2 border-b border-gray-100">
                            <div>
                                <p class="font-semibold">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-bold text-[#70574D]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between text-lg font-bold text-[#70574D]">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Instructions -->
        <div class="bg-yellow-50 border border-yellow-200 p-6 mb-6">
            <h3 class="font-bold text-lg text-[#70574D] mb-3">Instruksi Pembayaran</h3>
            
            @if($order->payment_method === 'bank_transfer')
                <div class="space-y-3 text-gray-700">
                    <p class="font-semibold">Transfer Bank:</p>
                    <div class="bg-white p-4 border border-gray-200">
                        <p class="font-bold">Bank BCA</p>
                        <p>No. Rekening: <span class="font-bold">1234567890</span></p>
                        <p>Atas Nama: <span class="font-bold">Optik Nasionalis</span></p>
                    </div>
                    <p class="text-sm">Setelah transfer, silakan upload bukti pembayaran melalui halaman pesanan Anda.</p>
                </div>
            @else
                <p class="text-gray-700">Link pembayaran akan dikirimkan ke email Anda dalam beberapa menit.</p>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4">
            <a href="{{ route('home') }}" class="flex-1 text-center border border-[#70574D] text-[#70574D] py-3 px-6 font-medium hover:bg-[#70574D] hover:text-white transition">
                Kembali ke Beranda
            </a>
            <a href="{{ route('products.index') }}" class="flex-1 text-center bg-[#70574D] text-white py-3 px-6 font-medium hover:opacity-90 transition">
                Lanjut Belanja
            </a>
        </div>
    </div>
</div>
@endsection