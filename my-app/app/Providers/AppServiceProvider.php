<?php

namespace App\Providers;

use App\Models\User;
use App\Models\activities;
use App\Models\members;
use App\Models\EntityName;
use App\Observers\UserObserver;
use App\Observers\ActivitiesObserver;
use App\Observers\MembersObserver;
use App\Observers\EntityNameObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar Observers para notificaciones de Telegram
        User::observe(UserObserver::class);
        activities::observe(ActivitiesObserver::class);
        members::observe(MembersObserver::class);
        EntityName::observe(EntityNameObserver::class);
    }
}
