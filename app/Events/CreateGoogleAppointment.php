<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateGoogleAppointment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $forPatient;

    public $appointmentID;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($forPatient, $appointmentID)
    {
        $this->forPatient = $forPatient;
        $this->appointmentID = $appointmentID;
    }
}
