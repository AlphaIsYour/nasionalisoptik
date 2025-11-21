<?php

namespace App\Services;

use App\Models\Order;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class XenditService
{
    protected InvoiceApi $invoiceApi;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.api_key'));
        $this->invoiceApi = new InvoiceApi();
    }

    /**
     * Create Invoice for Order
     */
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
                    'addresses' => [
                        [
                            'city' => $order->city,
                            'postal_code' => $order->postal_code,
                            'street_line1' => $order->shipping_address,
                            'country' => 'ID'
                        ]
                    ]
                ],
                'items' => $items,
                'currency' => 'IDR',
                'invoice_duration' => 86400, // 24 hours
                'success_redirect_url' => route('checkout.success', $order),
                'failure_redirect_url' => route('checkout.index'),
            ]);

            $invoice = $this->invoiceApi->createInvoice($invoiceData);

            return [
                'success' => true,
                'invoice_id' => $invoice['id'],
                'invoice_url' => $invoice['invoice_url'],
                'expiry_date' => $invoice['expiry_date'],
            ];

        } catch (\Xendit\XenditSdkException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'full_error' => $e->getFullError()
            ];
        }
    }

    /**
     * Get Invoice by ID
     */
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
        }
    }

    /**
     * Verify Webhook Callback Token
     */
    public function verifyCallbackToken(string $token): bool
    {
        return hash_equals(config('services.xendit.callback_token'), $token);
    }
}