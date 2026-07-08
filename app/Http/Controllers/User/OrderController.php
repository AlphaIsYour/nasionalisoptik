<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CloudinaryService;

class OrderController extends Controller
{
    protected $cloudinary;

    public function __construct(CloudinaryService $cloudinary)
    {
        $this->cloudinary = $cloudinary;
    }

    // Show All Orders (Order History)
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);
        
        return view('user.orders.index', compact('orders'));
    }

    // Show Order Detail
    public function show(Order $order)
    {
        // Verify ownership
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product');
        
        return view('user.orders.show', compact('order'));
    }

    // Upload Payment Proof
    public function uploadProof(Request $request, Order $order)
    {
        // Verify ownership
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only for bank transfer and pending payment
        if ($order->payment_method !== 'bank_transfer' || $order->payment_status !== 'pending') {
            return redirect()->back()->with('error', 'Upload bukti hanya untuk pembayaran bank transfer yang belum dibayar.');
        }

        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        try {
            // Upload to Cloudinary
            $path = $this->cloudinary->upload($request->file('payment_proof'), 'payment-proofs');

            // Update order
            $order->update([
                'payment_proof' => $path,
                'payment_status' => 'pending',
            ]);

            return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload! Menunggu verifikasi admin.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal upload bukti: ' . $e->getMessage());
        }
    }

    // Cancel Order (optional)
    public function cancel(Order $order)
    {
        // Verify ownership
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Only can cancel if status is pending
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        try {
            // Return stock
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // Update order status
            $order->update([
                'status' => 'cancelled',
                'payment_status' => 'failed',
            ]);

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }
}