<?php

namespace App\Observers;

use App\Models\EntityName;
use App\Services\TelegramService;

class EntityNameObserver
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the EntityName "created" event.
     */
    public function created(EntityName $entity): void
    {
        try {
            $this->telegramService->notifyCreation($entity, 'Entidad');
        } catch (\Exception $e) {
            \Log::error('Error en EntityNameObserver created: ' . $e->getMessage());
        }
    }

    /**
     * Handle the EntityName "updated" event.
     */
    public function updated(EntityName $entity): void
    {
        try {
            $this->telegramService->notifyUpdate($entity, 'Entidad');
        } catch (\Exception $e) {
            \Log::error('Error en EntityNameObserver updated: ' . $e->getMessage());
        }
    }

    /**
     * Handle the EntityName "deleted" event.
     */
    public function deleted(EntityName $entity): void
    {
        try {
            $this->telegramService->notifyDeletion($entity, 'Entidad');
        } catch (\Exception $e) {
            \Log::error('Error en EntityNameObserver deleted: ' . $e->getMessage());
        }
    }
}
