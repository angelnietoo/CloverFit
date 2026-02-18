<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TelegramService;

class TestTelegramNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:test {--type=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prueba el sistema de notificaciones de Telegram';

    protected $telegramService;

    /**
     * Execute the console command.
     */
    public function handle(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;

        $this->info('🤖 Probando Sistema de Notificaciones de Telegram...');
        $this->newLine();

        // Mostrar estado de la configuración
        $this->info('📋 Estado de la configuración:');
        $status = $this->telegramService->getConfigurationStatus();
        
        $this->table(
            ['Parámetro', 'Estado'],
            [
                ['Bot inicializado', $status['bot_initialized'] ? '✓ Sí' : '✗ No'],
                ['Token configurado', $status['token_configured'] ? '✓ Sí' : '✗ No'],
                ['Chat ID configurado', $status['chat_id']],
            ]
        );
        $this->newLine();

        // Validar configuración
        if (!$status['bot_initialized'] || !$status['chat_id_configured']) {
            $this->error('❌ La configuración de Telegram NO está completa.');
            $this->line('');
            $this->info('💡 Para configurar Telegram:');
            $this->line('1. Abre tu archivo .env');
            $this->line('2. Agrega o actualiza estas variables:');
            $this->line('   TELEGRAM_BOT_TOKEN=tu_token_aqui');
            $this->line('   TELEGRAM_CHAT_ID=tu_chat_id_aqui');
            $this->line('');
            $this->info('📚 Pasos para obtener el token y chat ID:');
            $this->line('1. Abre @BotFather en Telegram: https://t.me/botfather');
            $this->line('2. Crea un nuevo bot con /newbot');
            $this->line('3. Copia el token (TELEGRAM_BOT_TOKEN)');
            $this->line('4. Para obtener TELEGRAM_CHAT_ID:');
            $this->line('   - Envía un mensaje a tu bot');
            $this->line('   - Accede a: https://api.telegram.org/bot{TOKEN}/getUpdates');
            $this->line('   - Busca "chat":{"id":NUMERO} - ese es tu CHAT_ID');
            return 1;
        }

        $type = $this->option('type');

        match($type) {
            'creation' => $this->testCreation(),
            'update' => $this->testUpdate(),
            'deletion' => $this->testDeletion(),
            'error' => $this->testError(),
            'custom' => $this->testCustom(),
            'all' => $this->testAll(),
            default => $this->error("Tipo de prueba no reconocido: {$type}")
        };

        return 0;
    }

    private function testCreation()
    {
        $this->info('📤 Enviando notificación de CREACIÓN...');

        $result = $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "✅ <b>Test de Creación</b>\n\n" .
            "🧪 Este es un mensaje de prueba para validar el sistema de notificaciones.\n" .
            "📌 <b>Tipo:</b> Creación de Registro\n" .
            "⏰ <b>Fecha:</b> " . now()->format('Y-m-d H:i:s') . "\n" .
            "🌐 <b>Aplicación:</b> CloverFit"
        );

        if ($result) {
            $this->line('<fg=green>✓</> Mensaje enviado exitosamente!');
        } else {
            $this->line('<fg=red>✗</> Error al enviar mensaje. Revisa los logs.');
        }
    }

    private function testUpdate()
    {
        $this->info('📤 Enviando notificación de ACTUALIZACIÓN...');

        $result = $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "🔄 <b>Test de Actualización</b>\n\n" .
            "🧪 Este es un mensaje de prueba de actualización.\n" .
            "📌 <b>Tipo:</b> Actualización de Registro\n" .
            "⏰ <b>Fecha:</b> " . now()->format('Y-m-d H:i:s') . "\n" .
            "🌐 <b>Aplicación:</b> CloverFit"
        );

        if ($result) {
            $this->line('<fg=green>✓</> Mensaje enviado exitosamente!');
        } else {
            $this->line('<fg=red>✗</> Error al enviar mensaje. Revisa los logs.');
        }
    }

    private function testDeletion()
    {
        $this->info('📤 Enviando notificación de ELIMINACIÓN...');

        $result = $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "🗑️ <b>Test de Eliminación</b>\n\n" .
            "🧪 Este es un mensaje de prueba de eliminación.\n" .
            "📌 <b>Tipo:</b> Eliminación de Registro\n" .
            "⏰ <b>Fecha:</b> " . now()->format('Y-m-d H:i:s') . "\n" .
            "🌐 <b>Aplicación:</b> CloverFit"
        );

        if ($result) {
            $this->line('<fg=green>✓</> Mensaje enviado exitosamente!');
        } else {
            $this->line('<fg=red>✗</> Error al enviar mensaje. Revisa los logs.');
        }
    }

    private function testError()
    {
        $this->info('📤 Enviando notificación de ERROR...');

        $this->telegramService->notifyError(
            'Este es un error de prueba',
            'Comando: telegram:test --type=error'
        );

        $this->line('<fg=green>✓</> Mensaje de error enviado!');
    }

    private function testCustom()
    {
        $this->info('📤 Enviando mensaje PERSONALIZADO...');

        $result = $this->telegramService->sendMessage(
            env('TELEGRAM_CHAT_ID'),
            "🎯 <b>Mensaje Personalizado de Prueba</b>\n\n" .
            "Este mensaje fue enviado desde el comando <code>telegram:test --type=custom</code>\n" .
            "⏰ <b>Hora:</b> " . now()->format('Y-m-d H:i:s')
        );

        if ($result) {
            $this->line('<fg=green>✓</> Mensaje personalizado enviado!');
        } else {
            $this->line('<fg=red>✗</> Error al enviar mensaje.');
        }
    }

    private function testAll()
    {
        $this->info('📤 Ejecutando TODAS las pruebas...');
        $this->newLine();

        $this->testCreation();
        $this->newLine();
        sleep(1); // Para evitar rate limiting

        $this->testUpdate();
        $this->newLine();
        sleep(1);

        $this->testDeletion();
        $this->newLine();
        sleep(1);

        $this->testError();
        $this->newLine();
        sleep(1);

        $this->testCustom();
        $this->newLine();

        $this->info('<fg=green>✓</> ¡TODAS las pruebas completadas!');
    }
}
