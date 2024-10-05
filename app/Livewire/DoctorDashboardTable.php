<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorDashboardTable extends Component
{
   public function placeholder()
   {
      return view('livewire.doctor_dashboard_skeleton');
   }
   public function render()
   {
      return view('livewire.doctor-dashboard-table');
   }
}
