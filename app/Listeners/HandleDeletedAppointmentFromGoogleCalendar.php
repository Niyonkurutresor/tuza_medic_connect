<?php

namespace App\Listeners;

use App\Repositories\GoogleCalendarRepository;

class HandleDeletedAppointmentFromGoogleCalendar
{
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        /** @var GoogleCalendarRepository $repo */
        $repo = \App::make(GoogleCalendarRepository::class);
        $events = $event->events;

        $repo->destroy($events);
    }
}
