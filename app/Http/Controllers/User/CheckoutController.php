<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected XenditService $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
    }

    public function index(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $cart = $user->getOrCreateCart();
        
        // Get selected items from cart
        $selectedItemIds = $request->input('selected_items', []);
        
        if (empty($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Silakan pilih minimal 1 item untuk checkout!');
        }
        
        // Get only selected cart items
        $cartItems = $cart->items()
            ->with('product')
            ->whereIn('id', $selectedItemIds)
            ->get();
        
        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak valid!');
        }
        
        // Calculate subtotal for selected items only
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        return view('user.checkout.index', compact('cart', 'cartItems', 'subtotal'));
    }

    // Process Checkout
// Process Checkout
    public function process(Request $request)
    {
        $validated = $request->validate([
            'selected_items' => 'required|array|min:1',
            'selected_items.*' => 'exists:cart_items,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'payment_method' => 'required|in:bank_transfer,e_wallet,credit_card',
            'notes' => 'nullable|string|max:500',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong!');
        }

        // Get only selected items
        $selectedItems = $cart->items()->whereIn('id', $validated['selected_items'])->get();

        if ($selectedItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak valid!');
        }

        // Calculate subtotal for selected items only
        $subtotal = $selectedItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        try {
            DB::beginTransaction();

            // Create Order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'subtotal' => $subtotal,
                'shipping_cost' => 0,
                'total' => $subtotal,
                'payment_method' => $validated['payment_method'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create Order Items from SELECTED Cart Items only
// Create Order Items from SELECTED Cart Items only
foreach ($selectedItems as $item) {
    // Pastikan product masih ada
    if (!$item->product) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
    
    // Pakai harga dari cart item (yang udah benar dari fix sebelumnya)
    // Atau fallback ke harga produk kalau cart item belum diupdate
    $finalPrice = $item->price; // Dari cart item
    
    $order->items()->create([
        'product_id' => $item->product_id,
        'product_name' => $item->product->name,
        'quantity' => $item->quantity,
        'price' => $finalPrice,
        'subtotal' => $finalPrice * $item->quantity,
    ]);

    // Update product stock
    $item->product->decrement('stock', $item->quantity);
}

            // Create Xendit Invoice (for e_wallet and credit_card)
            if (in_array($validated['payment_method'], ['e_wallet', 'credit_card'])) {
                $xenditResult = $this->xenditService->createInvoice($order);

                if ($xenditResult['success']) {
                    $order->update([
                        'xendit_invoice_id' => $xenditResult['invoice_id'],
                        'xendit_invoice_url' => $xenditResult['invoice_url'],
                    ]);
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Gagal membuat invoice pembayaran: ' . $xenditResult['error']);
                }
            }

            // Remove ONLY selected items from cart
            $selectedItems->each->delete();

            DB::commit();

            try {
                Mail::to($order->customer_email)->send(new OrderCreated($order));
            } catch (\Exception $e) {
                // Log error tapi jangan break flow
                Log::error('Failed to send order email: ' . $e->getMessage());
            }

            // Redirect based on payment method
            if (in_array($validated['payment_method'], ['e_wallet', 'credit_card'])) {
                return redirect()->away($order->xendit_invoice_url);
            } else {
                return redirect()->route('checkout.success', $order)->with('success', 'Pesanan berhasil dibuat!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Show Success Page
    public function success(Order $order)
    {
        // Verify ownership
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.checkout.success', compact('order'));
    }
}