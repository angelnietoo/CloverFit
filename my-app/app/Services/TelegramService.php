<?php

namespace App\Services;

use Telegram\Bot\BotsManager;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as GuzzleClient;

class TelegramService
{
    protected $telegram;
    protected $chatId;

    public function __construct(BotsManager $botsManager)
    {
        try {
            // Obtener el bot con las opciones de configuración
            $this->telegram = $botsManager->bot();
            $this->chatId = env('TELEGRAM_CHAT_ID');
            
            // Configurar opciones de Guzzle para el cliente HTTP
            $this->configureHttpClient();
            
            if (empty($this->chatId)) {
                Log::warning('TELEGRAM_CHAT_ID no está configurado en .env');
            }
        } catch (\Exception $e) {
            Log::error('Error inicializando Telegram Bot: ' . $e->getMessage());
            $this->telegram = null;
        }
    }

    /**
     * Configurar las opciones del cliente HTTP
     */
    protected function configureHttpClient()
    {
        try {
            // Obtener las opciones configuradas
            $options = config('telegram.http_client_options', [
                'verify' => env('TELEGRAM_VERIFY_SSL', true),
                'timeout' => 30,
            ]);

            // Si el cliente HTTP tiene un método para establecer opciones, úsalo
            if (method_exists($this->telegram, 'getHttpClientHandler')) {
                $handler = $this->telegram->getHttpClientHandler();
                if ($handler instanceof GuzzleClient) {
                    // Las opciones ya se aplican a nivel de cliente
                }
            }
        } catch (\Exception $e) {
            Log::debug('No se pudieron configurar opciones de HTTP: ' . $e->getMessage());
        }
    }

    /**
     * Enviar un mensaje a Telegram
     */
    public function sendMessage($chatId, $message, $parseMode = 'HTML')
    {
        if (!$this->telegram || empty($chatId)) {
            Log::warning('Telegram no está configurado correctamente o chatId es vacío');
            return false;
        }

        try {
            // Configurar opciones de Guzzle para esta solicitud
            $options = [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => $parseMode
            ];

            $this->telegram->sendMessage($options);
            
            Log::debug('Mensaje de Telegram enviado a ' . $chatId);
            return true;
        } catch (TelegramResponseException $e) {
            Log::error('Error enviando mensaje a Telegram (Response): ' . $e->getMessage());
            return false;
        } catch (\Exception $e) {
            // Intentar extraer el mensaje de error real
            $errorMessage = $e->getMessage();
            
            // Si es un error de SSL en Windows, intentar nuevamente sin verificación
            if (stripos($errorMessage, 'SSL') !== false || stripos($errorMessage, 'certificate') !== false) {
                Log::warning('Error SSL detectado, intentando sin verificación SSL');
                // Actualizar configuración para deshabilitar SSL
                return $this->sendMessageWithoutSSLVerification($chatId, $message, $parseMode);
            }
            
            Log::error('Error inesperado enviando mensaje a Telegram: ' . $errorMessage);
            return false;
        }
    }

