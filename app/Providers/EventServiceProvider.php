<?php

namespace App\Providers;

use App\Events\CreateGoogleAppointment;
use App\Events\DeleteAppointmentFromGoogleCalendar;
use App\Listeners\HandleCreatedGoogleAppointment;
use App\Listeners\HandleDeletedAppointmentFromGoogleCalendar;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DeleteAppointmentFromGoogleCalendar::class => [
            HandleDeletedAppointmentFromGoogleCalendar::class,
        ],
        CreateGoogleAppointment::class => [
            HandleCreatedGoogleAppointment::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
