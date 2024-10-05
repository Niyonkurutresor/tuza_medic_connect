<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class PatientAppointmentBookMail extends Mailable
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
        $name = $this->data['patient_name'];
        $patientId = $this->data['patient_id'];
        $appointmentUniqueId = Crypt::encryptString($this->data['appointment_unique_id']);
        $time = $this->data['original_from_time'].' - '.$this->data['original_to_time'];
        $date = Carbon::createFromFormat('Y-m-d', $this->data['date'])->format('dS,M Y');
        $subject = 'Appointment Booked Successfully';

        return $this->view('emails.patient_appointment_booked_mail',
            compact('name', 'time', 'date', 'appointmentUniqueId', 'patientId'))
            ->markdown('emails.patient_appointment_booked_mail')
            ->subject($subject);
    }
}
