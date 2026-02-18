<?php

namespace App\Observers;

use App\Models\User;
use App\Services\TelegramService;

class UserObserver
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        try {
            $this->telegramService->notifyCreation($user, 'Usuario');
        } catch (\Exception $e) {
            \Log::error('Error en UserObserver created: ' . $e->getMessage());
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        try {
            // Solo notificar si hay cambios importantes (no en remember_token, etc)
            $isDirty = $user->isDirty(['name', 'email']);
            if ($isDirty) {
                $this->telegramService->notifyUpdate($user, 'Usuario');
            }
        } catch (\Exception $e) {
            \Log::error('Error en UserObserver updated: ' . $e->getMessage());
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        try {
            $this->telegramService->notifyDeletion($user, 'Usuario');
        } catch (\Exception $e) {
            \Log::error('Error en UserObserver deleted: ' . $e->getMessage());
        }
    }
}
