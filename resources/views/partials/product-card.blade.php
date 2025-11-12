{{-- resources/views/partials/product-card.blade.php --}}

<a href="{{ route('products.show', $product->slug) }}" class="bg-white rounded-lg shadow hover:shadow-xl transition overflow-hidden group block">
    <div class="relative h-64 bg-gray-100 overflow-hidden">
        @if($product->primaryImage)
            <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif
        
        @if($product->discount_percentage > 0)
            <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                -{{ $product->discount_percentage }}%
            </span>
        @elseif($product->is_new)
            <span class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                New
            </span>
        @endif
    </div>
    <div class="p-4">
        <h3 class="font-bold text-lg mb-1">{{ $product->name }}</h3>
        <div class="flex items-center mb-2">
            <div class="flex text-yellow-400 text-sm">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($product->rating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </div>
            <span class="text-gray-500 text-sm ml-2">({{ number_format($product->rating, 1) }})</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xl font-bold text-[#A78B7D]">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
            @if($product->discount_price)
                <span class="text-sm text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            @endif
        </div>
    </div>
</a>