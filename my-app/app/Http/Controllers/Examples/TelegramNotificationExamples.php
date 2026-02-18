<?php

/**
 * EJEMPLOS DE USO DEL SISTEMA DE NOTIFICACIONES DE TELEGRAM
 * 
 * Estos ejemplos muestran cómo usar el TelegramService en tus controladores
 * y otros puntos de entrada de la aplicación.
 */

namespace App\Http\Controllers\Examples;

use App\Services\TelegramService;
use App\Models\User;
use Illuminate\Http\Request;

class TelegramNotificationExamples
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * EJEMPLO 1: Notificación automática al crear un usuario
     * (Los Observers hacen esto automáticamente, pero puedes ver cómo funciona)
     */
    public function createUserExample()
    {
        $user = User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => bcrypt('password123')
        ]);
        
        // El UserObserver captura automáticamente esto y envía notificación
        // ✅ No necesitas escribir nada más aquí
        
        return response()->json(['message' => 'Usuario creado y notificación enviada']);
    }

    /**
     * EJEMPLO 2: Notificación personalizada desde un controlador
     */
    public function sendCustomNotification()
    {
        $user = User::find(1);
        
        // Envía una notificación personalizada
        $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "📱 <b>Notificación Personalizada</b>\n\nEl usuario {$user->name} ha realizado una acción especial."
        );
        
        return response()->json(['message' => 'Notificación enviada manualmente']);
    }

    /**
     * EJEMPLO 3: Notificar eventos especiales (como pagos)
     */
    public function processPaymentExample(Request $request)
    {
        // ... proceso de pago ...
        $paymentAmount = 99.99;
        
        $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "💳 <b>Nuevo Pago Procesado</b>\n\n" .
            "💰 <b>Monto:</b> €{$paymentAmount}\n" .
            "👤 <b>Usuario:</b> {$request->user()->name}\n" .
            "⏰ <b>Fecha:</b> " . now()->format('Y-m-d H:i:s') . "\n" .
            "✅ <b>Estado:</b> Completado"
        );
    }

    /**
     * EJEMPLO 4: Notificar errores críticos
     */
    public function reportErrorExample(\Exception $e)
    {
        $this->telegramService->notifyError(
            $e->getMessage(),
            "Línea: " . $e->getLine() . " - Archivo: " . $e->getFile()
        );
    }

    /**
     * EJEMPLO 5: Notificación en un background job
     */
    public function jobNotificationExample()
    {
        // En un Job (app/Jobs/SomeJob.php):
        // 
        // use App\Services\TelegramService;
        // 
        // class SomeJob implements ShouldQueue
        // {
        //     public function handle(TelegramService $telegramService)
        //     {
        //         // Haz algo...
        //         
        //         // Notifica al completar
        //         $telegramService->sendMessage(
        //             env('TELEGRAM_CHAT_ID'),
        //             "✅ <b>Job Completado</b>\n\nEl job se ejecutó correctamente."
        //         );
        //     }
        // }
    }

    /**
     * EJEMPLO 6: Enviar mensaje a chat específico
     */
    public function sendToSpecificChat()
    {
        $adminChatId = env('TELEGRAM_CHAT_ID');
        $userChatId = '123456789'; // ID de chat de un usuario específico
        
        // Mensaje al administrador
        $this->telegramService->sendMessage(
            $adminChatId,
            "📊 <b>Reporte para Admin</b>"
        );
        
        // Mensaje a un usuario específico
        $this->telegramService->sendMessage(
            $userChatId,
            "👋 <b>Hola!</b> Tu cuenta ha sido creada."
        );
    }

    /**
     * EJEMPLO 7: Usar en rutas
     */
    public function routeExample()
    {
        // En routes/web.php:
        // 
        // Route::post('/notify', function (TelegramService $telegram) {
        //     $telegram->sendMessage(
        //         env('TELEGRAM_CHAT_ID'),
        //         "📨 Nueva notificación desde ruta"
        //     );
        //     return 'Enviado';
        // });
    }
}

/**
 * GUÍA DE INYECCIÓN DE DEPENDENCIAS
 * 
 * El TelegramService se puede inyectar en:
 * 
 * 1. CONTROLADORES
 *    public function __construct(TelegramService $telegram) { ... }
 * 
 * 2. JOBS
 *    public function handle(TelegramService $telegram) { ... }
 * 
 * 3. LISTENERS DE EVENTOS
 *    public function handle(SomeEvent $event, TelegramService $telegram) { ... }
 * 
 * 4. COMANDOS ARTISAN
 *    public function handle(TelegramService $telegram) { ... }
 * 
 * 5. FUNCIONES GLOBALES (usa app() o resolve())
 *    app(TelegramService::class)->sendMessage(...);
 */

/**
 * RESUMEN DE MÉTODOS DISPONIBLES
 * 
 * 1. sendMessage($chatId, $message, $parseMode = 'HTML')
 *    Envía un mensaje genérico
 * 
 * 2. notifyCreation($record, $modelName = 'Registro')
 *    Notifica creación de registro
 * 
 * 3. notifyUpdate($record, $modelName = 'Registro')
 *    Notifica actualización de registro
 * 
 * 4. notifyDeletion($record, $modelName = 'Registro')
 *    Notifica eliminación de registro
 * 
 * 5. notifyError($errorMessage, $context = '')
 *    Notifica errores
 */
