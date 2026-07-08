<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\XenditService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    protected XenditService $xenditService;

    public function __construct(XenditService $xenditService)
    {
        $this->xenditService = $xenditService;
    }

    /**
     * Handle Xendit Invoice Webhook
     */
    public function xenditInvoice(Request $request)
    {
        // Verify callback token
        $callbackToken = $request->header('x-callback-token');
        
        if (!$this->xenditService->verifyCallbackToken($callbackToken)) {
            Log::warning('Xendit webhook: Invalid callback token');
            return response()->json(['error' => 'Invalid callback token'], 401);
        }

        $data = $request->all();
        
        Log::info('Xendit Invoice Webhook:', $data);

        // Find order by external_id (order_number)
        $order = Order::where('order_number', $data['external_id'])->first();

        if (!$order) {
            Log::warning('Xendit webhook: Order not found', ['external_id' => $data['external_id']]);
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Update order based on invoice status
        switch ($data['status']) {
            case 'PAID':
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing',
                    'paid_at' => now(),
                ]);
                Log::info('Order paid successfully', ['order_number' => $order->order_number]);
                break;

            case 'EXPIRED':
                $order->update([
                    'payment_status' => 'expired',
                    'status' => 'cancelled',
                ]);
                
                // Return stock
                foreach ($order->items as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
                
                Log::info('Order expired', ['order_number' => $order->order_number]);
                break;
        }

        return response()->json(['success' => true]);
    }
}