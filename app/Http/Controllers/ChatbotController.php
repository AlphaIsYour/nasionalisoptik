<?php

namespace App\Http\Controllers;

use App\Services\GroqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    protected GroqService $groqService;

    public function __construct(GroqService $groqService)
    {
        $this->groqService = $groqService;
    }

    public function chat(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:500',
        ]);

        try {
            // Get product context
            $context = $this->groqService->getProductContext();

            // Get AI response
            $response = $this->groqService->chat($validated['message'], $context);

            // Debug log
            Log::info('Chatbot Request:', ['message' => $validated['message']]);
            Log::info('Chatbot Response:', $response);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Chatbot Controller Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan sistem.',
            ], 500);
        }
    }
}