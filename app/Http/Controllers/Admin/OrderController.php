<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Show All Orders
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->has('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order number or customer name
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    // Show Order Detail
    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    // Update Order Status
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update([
            'status' => $validated['status']
        ]);

        // If cancelled, return stock
        if ($validated['status'] === 'cancelled') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    // Approve Payment (for bank transfer)
    public function approvePayment(Order $order)
    {
        if ($order->payment_method !== 'bank_transfer' || !$order->payment_proof) {
            return redirect()->back()->with('error', 'Pesanan ini tidak memerlukan approval pembayaran.');
        }

        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
            'paid_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    // Reject Payment
    public function rejectPayment(Request $request, Order $order)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        // Delete payment proof
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->update([
            'payment_proof' => null,
            'notes' => ($order->notes ? $order->notes . "\n\n" : '') . 
                       "Bukti pembayaran ditolak: " . $validated['rejection_reason'],
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran ditolak. User perlu upload ulang.');
    }

    // Delete Order (optional - with caution)
    public function destroy(Order $order)
    {
        // Only can delete cancelled orders
        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Hanya pesanan yang dibatalkan yang bisa dihapus.');
        }

        // Return stock if payment was successful
        if ($order->payment_status === 'paid') {
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        // Delete payment proof if exists
        if ($order->payment_proof) {
            Storage::disk('public')->delete($order->payment_proof);
        }

        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}