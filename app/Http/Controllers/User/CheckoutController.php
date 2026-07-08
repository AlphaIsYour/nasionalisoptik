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
        
        $selectedItemIds = $request->input('selected_items', []);
        
        if (empty($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Silakan pilih minimal 1 item untuk checkout!');
        }
        
        $cartItems = $cart->items()
            ->with('product')
            ->whereIn('id', $selectedItemIds)
            ->get();
        
        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak valid!');
        }
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        return view('user.checkout.index', compact('cart', 'cartItems', 'subtotal'));
    }

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

        $selectedItems = $cart->items()->whereIn('id', $validated['selected_items'])->get();

        if ($selectedItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Item yang dipilih tidak valid!');
        }

        $subtotal = $selectedItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        try {
            // Create order in transaction
            DB::beginTransaction();

            Log::info('Creating order', ['user_id' => $user->id, 'subtotal' => $subtotal]);

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

            foreach ($selectedItems as $item) {
                if (!$item->product) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Produk tidak ditemukan.');
                }
                
                $finalPrice = $item->price;
                
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $finalPrice,
                    'subtotal' => $finalPrice * $item->quantity,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $selectedItems->each->delete();

            DB::commit();
            
            Log::info('Order created successfully', ['order_id' => $order->id, 'order_number' => $order->order_number]);

            // Xendit OUTSIDE transaction
            if (in_array($validated['payment_method'], ['e_wallet', 'credit_card'])) {
                Log::info('Creating Xendit invoice', ['order_id' => $order->id]);
                
                $xenditResult = $this->xenditService->createInvoice($order);

                if ($xenditResult['success']) {
                    $order->update([
                        'xendit_invoice_id' => $xenditResult['invoice_id'],
                        'xendit_invoice_url' => $xenditResult['invoice_url'],
                    ]);
                    
                    Log::info('Xendit invoice created', [
                        'order_id' => $order->id,
                        'invoice_id' => $xenditResult['invoice_id']
                    ]);
                } else {
                    Log::error('Xendit invoice creation failed', [
                        'order_id' => $order->id,
                        'error' => $xenditResult['error']
                    ]);
                    
                    return redirect()->route('checkout.success', $order)
                        ->with('warning', 'Pesanan berhasil dibuat, namun link pembayaran gagal. Silakan hubungi admin.');
                }
            }

            // Email pakai queue
            try {
                Mail::to($order->customer_email)->queue(new OrderCreated($order));
                Log::info('Order email queued', ['order_id' => $order->id]);
            } catch (\Exception $e) {
                Log::error('Failed to queue order email', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage()
                ]);
            }

            // Redirect
            if (in_array($validated['payment_method'], ['e_wallet', 'credit_card']) && !empty($order->xendit_invoice_url)) {
                return redirect()->away($order->xendit_invoice_url);
            } else {
                return redirect()->route('checkout.success', $order)->with('success', 'Pesanan berhasil dibuat!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout process failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.checkout.success', compact('order'));
    }
}