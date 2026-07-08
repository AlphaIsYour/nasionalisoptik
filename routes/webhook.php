<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

// Xendit Webhook (No CSRF, No Auth)
Route::post('/xendit/invoice', [WebhookController::class, 'xenditInvoice']);