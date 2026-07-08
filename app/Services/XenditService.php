<?php

namespace App\Services;

use App\Models\Order;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Facades\Log;

class XenditService
{
    protected InvoiceApi $invoiceApi;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.api_key'));
        
        $httpClient = new \GuzzleHttp\Client([
            'timeout' => 10,
            'connect_timeout' => 5
        ]);
        
        $this->invoiceApi = new InvoiceApi($httpClient);
    }

    public function createInvoice(Order $order): array
    {
        try {
            $items = [];
            foreach ($order->items as $item) {
                $items[] = [
                    'name' => $item->product_name,
                    'quantity' => $item->quantity,
                    'price' => (float) $item->price,
                    'category' => 'Product'
                ];
            }

            $invoiceData = new CreateInvoiceRequest([
                'external_id' => $order->order_number,
                'amount' => (float) $order->total,
                'payer_email' => $order->customer_email,
                'description' => 'Pembayaran Order #' . $order->order_number,
                'customer' => [
                    'given_names' => $order->customer_name,
                    'email' => $order->customer_email,
                    'mobile_number' => $order->customer_phone,
                ],
                'items' => $items,
                'currency' => 'IDR',
                'invoice_duration' => 86400,
                'success_redirect_url' => url('/checkout/success/' . $order->id),
                'failure_redirect_url' => url('/cart'),
            ]);

            Log::info('Creating Xendit invoice with data', [
                'order_number' => $order->order_number,
                'amount' => $order->total,
                'email' => $order->customer_email
            ]);

            $invoice = $this->invoiceApi->createInvoice($invoiceData);

            Log::info('Xendit invoice created successfully', [
                'invoice_id' => $invoice['id'],
                'invoice_url' => $invoice['invoice_url']
            ]);

            return [
                'success' => true,
                'invoice_id' => $invoice['id'],
                'invoice_url' => $invoice['invoice_url'],
                'expiry_date' => $invoice['expiry_date'],
            ];

        } catch (\Xendit\XenditSdkException $e) {
            Log::error('Xendit SDK Exception', [
                'message' => $e->getMessage(),
                'full_error' => $e->getFullError(),
                'order_number' => $order->order_number
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError()
            ];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            Log::error('Xendit Connection Timeout', [
                'message' => $e->getMessage(),
                'order_number' => $order->order_number
            ]);
            
            return [
                'success' => false,
                'error' => 'Connection timeout',
            ];
        } catch (\Exception $e) {
            Log::error('Xendit Unknown Error', [
                'message' => $e->getMessage(),
                'order_number' => $order->order_number
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getInvoice(string $invoiceId): array
    {
        try {
            $invoice = $this->invoiceApi->getInvoiceById($invoiceId);
            
            return [
                'success' => true,
                'data' => $invoice
            ];

        } catch (\Xendit\XenditSdkException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return [
                'success' => false,
                'error' => 'Connection timeout',
            ];
        }
    }

    public function verifyCallbackToken(string $token): bool
    {
        return hash_equals(config('services.xendit.callback_token'), $token);
    }
}