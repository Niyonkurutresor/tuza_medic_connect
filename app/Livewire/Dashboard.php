<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Setting;
use App\Models\User;
use App\Repositories\DashboardRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\Lazy;

#[Lazy]
class Dashboard extends Component
{

   public $totalDoctorCount;
   public $totalPatientCount;
   public $todayAppointmentCount;
   public $totalRegisteredPatientCount;

   public function mount()
   {
        $this->totalDoctorCount = User::toBase()->whereType(User::DOCTOR)->where('status', User::ACTIVE)->count();
        $this->totalPatientCount = User::toBase()->whereType(User::PATIENT)->count();
        $this->todayAppointmentCount = Appointment::toBase()->where('date', Carbon::now()->format('Y-m-d'))->whereStatus(Appointment::BOOKED)->count();
        $this->totalRegisteredPatientCount = User::toBase()->whereType(User::PATIENT)->whereRaw('Date(created_at) = CURDATE()')->count();
   }

   public function placeholder()
   {
         return view('livewire.dashboard_skeleton');
   }

   public function render(): View
   {
       return view('livewire.dashboard');
   }

}
