<?php

namespace App\Livewire;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class PatientDashboardSidebarTable extends Component
{

   public $todayAppointmentCount;
   public $upcomingAppointmentCount;
   public $pastCompletedAppointmentCount;
   public $completedAppointmentCount;
   public $todayAppointment;
   public $upcomingAppointment;

   public function mount()
   {
      $todayDate = Carbon::now()->format('Y-m-d');
      $patientId = getLogInUser()->patient->id;
      $todayCompleted = Appointment::wherePatientId($patientId)->where(
         'date',
         '=',
         $todayDate
      )->whereStatus(Appointment::CHECK_OUT)->count();
      $this->todayAppointmentCount = Appointment::wherePatientId($patientId)->where(
         'date',
         '=',
         $todayDate
      )->count();
      $this->upcomingAppointmentCount = Appointment::wherePatientId($patientId)->where(
         'date',
         '>',
         $todayDate
      )->whereNotIn('status', [Appointment::CANCELLED])->count();
      $this->pastCompletedAppointmentCount = Appointment::wherePatientId($patientId)->where(
         'date',
         '<',
         $todayDate
      )->count();
      $this->completedAppointmentCount = $this->pastCompletedAppointmentCount + $todayCompleted;
      $this->todayAppointment = Appointment::with(['patient.user', 'doctor.user', 'services'])
         ->wherePatientId($patientId)
         ->whereStatus(Appointment::BOOKED)
         ->where('date', '=', $todayDate)
         ->orderBy('created_at', 'DESC')
         ->get();

      $this->upcomingAppointment = Appointment::with(['patient.user', 'doctor.user', 'services'])
         ->wherePatientId($patientId)
         ->whereStatus(Appointment::BOOKED)
         ->where('date', '>', $todayDate)
         ->get();
   }
   public function placeholder()
   {
      return view('livewire.patient_dashboard_sidebar_skeleton');
   }
   public function render()
   {
      return view('livewire.patient-dashboard-sidebar-table');
   }
}
