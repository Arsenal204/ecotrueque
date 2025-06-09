<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function preguntar(Request $request)
    {
        $userInput = $request->input('mensaje');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openrouter.key'),
            'HTTP-Referer' => 'https://18.212.29.0:8000',
            'X-Title' => 'EcoTrueque',
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-r1:free',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres Ekoala, un asistente experto en consejos ecológicos, sostenibilidad, reciclaje y vida eco-amigable. Responde siempre con lenguaje amable, positivo y útil. Nunca hables de otro tipo de temas.'
                ],
                [
                    'role' => 'user',
                    'content' => $userInput
                ],
            ]
        ]);

        if ($response->unauthorized()) {
            return response()->json([
                'error' => 'Token inválido o cabecera faltante',
                'status' => 401
            ], 401);
        }

        return response()->json($response->json());
    }
}