    /**
     * Enviar mensaje sin verificación SSL (para desarrollo)
     */
    protected function sendMessageWithoutSSLVerification($chatId, $message, $parseMode = 'HTML')
    {
        try {
            $token = env('TELEGRAM_BOT_TOKEN');
            
            // Usar cURL directamente como fallback
            $url = "https://api.telegram.org/bot{$token}/sendMessage";
            
            $data = [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => $parseMode
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            
            // IMPORTANTE: Deshabilitar verificación SSL solo para desarrollo
            if (env('APP_ENV') == 'local') {
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            }

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($httpCode >= 200 && $httpCode < 300) {
                Log::debug('Mensaje de Telegram enviado a ' . $chatId . ' (fallback)');
                return true;
            } else {
                Log::error('Error HTTP ' . $httpCode . ' al enviar a Telegram: ' . $curlError);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('Error en fallback de SSL: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Notificación por creación de un registro
     */
    public function notifyCreation($record, $modelName = 'Registro')
    {
        try {
            if (!$this->validateConfiguration()) {
                return false;
            }

            $recordId = $record->id ?? 'N/A';
            $recordName = $record->name ?? $record->title ?? 'Sin nombre';
            $timestamp = now()->format('Y-m-d H:i:s');
            $modelClass = class_basename(get_class($record));

            $message = "✅ <b>Nuevo {$modelName} Creado</b>\n\n";
            $message .= "📌 <b>ID:</b> {$recordId}\n";
            $message .= "📝 <b>Nombre:</b> {$recordName}\n";
            $message .= "📊 <b>Modelo:</b> {$modelClass}\n";
            $message .= "⏰ <b>Fecha:</b> {$timestamp}\n";
            $message .= "🌐 <b>Aplicación:</b> CloverFit";

            return $this->sendMessage($this->chatId, $message);
        } catch (\Exception $e) {
            Log::error('Error en notifyCreation: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Notificación por actualización de un registro
     */
    public function notifyUpdate($record, $modelName = 'Registro')
    {
        try {
            if (!$this->validateConfiguration()) {
                return false;
            }

            $recordId = $record->id ?? 'N/A';
            $recordName = $record->name ?? $record->title ?? 'Sin nombre';
            $timestamp = now()->format('Y-m-d H:i:s');
            $modelClass = class_basename(get_class($record));

            $message = "🔄 <b>{$modelName} Actualizado</b>\n\n";
            $message .= "📌 <b>ID:</b> {$recordId}\n";
            $message .= "📝 <b>Nombre:</b> {$recordName}\n";
            $message .= "📊 <b>Modelo:</b> {$modelClass}\n";
            $message .= "⏰ <b>Fecha:</b> {$timestamp}\n";
            $message .= "🌐 <b>Aplicación:</b> CloverFit";

            return $this->sendMessage($this->chatId, $message);
        } catch (\Exception $e) {
            Log::error('Error en notifyUpdate: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Notificación por eliminación de un registro
     */
    public function notifyDeletion($record, $modelName = 'Registro')
    {
        try {
            if (!$this->validateConfiguration()) {
                return false;
            }

            $recordId = $record->id ?? 'N/A';
            $recordName = $record->name ?? $record->title ?? 'Sin nombre';
            $timestamp = now()->format('Y-m-d H:i:s');
            $modelClass = class_basename(get_class($record));

            $message = "🗑️ <b>{$modelName} Eliminado</b>\n\n";
            $message .= "📌 <b>ID:</b> {$recordId}\n";
            $message .= "📝 <b>Nombre:</b> {$recordName}\n";
            $message .= "📊 <b>Modelo:</b> {$modelClass}\n";
            $message .= "⏰ <b>Fecha:</b> {$timestamp}\n";
            $message .= "🌐 <b>Aplicación:</b> CloverFit";

            return $this->sendMessage($this->chatId, $message);
        } catch (\Exception $e) {
            Log::error('Error en notifyDeletion: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Validar que la configuración de Telegram esté completa
     */
    protected function validateConfiguration()
    {
        if (!$this->telegram) {
            Log::error('Telegram Bot no está inicializado correctamente');
            return false;
        }

        if (empty($this->chatId)) {
            Log::error('TELEGRAM_CHAT_ID no está configurado. Agregalo a tu archivo .env');
            return false;
        }

        return true;
    }

    /**
     * Obtener el estado actual de la configuración de Telegram
     */
    public function getConfigurationStatus()
    {
        return [
            'bot_initialized' => $this->telegram !== null,
            'chat_id_configured' => !empty($this->chatId),
            'chat_id' => $this->chatId ? '✓ Configurado' : '✗ NO CONFIGURADO',
            'token_configured' => !empty(env('TELEGRAM_BOT_TOKEN')),
        ];
    }
}
