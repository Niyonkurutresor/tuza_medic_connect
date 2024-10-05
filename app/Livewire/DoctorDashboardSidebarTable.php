<?php

namespace App\Livewire;

use App\Models\Appointment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorDashboardSidebarTable extends Component
{
   public $totalAppointmentCount;
   public $todayAppointmentCount;
   public $upcomingAppointmentCount;

   public function mount()
   {
      $doctorId = getLogInUser()->doctor->id;
      $todayDate = Carbon::now()->format('Y-m-d');
      $this->totalAppointmentCount = Appointment::whereDoctorId($doctorId)->whereNotIn(
         'status',
         [Appointment::CANCELLED]
      )->count();
      $this->todayAppointmentCount = Appointment::whereDoctorId($doctorId)->where(
         'date',
         '=',
         $todayDate
      )->whereNotIn('status', [Appointment::CANCELLED])->count();
      $this->upcomingAppointmentCount = Appointment::whereDoctorId($doctorId)->where(
         'date',
         '>',
         $todayDate
      )->whereStatus(Appointment::BOOKED)->count();
   }

   public function placeholder()
   {
      return view('livewire.doctor_dashboard_sidebar_skeleton');
   }
   public function render()
   {
      return view('livewire.doctor-dashboard-sidebar-table');
   }
}
