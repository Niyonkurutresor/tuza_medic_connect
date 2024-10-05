<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Appointment;
use Carbon\Carbon;
use Flash;
use App\Repositories\PatientRepository;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\Visit;

class PatientQrCodeController extends AppBaseController
{
    private $patientRepository;

    public function __construct(PatientRepository $patientRepo)
    {
        $this->patientRepository = $patientRepo;
    }

    public function show($id)
    {
        $patient = Patient::with(['user.address', 'appointments', 'address'])->where('patient_unique_id',$id)->first();

        if (empty($id)) {
            Flash::error(__('messages.flash.patient_not_found'));

            return redirect(route('patients.index'));
        }

        $appointmentStatus = Appointment::ALL_STATUS;
        $appointment = Appointment::with('doctor')->where('patient_id', '=', $patient->id)->get();
        $visit = Visit::with(['doctor.user', 'patient.user'])->where('patient_id', '=', $patient->id)->get();
        $todayDate = Carbon::now()->format('Y-m-d');
        $data['todayAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '=',
            $todayDate)->count();
        $data['upcomingAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '>',
            $todayDate)->count();
        $data['completedAppointmentCount'] = Appointment::wherePatientId($patient['id'])->where('date', '<',
            $todayDate)->count();

        return view('fronts.patient_qr_code.show', compact('patient','appointment','appointmentStatus', 'data','visit'))->with([
            'book' => Appointment::BOOKED,
            'checkIn' => Appointment::CHECK_IN,
            'checkOut' => Appointment::CHECK_OUT,
            'cancel' => Appointment::CANCELLED,
        ]);
    }
}
