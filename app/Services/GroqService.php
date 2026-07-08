<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    protected string $apiKey;
    protected string $apiUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        $this->apiUrl = config('services.groq.api_url');
        $this->model = config('services.groq.model');
    }

    /**
     * Chat with Groq AI
     */
    public function chat(string $userMessage, array $context = []): array
    {
        try {
            // Build system prompt dengan context produk
            $systemPrompt = $this->buildSystemPrompt($context);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => $this->model,
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompt
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'message' => $data['choices'][0]['message']['content'] ?? 'Maaf, saya tidak bisa memproses permintaan Anda.',
                ];
            }

            Log::error('Groq API Error: ' . $response->body());
            
            return [
                'success' => false,
                'error' => 'Gagal terhubung ke AI assistant.',
            ];

        } catch (\Exception $e) {
            Log::error('Groq Service Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'error' => 'Terjadi kesalahan pada AI assistant: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Build system prompt dengan konteks toko
     */
    protected function buildSystemPrompt(array $context): string
    {
        $prompt = "Kamu adalah asisten virtual untuk Optik Nasionalis Kacamata, sebuah toko kacamata di Turen, Malang.\n\n";
        
        $prompt .= "INFORMASI TOKO:\n";
        $prompt .= "- Nama: Optik Nasionalis Kacamata\n";
        $prompt .= "- Lokasi: Jl. Panglima Sudirman 206A (Depan Bank Syariah Indonesia), Turen, Malang\n";
        $prompt .= "- Telepon: +62 813 3129 6965\n";
        $prompt .= "- Jam Operasional: Senin - Minggu, 08:00 - 19:00\n\n";
        
        $prompt .= "TUGAS KAMU:\n";
        $prompt .= "1. Bantu customer menemukan kacamata yang cocok\n";
        $prompt .= "2. Berikan rekomendasi berdasarkan bentuk wajah, gender, budget\n";
        $prompt .= "3. Cek ketersediaan produk\n";
        $prompt .= "4. Jawab pertanyaan tentang toko\n";
        $prompt .= "5. Gunakan bahasa Indonesia yang ramah dan profesional\n\n";
        
        if (!empty($context['products'])) {
            $prompt .= "PRODUK TERSEDIA:\n";
            foreach ($context['products'] as $product) {
                $prompt .= "- {$product['name']} ({$product['brand']}): Rp " . number_format($product['price'], 0, ',', '.') . " - Stock: {$product['stock']}\n";
            }
            $prompt .= "\n";
        }
        
        $prompt .= "Jawab dengan singkat, jelas, dan ramah. Jika ditanya produk spesifik, cek dulu di daftar produk yang tersedia.";
        
        return $prompt;
    }

    /**
     * Get product context for AI
     */
    public function getProductContext(): array
    {
        $products = \App\Models\Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->select('name', 'brand', 'price', 'stock', 'gender', 'shape', 'color')
            ->limit(20)
            ->get()
            ->map(function($product) {
                return [
                    'name' => $product->name,
                    'brand' => $product->brand ?? 'No Brand',
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'gender' => $product->gender ?? 'unisex',
                    'shape' => $product->shape ?? '-',
                    'color' => $product->color ?? '-',
                ];
            })
            ->toArray();

        return ['products' => $products];
    }
}