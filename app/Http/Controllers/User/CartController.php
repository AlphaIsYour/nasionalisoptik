<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\User; // ← Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show Cart
    public function index()
    {
        /** @var User $user */  // ← Tambahkan ini
        $user = Auth::user();
        $cart = $user->getOrCreateCart();
        $cartItems = $cart->items()->with('product')->get();
        
        return view('user.cart.index', compact('cart', 'cartItems'));
    }

    // Add to Cart
    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        /** @var User $user */  // ← Tambahkan ini
        $user = Auth::user();
        $cart = $user->getOrCreateCart();

        // Check if product already in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity
            $cartItem->update([
                'quantity' => $cartItem->quantity + $validated['quantity']
            ]);
        } else {
            // Create new cart item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $product->price, // Simpan harga saat ini
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Update Cart Item Quantity
    public function update(Request $request, CartItem $cartItem)
    {
        // Verify ownership
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update($validated);

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    // Remove from Cart
    public function remove(CartItem $cartItem)
    {
        // Verify ownership
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    // Clear Cart
    public function clear()
    {
        /** @var User $user */  // ← Tambahkan ini
        $user = Auth::user();
        $cart = $user->cart;
        
        if ($cart) {
            $cart->items()->delete();
        }

        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}   