<?php

namespace App\Observers;

use App\Models\activities;
use App\Services\TelegramService;

class ActivitiesObserver
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the activities "created" event.
     */
    public function created(activities $activity): void
    {
        try {
            $this->telegramService->notifyCreation($activity, 'Actividad');
        } catch (\Exception $e) {
            \Log::error('Error en ActivitiesObserver created: ' . $e->getMessage());
        }
    }

    /**
     * Handle the activities "updated" event.
     */
    public function updated(activities $activity): void
    {
        try {
            $this->telegramService->notifyUpdate($activity, 'Actividad');
        } catch (\Exception $e) {
            \Log::error('Error en ActivitiesObserver updated: ' . $e->getMessage());
        }
    }

    /**
     * Handle the activities "deleted" event.
     */
    public function deleted(activities $activity): void
    {
        try {
            $this->telegramService->notifyDeletion($activity, 'Actividad');
        } catch (\Exception $e) {
            \Log::error('Error en ActivitiesObserver deleted: ' . $e->getMessage());
        }
    }
}
