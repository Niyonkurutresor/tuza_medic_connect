<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteAppointmentFromGoogleCalendar
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $events;

    /**
     * Create a new event instance.
     */
    public function __construct($events, $user)
    {
        $this->events = $events;
        $this->user = $user;
    }
}
