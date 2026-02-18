<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TelegramService;
use App\Models\TelegramUser;
use Illuminate\Support\Facades\Log;

class ProcessTelegramWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:process-webhook {json}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Procesa mensajes recibidos del webhook de Telegram';

    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        parent::__construct();
        $this->telegramService = $telegramService;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $json = $this->argument('json');
            $update = json_decode($json, true);

            if (!$update || !isset($update['message'])) {
                return 1;
            }

            // Extraer información del mensaje
            $chatId = $update['message']['chat']['id'];
            $messageText = $update['message']['text'] ?? '';
            
            // Guardar o actualizar el usuario de Telegram
            $telegramUser = TelegramUser::findOrCreateFromUpdate($update);

            Log::info('Mensaje recibido de Telegram', [
                'chat_id' => $chatId,
                'username' => $update['message']['chat']['username'] ?? null,
                'text' => $messageText,
            ]);

            // Procesar el mensaje
            $this->processMessage($chatId, $messageText);

            return 0;
        } catch (\Exception $e) {
            Log::error('Error procesando webhook de Telegram: ' . $e->getMessage());
            return 1;
        }
    }

    /**
     * Procesar el mensaje y responder
     */
    private function processMessage($chatId, $messageText): void
    {
        $messageText = strtolower(trim($messageText));

        // Respuestas automáticas según el mensaje
        if (in_array($messageText, ['hola', 'hi', 'hey', '/start'])) {
            $this->respondGreeting($chatId);
        } elseif (strpos($messageText, 'info') !== false || strpos($messageText, 'información') !== false) {
            $this->respondInfo($chatId);
        } elseif (strpos($messageText, 'ayuda') !== false || strpos($messageText, 'help') !== false) {
            $this->respondHelp($chatId);
        } elseif (strpos($messageText, 'horario') !== false || strpos($messageText, 'horas') !== false) {
            $this->respondSchedule($chatId);
        } else {
            $this->respondDefault($chatId);
        }
    }

    /**
     * Responder con saludo
     */
    private function respondGreeting($chatId): void
    {
        $message = "¡Hola! 👋 Bienvenido a <b>CloverFit</b>\n\n";
        $message .= "Soy tu asistente de Telegram. Puedo ayudarte con:\n\n";
        $message .= "📋 /info - Información general\n";
        $message .= "⏰ /horario - Horario de atención\n";
        $message .= "❓ /ayuda - Ayuda\n";
        $message .= "📧 /contacto - Contacto directo\n\n";
        $message .= "¿Cómo puedo ayudarte?";

        $this->telegramService->sendMessage($chatId, $message);
    }

    /**
     * Responder con información
     */
    private function respondInfo($chatId): void
    {
        $message = "ℹ️ <b>Información de CloverFit</b>\n\n";
        $message .= "📍 <b>Ubicación:</b>\n";
        $message .= "Calle Ave del Paraíso, nº6\n";
        $message .= "El Puerto de Santa María, Cádiz\n\n";
        $message .= "💪 <b>Servicios:</b>\n";
        $message .= "• Clases de fuerza\n";
        $message .= "• Yoga y estiramientos\n";
        $message .= "• Entrenamiento personalizado\n";
        $message .= "• Cardio HIIT\n\n";
        $message .= "📞 <b>Teléfono:</b> +34 600 000 000\n\n";
        $message .= "¿Necesitas más información? Escribe /ayuda";

        $this->telegramService->sendMessage($chatId, $message);
    }

    /**
     * Responder con horario
     */
    private function respondSchedule($chatId): void
    {
        $message = "⏰ <b>Horario de CloverFit</b>\n\n";
        $message .= "📅 <b>Lunes a Viernes:</b>\n";
        $message .= "08:00 - 21:00\n\n";
        $message .= "📅 <b>Sábados:</b>\n";
        $message .= "Por consulta\n\n";
        $message .= "📅 <b>Domingos:</b>\n";
        $message .= "Cerrado\n\n";
        $message .= "¿Alguna otra duda? Escribe /ayuda";

        $this->telegramService->sendMessage($chatId, $message);
    }

    /**
     * Responder con ayuda
     */
    private function respondHelp($chatId): void
    {
        $message = "❓ <b>¿Cómo puedo ayudarte?</b>\n\n";
        $message .= "Usa estos comandos:\n\n";
        $message .= "/info - Información sobre CloverFit\n";
        $message .= "/horario - Horario de atención\n";
        $message .= "/contacto - Información de contacto\n";
        $message .= "/ayuda - Este menú\n\n";
        $message .= "O simplemente escribe lo que necesites. ";
        $message .= "Si es algo urgente, puedes llamar al:\n";
        $message .= "<b>+34 600 000 000</b>";

        $this->telegramService->sendMessage($chatId, $message);
    }

    /**
     * Responder por defecto
     */
    private function respondDefault($chatId): void
    {
        $message = "👋 He recibido tu mensaje!\n\n";
        $message .= "Para obtener ayuda, puedes usar:\n\n";
        $message .= "/info - Información\n";
        $message .= "/horario - Horario\n";
        $message .= "/ayuda - Menú de ayuda\n\n";
        $message .= "Also disponible para consultas en horario de atención (Lun-Vie 08:00-21:00)";

        $this->telegramService->sendMessage($chatId, $message);
    }
}
