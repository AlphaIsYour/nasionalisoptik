<!-- admin/orders/show.blade.php -->
@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.orders.index') }}" class="text-[#A78B7D] hover:underline">← Kembali</a>
        <h1 class="text-3xl font-bold text-gray-800">Pesanan #{{ $order->id }}</h1>
    </div>
    <p class="text-gray-600 mt-1">{{ $order->created_at->format('d M Y H:i') }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Order Info -->
    <div class="lg:col-span-2">
        <!-- Status Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Status Pesanan</h2>
            
            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex gap-4">
                @csrf
                @method('PUT')
                <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#A78B7D]">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="px-6 py-2 bg-[#A78B7D] text-white rounded-lg hover:bg-opacity-90">
                    Update
                </button>
            </form>

            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">
                    <span class="font-semibold">Status saat ini:</span>
                    <span class="ml-2 px-2 py-1 rounded font-semibold
                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-purple-100 text-purple-700' : '' }}
                        {{ $order->status == 'delivered' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
        </div>

        <!-- Items Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Item Pesanan</h2>
            
            <div class="divide-y">
                @foreach($order->items as $item)
                <div class="py-4 flex gap-4">
                    <img src="{{ asset('storage/' . $item->product->primaryImage->image_path ?? '') }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded object-cover">
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="font-semibold text-gray-800 mt-1">Subtotal: Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Payment Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Pembayaran</h2>
            
            <div class="space-y-3 mb-6">
                <div class="flex justify-between">
                    <p class="text-gray-600">Subtotal:</p>
                    <p class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-gray-600">Ongkir:</p>
                    <p class="font-semibold">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</p>
                </div>
                <div class="flex justify-between border-t pt-3">
                    <p class="font-semibold">Total:</p>
                    <p class="text-lg font-bold text-[#A78B7D]">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="p-3 bg-gray-50 rounded-lg mb-6">
                <p class="text-sm"><span class="font-semibold">Status:</span> 
                    <span class="ml-2 px-2 py-1 rounded font-semibold
                        {{ $order->payment_status == 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                        {{ $order->payment_status == 'paid' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $order->payment_status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </p>
            </div>

            @if($order->payment_status == 'pending' && $order->payment_proof)
            <div class="space-y-3">
                <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="w-full max-w-xs rounded border">
                <div class="flex gap-3">
                    <form action="{{ route('admin.orders.approve-payment', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Terima Pembayaran
                        </button>
                    </form>
                    <form action="{{ route('admin.orders.reject-payment', $order->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700" onclick="return confirm('Yakin tolak pembayaran?')">
                            Tolak Pembayaran
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Customer Info -->
    <div>
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pelanggan</h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600">Nama</p>
                    <p class="font-semibold text-gray-800">{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-semibold text-gray-800">{{ $order->user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Telepon</p>
                    <p class="font-semibold text-gray-800">{{ $order->user->phone ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Alamat Pengiriman</h3>
            <div class="space-y-2">
                <p class="font-semibold text-gray-800">{{ $order->shipping_address }}</p>
                <p class="text-sm text-gray-600">{{ $order->shipping_city }}, {{ $order->shipping_province }}</p>
                <p class="text-sm text-gray-600">{{ $order->shipping_postal_code }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Delete Button -->
<div class="flex justify-end">
    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesanan ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
            Hapus Pesanan
        </button>
    </form>
</div>
@endsection