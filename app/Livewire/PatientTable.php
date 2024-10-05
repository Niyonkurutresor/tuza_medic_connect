<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class PatientTable extends LivewireTableComponent
{
    protected $model = Patient::class;

    public bool $showButtonOnHeader = true;

    protected string $tableName = 'patients';

    public string $buttonComponent = 'patients.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['patients.components.filter', Patient::PATIENT_FILTER];

    protected $listeners = ['refresh' => '$refresh', 'resetPage','changeDateFilter','patientChangeDateFilter'];

    public string $dateFilter = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function builder(): Builder
    {
        $query =  Patient::with(['user', 'appointments'])->withCount('appointments');

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[1])->format('Y-m-d');
            $query->whereDate('patients.created_at','>=', $startDate);
            $query->whereDate('patients.created_at','<=', $endDate);
        }
        return $query;
    }
    public function placeholder()
    {
        return view('livewire.doctor_holiday_skeleton');
    }

    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.patient.name'), 'user.first_name')->view('patients.components.name')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.patient.name'), 'user.email')
                ->hideIf('user.email')
                ->searchable(),
            Column::make(__('messages.doctor_dashboard.total_appointments'), 'id')
                ->sortable()
                ->view('patients.components.total_appointments'),
            Column::make(__('messages.common.email_verified'), 'user.email_verified_at')
                ->sortable()
                ->view('patients.components.email_verified'),
            Column::make(__('messages.common.impersonate'), 'user.first_name')->view('patients.components.impersonate'),
            Column::make(__('messages.patient.registered_on'), 'created_at')->view('patients.components.registered_on')
                ->sortable(),
            Column::make(__('messages.common.action'), 'user.id')->view('patients.components.action'),
        ];
    }

    public function resetPagination()
    {
        $this->resetPage('patientsPage');
    }
}