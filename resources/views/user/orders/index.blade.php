@extends('layouts.main')

@section('title', 'Pesanan Saya - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#70574D]">Pesanan Saya</h1>
            <p class="text-gray-600 mt-2">Riwayat semua pesanan Anda</p>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white border border-gray-200 p-6">
                        <!-- Order Header -->
                        <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Nomor Pesanan</p>
                                <p class="text-xl font-bold text-[#70574D]">{{ $order->order_number }}</p>
                                <p class="text-sm text-gray-600 mt-1">{{ $order->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $order->status_badge }} mb-2">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <br>
                                <span class="inline-block px-3 py-1 text-sm font-semibold {{ $order->payment_status_badge }}">
                                    Payment: {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Order Items Summary -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">{{ $order->items->count() }} item</p>
                            <div class="flex gap-2">
                                @foreach($order->items->take(3) as $item)
                                    <div class="w-16 h-16 bg-gray-100">
                                        @if($item->product && $item->product->primary_image)
                                            <img src="{{ asset('storage/' . $item->product->primary_image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @endforeach
                                @if($order->items->count() > 3)
                                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center text-gray-600 text-sm">
                                        +{{ $order->items->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Total & Actions -->
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-gray-600">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-[#70574D]">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('orders.show', $order) }}" class="px-6 py-2 border border-[#70574D] text-[#70574D] font-medium hover:bg-[#70574D] hover:text-white transition">
                                    Detail
                                </a>
                                
                                @if($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
                                    <button onclick="showUploadModal({{ $order->id }})" class="px-6 py-2 bg-[#70574D] text-white font-medium hover:opacity-90 transition">
                                        Upload Bukti
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white border border-gray-200 p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki riwayat pesanan</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-[#70574D] text-white py-3 px-8 font-medium hover:opacity-90 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>
@endsection