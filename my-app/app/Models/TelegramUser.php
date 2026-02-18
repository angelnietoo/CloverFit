<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $fillable = [
        'user_id',
        'telegram_chat_id',
        'telegram_username',
        'first_name',
    ];

    /**
     * Relación con el usuario de la aplicación
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Encontrar o crear un usuario de Telegram
     */
    public static function findOrCreateFromUpdate($update)
    {
        $chatId = $update['message']['chat']['id'] ?? null;
        
        if (!$chatId) {
            return null;
        }

        return self::updateOrCreate(
            ['telegram_chat_id' => $chatId],
            [
                'telegram_username' => $update['message']['chat']['username'] ?? null,
                'first_name' => $update['message']['chat']['first_name'] ?? null,
            ]
        );
    }
}
