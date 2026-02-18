<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class TelegramWebhookController extends Controller
{
    /**
     * Recibir actualizaciones del webhook de Telegram
     */
    public function handle(Request $request)
    {
        try {
            $update = $request->all();

            Log::info('Webhook de Telegram recibido', ['update' => $update]);

            // Validar que sea un mensaje
            if (!isset($update['message'])) {
                return response()->json(['status' => 'ok']);
            }

            // Procesar el mensaje de forma asíncrona
            exec('php artisan telegram:process-webhook \'' . addslashes(json_encode($update)) . '\' > /dev/null 2>&1 &');

            return response()->json(['status' => 'ok']);
        } catch (\Exception $e) {
            Log::error('Error en webhook de Telegram: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Verificar que el webhook está activo
     */
    public function health()
    {
        return response()->json([
            'status' => 'ok',
            'bot_name' => env('TELEGRAM_BOT_USERNAME', 'bot'),
            'timestamp' => now(),
        ]);
    }
}
