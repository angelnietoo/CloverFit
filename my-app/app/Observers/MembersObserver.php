<?php

namespace App\Observers;

use App\Models\members;
use App\Services\TelegramService;

class MembersObserver
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Handle the members "created" event.
     */
    public function created(members $member): void
    {
        try {
            $this->telegramService->notifyCreation($member, 'Miembro');
        } catch (\Exception $e) {
            \Log::error('Error en MembersObserver created: ' . $e->getMessage());
        }
    }

    /**
     * Handle the members "updated" event.
     */
    public function updated(members $member): void
    {
        try {
            $this->telegramService->notifyUpdate($member, 'Miembro');
        } catch (\Exception $e) {
            \Log::error('Error en MembersObserver updated: ' . $e->getMessage());
        }
    }

    /**
     * Handle the members "deleted" event.
     */
    public function deleted(members $member): void
    {
        try {
            $this->telegramService->notifyDeletion($member, 'Miembro');
        } catch (\Exception $e) {
            \Log::error('Error en MembersObserver deleted: ' . $e->getMessage());
        }
    }
}
