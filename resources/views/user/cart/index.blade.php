@extends('layouts.main')

@section('title', 'Keranjang - Optik Nasionalis')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 mona-sans">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#70574D]">Keranjang Belanja</h1>
            <p class="text-gray-600 mt-2">{{ $cart->total_items }} item dalam keranjang</p>
        </div>

        @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Select All -->
            <div class="bg-white border border-gray-200 p-4">
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="selectAll"
                        class="w-5 h-5 text-[#70574D] border-gray-300 rounded focus:ring-[#70574D]"
                        onchange="toggleSelectAll(this)"
                    >
                    <span class="ml-3 font-semibold text-gray-700">Pilih Semua</span>
                </label>
            </div>

            @foreach($cartItems as $item)
                <div class="bg-white border border-gray-200 p-6">
                    <div class="flex gap-6">
                        <!-- Checkbox -->
                        <div class="flex items-start pt-2">
                            <input 
                                type="checkbox" 
                                data-item-id="{{ $item->id }}"
                                data-price="{{ $item->price }}"
                                data-quantity="{{ $item->quantity }}"
                                data-total="{{ $item->total }}"
                                class="cart-item-checkbox w-5 h-5 text-[#70574D] border-gray-300 rounded focus:ring-[#70574D]"
                                onchange="updateSummary()"
                            >
                        </div>

                        <!-- Product Image -->
                        <div class="w-32 h-32 flex-shrink-0 bg-gray-100 overflow-hidden">
                            @if($item->product->primaryImage)
                                <img src="{{ asset('storage/' . $item->product->primaryImage->image_path) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="font-bold text-lg text-[#70574D]">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-gray-600">{{ $item->product->brand }}</p>
                                </div>
                                <form method="POST" action="{{ route('cart.remove', $item) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <!-- Quantity Controls -->
                                <div class="flex items-center gap-3">
                                    <span class="text-sm text-gray-600">Jumlah:</span>
                                    <div class="flex items-center border border-gray-300">
                                        <form method="POST" action="{{ route('cart.update', $item) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                            <button type="submit" class="px-3 py-1 hover:bg-gray-100 {{ $item->quantity <= 1 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                                -
                                            </button>
                                        </form>
                                        
                                        <span class="px-4 py-1 border-x border-gray-300">{{ $item->quantity }}</span>
                                        
                                        <form method="POST" action="{{ route('cart.update', $item) }}" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                            <button type="submit" class="px-3 py-1 hover:bg-gray-100">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }} / pcs</p>
                                    <p class="text-lg font-bold text-[#70574D]">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Clear Cart -->
            <div class="pt-4">
                <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                        Kosongkan Keranjang
                    </button>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 p-6 sticky top-4">
                <h2 class="text-xl font-bold text-[#70574D] mb-6">Ringkasan Pesanan</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Item Dipilih</span>
                        <span id="selectedCount">0</span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span id="selectedSubtotal">Rp 0</span>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-lg font-bold text-[#70574D]">
                            <span>Total</span>
                            <span id="selectedTotal">Rp 0</span>
                        </div>
                    </div>
                </div>

                <button type="button" id="checkoutBtn" onclick="goToCheckout()" disabled class="block w-full bg-gray-400 text-white text-center py-3 px-4 font-medium cursor-not-allowed transition">
                    Checkout
                </button>

                <a href="{{ route('products.index') }}" class="block w-full text-center border border-[#70574D] text-[#70574D] py-3 px-4 font-medium hover:bg-[#70574D] hover:text-white transition mt-3">
                    Lanjut Belanja
                </a>

                <p class="text-xs text-gray-500 text-center mt-3">Pilih minimal 1 item untuk checkout</p>
            </div>
        </div>
    </div>
            </form>
        @else
            <!-- Empty Cart -->
            <div class="bg-white border border-gray-200 p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Kosong</h3>
                <p class="text-gray-600 mb-6">Belum ada produk di keranjang Anda</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-[#70574D] text-white py-3 px-8 font-medium hover:opacity-90 transition">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>

<script>
// Toggle Select All
function toggleSelectAll(checkbox) {
    const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    itemCheckboxes.forEach(cb => {
        cb.checked = checkbox.checked;
    });
    updateSummary();
}

// Update Summary
function updateSummary() {
    const selectedCheckboxes = document.querySelectorAll('.cart-item-checkbox:checked');
    
    // Calculate totals
    let count = 0;
    let subtotal = 0;
    
    selectedCheckboxes.forEach(checkbox => {
        count++;
        subtotal += parseFloat(checkbox.dataset.total);
    });
    
    // Update UI
    document.getElementById('selectedCount').textContent = count + ' item';
    document.getElementById('selectedSubtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    document.getElementById('selectedTotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
    
    // Enable/disable checkout button
    const checkoutBtn = document.getElementById('checkoutBtn');
    if (count > 0) {
        checkoutBtn.disabled = false;
        checkoutBtn.classList.remove('bg-gray-400', 'cursor-not-allowed');
        checkoutBtn.classList.add('bg-[#70574D]', 'hover:opacity-90', 'cursor-pointer');
    } else {
        checkoutBtn.disabled = true;
        checkoutBtn.classList.add('bg-gray-400', 'cursor-not-allowed');
        checkoutBtn.classList.remove('bg-[#70574D]', 'hover:opacity-90', 'cursor-pointer');
    }
    
    // Update "Select All" checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    const allCheckboxes = document.querySelectorAll('.cart-item-checkbox');
    selectAllCheckbox.checked = allCheckboxes.length > 0 && selectedCheckboxes.length === allCheckboxes.length;
}

// Go to Checkout
function goToCheckout() {
    const selectedCheckboxes = document.querySelectorAll('.cart-item-checkbox:checked');
    
    if (selectedCheckboxes.length === 0) {
        alert('Silakan pilih minimal 1 item untuk checkout!');
        return;
    }
    
    // Build URL with selected item IDs
    const selectedIds = Array.from(selectedCheckboxes).map(cb => cb.dataset.itemId);
    const params = selectedIds.map(id => 'selected_items[]=' + id).join('&');
    
    window.location.href = '{{ route("checkout.index") }}?' + params;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateSummary();
});
</script>
@endsection