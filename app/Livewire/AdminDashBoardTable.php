<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class AdminDashBoardTable extends Component
{
    public $data;
    public function mount(Request $request)
    {
        $this->data['patients'] = Patient::with(['user', 'appointments'])
            ->withCount('appointments')
            ->whereRaw('Date(created_at) = CURDATE()')
            ->orderBy('created_at', 'DESC')
            ->get()->toArray();
    }

    public function placeholder()
    {
        return view('livewire.dashboard_listing_table_skeleton');
    }
    public function render()
    {
        return view('livewire.admin-dash-board-table');
    }
}
