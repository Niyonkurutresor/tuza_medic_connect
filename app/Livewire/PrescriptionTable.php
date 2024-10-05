<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PrescriptionTable extends LivewireTableComponent
{
    protected $model = Prescription::class;

    public bool $showButtonOnHeader = true;

    public bool $showFilterOnHeader = true;

    public string $buttonComponent = 'prescriptions.add-button';

    public $FilterComponent = ['prescriptions.filter-button', Prescription::STATUS_ARR];

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public $appointMentId = '';

    public $doctor;

    public $patient;

    public $statusFilter = '';

    public function mount($id = null)
    {
        $this->appointMentId = $id;
        $this->doctor = getLogInUser()->hasRole('doctor') ? 1 : 0;
        $this->patient = getLogInUser()->hasRole('patient') ? 1 : 0;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('prescriptions.created_at', 'desc')
            ->setQueryStringStatus(false);

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('status')) {
                return [
                    'class' => 'p-5',
                ];
            }

            return [];
        });
    }

    public function changeFilter($value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.patients'), 'patient.patientUser.first_name')
                ->view('prescriptions.columns.patient_name')
                ->sortable()
                ->searchable()->hideIf($this->patient),
            Column::make(__('messages.prescription.patient'), 'patient_id')->hideIf(1),
            Column::make(__('messages.doctors'), 'doctor.doctorUser.first_name')
                ->view('prescriptions.columns.doctor_name')
                ->sortable()
                ->searchable()->hideIf($this->doctor),
            Column::make(__('messages.doctor_opd_charge.doctor'), 'doctor_id')->hideIf(1),
            Column::make(__('messages.prescription.medical_history'), 'medical_history')
                ->view('prescriptions.columns.medical_history')
                ->sortable(),
            Column::make(__('messages.web.status'), 'status')
                ->view('prescriptions.columns.status'),
            Column::make(__('messages.common.action'), 'id')
                ->view('prescriptions.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Prescription $query */
        if (! getLoggedinDoctor()) {
            $query = Prescription::query()->select('prescriptions.*')->with('patient', 'doctor');
        } else {
            $doctorId = Doctor::where('user_id', getLogInUserId())->first();
            $query = Prescription::query()->select('prescriptions.*')->with('patient', 'doctor')->where('doctor_id',
                $doctorId->id);
        }
        $query->when(! empty($this->appointMentId), function (Builder $q) {
            $q->whereAppointmentId($this->appointMentId);
        });
      $query->when($this->statusFilter !== '' && $this->statusFilter != Prescription::STATUS_ALL,
            function (Builder $query) {
                return $query->where('prescriptions.status', $this->statusFilter);
            });
        return $query;
    }
}
