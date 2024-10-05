<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class PatientDashboardTable extends Component
{
   public function placeholder()
   {
      return view('livewire.patient_dashboard_skeleton');
   }
   public function render()
   {
      return view('livewire.patient-dashboard-table');
   }
}
