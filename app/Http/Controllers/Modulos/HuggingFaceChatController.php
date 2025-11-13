<?php

namespace App\Http\Controllers\Modulos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HuggingFaceChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string'
        ]);

        $mensaje = $request->input('mensaje');
        $token = config('services.huggingface.token');
        $model = config('services.huggingface.model');

        if (!$model) {
            return response()->json(['error' => 'No hay modelo configurado. Añade HF_MODEL en tu archivo .env'], 500);
        }

        if (!$token) {
            return response()->json(['error' => 'Token de Hugging Face no configurado.'], 500);
        }

        try {
            $response = Http::timeout(60)
                ->withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ])
                ->post('https://router.huggingface.co/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $mensaje
                        ]
                    ]
                ]);

            if (!$response->successful()) {
                \Log::warning('HF API error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return response()->json([
                    'error' => 'Error de Hugging Face (HTTP ' . $response->status() . '): ' . $response->body()
                ], 500);
            }

            $body = $response->json();

            // Extraer la respuesta generada
            $reply = $body['choices'][0]['message']['content'] ?? 'No tengo respuesta 😅';

            return response()->json(['respuesta' => $reply]);

        } catch (\Exception $e) {
            \Log::error('HF chat exception', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
