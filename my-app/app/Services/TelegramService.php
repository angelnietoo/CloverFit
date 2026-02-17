<?php

namespace App\Services;

use Telegram\Bot\Api;

class TelegramService
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    // Enviar mensaje
    public function sendMessage($chat_id, $message)
    {
        $this->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $message
        ]);
    }

    // Notificación por creación de un registro
    public function notifyCreation($record)
    {
        $message = "Nuevo registro creado: " . $record->name; 
        $this->sendMessage(env('TELEGRAM_CHAT_ID'), $message);
    }

    // Notificación por borrado de un registro
    public function notifyDeletion($record)
    {
        $message = "Registro eliminado: " . $record->name; 
        $this->sendMessage(env('TELEGRAM_CHAT_ID'), $message);
    }
}
