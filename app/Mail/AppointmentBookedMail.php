<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class AppointmentBookedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        $email = $this->data['email'];
        $password = $this->data['original_password'] ?? null;
        $patientId = $this->data['patient_id'];
        $appointmentUniqueId = Crypt::encryptString($this->data['appointment_unique_id']);
        $name = $this->data['first_name'].' '.$this->data['last_name'];
        $time = $this->data['original_from_time'].' - '.$this->data['original_to_time'];
        $date = Carbon::createFromFormat('Y-m-d', $this->data['date'])->format('dS,M Y');
        $subject = 'Appointment Booked SuccessFully';

        return $this->view('emails.appointment_booked_mail',
            compact('email', 'password', 'name', 'time', 'date', 'patientId', 'appointmentUniqueId'))
            ->markdown('emails.appointment_booked_mail')
            ->subject($subject);
    }
}
