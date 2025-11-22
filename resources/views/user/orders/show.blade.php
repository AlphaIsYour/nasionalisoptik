@extends('layouts.main')

@section('title', 'Detail Pesanan - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Back Button -->
        <a href="{{ route('orders.index') }}" class="inline-flex items-center text-[#70574D] hover:opacity-70 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Pesanan Saya
        </a>

        <!-- Order Header -->
        <div class="bg-white border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nomor Pesanan</p>
                    <p class="text-2xl font-bold text-[#70574D]">{{ $order->order_number }}</p>
                    <p class="text-sm text-gray-600 mt-1">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-2 text-sm font-semibold {{ $order->status_badge }} mb-2">
                        {{ ucfirst($order->status) }}
                    </span>
                    <br>
                    <span class="inline-block px-4 py-2 text-sm font-semibold {{ $order->payment_status_badge }}">
                        Payment: {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="font-bold text-lg text-[#70574D] mb-4">Status Pesanan</h3>
                <div class="space-y-3">
                    <div class="flex items-center {{ $order->status === 'pending' ? 'text-yellow-600' : 'text-gray-400' }}">
                        <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-3 {{ in_array($order->status, ['pending', 'processing', 'shipped', 'delivered']) ? 'bg-yellow-100 border-yellow-600' : 'border-gray-300' }}">
                            @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <span class="font-medium">Pesanan Dibuat</span>
                    </div>

                    <div class="flex items-center {{ $order->status === 'processing' ? 'text-blue-600' : 'text-gray-400' }}">
                        <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-3 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-blue-100 border-blue-600' : 'border-gray-300' }}">
                            @if(in_array($order->status, ['shipped', 'delivered']))
                                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <span class="font-medium">Diproses</span>
                    </div>

                    <div class="flex items-center {{ $order->status === 'shipped' ? 'text-purple-600' : 'text-gray-400' }}">
                        <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-3 {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-purple-100 border-purple-600' : 'border-gray-300' }}">
                            @if($order->status === 'delivered')
                                <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <span class="font-medium">Dikirim</span>
                    </div>

                    <div class="flex items-center {{ $order->status === 'delivered' ? 'text-green-600' : 'text-gray-400' }}">
                        <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center mr-3 {{ $order->status === 'delivered' ? 'bg-green-100 border-green-600' : 'border-gray-300' }}">
                            @if($order->status === 'delivered')
                                <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>
                        <span class="font-medium">Selesai</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Information -->
        <div class="bg-white border border-gray-200 p-6 mb-6">
            <h3 class="font-bold text-lg text-[#70574D] mb-4">Informasi Pengiriman</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nama Penerima</p>
                    <p class="font-semibold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-semibold">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nomor Telepon</p>
                    <p class="font-semibold">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Kota</p>
                    <p class="font-semibold">{{ $order->city }}, {{ $order->postal_code }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Alamat Lengkap</p>
                    <p class="font-semibold">{{ $order->shipping_address }}</p>
                </div>
            </div>

            @if($order->notes)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">Catatan</p>
                    <p class="font-semibold">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Payment Information -->
        <div class="bg-white border border-gray-200 p-6 mb-6">
            <h3 class="font-bold text-lg text-[#70574D] mb-4">Informasi Pembayaran</h3>
            
            <div class="mb-4">
                <p class="text-sm text-gray-600">Metode Pembayaran</p>
                <p class="font-semibold capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
            </div>

            @if($order->payment_method === 'bank_transfer')
                @if($order->payment_status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 p-4 mb-4">
                        <p class="font-semibold text-yellow-800 mb-2">Menunggu Pembayaran</p>
                        <p class="text-sm text-yellow-700">Silakan transfer ke rekening berikut:</p>
                        <div class="bg-white p-4 border border-gray-200 mt-3">
                            <p class="font-bold">Bank BCA</p>
                            <p>No. Rekening: <span class="font-bold">1234567890</span></p>
                            <p>Atas Nama: <span class="font-bold">Optik Nasionalis</span></p>
                            <p class="mt-2 text-sm text-gray-600">Total: <span class="font-bold text-[#70574D] text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</span></p>
                        </div>
                    </div>

                    @if($order->payment_proof)
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Bukti Transfer (Menunggu Verifikasi)</p>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer" class="max-w-xs border border-gray-300">
                        </div>
                    @endif

                    <button onclick="showUploadModal()" class="w-full bg-[#70574D] text-white py-3 font-medium hover:opacity-90 transition">
                        {{ $order->payment_proof ? 'Upload Ulang Bukti Transfer' : 'Upload Bukti Transfer' }}
                    </button>
                @elseif($order->payment_status === 'paid')
                    <div class="bg-green-50 border border-green-200 p-4">
                        <p class="font-semibold text-green-800">✓ Pembayaran Telah Dikonfirmasi</p>
                        <p class="text-sm text-green-700 mt-1">Dibayar pada: {{ $order->paid_at?->format('d F Y, H:i') }}</p>
                    </div>

                    @if($order->payment_proof)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 mb-2">Bukti Transfer</p>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer" class="max-w-xs border border-gray-300">
                        </div>
                    @endif
                @endif
            @elseif(in_array($order->payment_method, ['e_wallet', 'credit_card']))
                @if($order->payment_status === 'paid')
                    <div class="bg-green-50 border border-green-200 p-4">
                        <p class="font-semibold text-green-800">✓ Pembayaran Berhasil</p>
                        <p class="text-sm text-green-700 mt-1">Dibayar pada: {{ $order->paid_at?->format('d F Y, H:i') }}</p>
                    </div>
                @elseif($order->payment_status === 'pending' && $order->xendit_invoice_url)
                    <div class="bg-yellow-50 border border-yellow-200 p-4 mb-4">
                        <p class="font-semibold text-yellow-800 mb-2">Menunggu Pembayaran</p>
                        <p class="text-sm text-yellow-700 mb-3">Selesaikan pembayaran Anda melalui Xendit</p>
                        <a href="{{ $order->xendit_invoice_url }}" target="_blank" class="inline-block bg-[#70574D] text-white px-6 py-2 font-medium hover:opacity-90 transition">
                            Bayar Sekarang
                        </a>
                    </div>
                @endif
            @endif
        </div>

        <!-- Order Items -->
        <div class="bg-white border border-gray-200 p-6 mb-6">
            <h3 class="font-bold text-lg text-[#70574D] mb-4">Detail Pesanan</h3>
            
            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0">
                        <div class="w-20 h-20 bg-gray-100 flex-shrink-0">
                                    @if($item->product && $item->product->primaryImage)
                                        <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                                            No Image
                                        </div>
                                    @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold">{{ $item->product_name }}</p>
                            <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#70574D]">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Ongkos Kirim</span>
                    <span class="font-semibold">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-xl font-bold text-[#70574D] pt-2 border-t border-gray-200">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Cancel Order Button -->
        @if($order->status === 'pending' && $order->payment_status === 'pending')
            <div class="bg-white border border-gray-200 p-6">
                <form method="POST" action="{{ route('orders.cancel', $order) }}" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                        Batalkan Pesanan
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>

<!-- Upload Proof Modal -->
<div id="uploadModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white max-w-md w-full p-8">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-2xl font-bold text-[#70574D]">Upload Bukti Transfer</h3>
            <button onclick="hideUploadModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('orders.upload-proof', $order) }}" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                    Pilih File Bukti Transfer (JPG, PNG - Max 2MB)
                </label>
                <input 
                    type="file" 
                    name="payment_proof" 
                    id="payment_proof" 
                    accept="image/jpeg,image/jpg,image/png"
                    required
                    class="w-full px-4 py-3 border border-gray-300 focus:outline-none focus:border-[#70574D] transition"
                >
                <p class="mt-2 text-sm text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB.</p>
            </div>

            <div class="flex gap-4">
                <button 
                    type="button"
                    onclick="hideUploadModal()"
                    class="flex-1 px-6 py-3 border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition"
                >
                    Batal
                </button>
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-[#70574D] text-white font-medium hover:opacity-90 transition"
                >
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showUploadModal() {
    document.getElementById('uploadModal').classList.remove('hidden');
}

function hideUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
}

// Close modal on background click
document.getElementById('uploadModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        hideUploadModal();
    }
});
</script>
@endsection