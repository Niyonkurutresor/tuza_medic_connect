<?php

namespace App\Livewire;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class PatientAppointmentTable extends LivewireTableComponent
{
    public $doctorId;

    protected $model = Appointment::class;

    public bool $showButtonOnHeader = true;

    protected string $tableName = 'appointments';

    public string $buttonComponent = 'patients.appointments.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = [
        'patients.appointments.components.filter', Appointment::PAYMENT_TYPE_ALL, Appointment::STATUS,
    ];

    protected $listeners = [
        'refresh' => '$refresh', 'resetPage', 'changeStatusFilter', 'changeDateFilter', 'changePaymentTypeFilter',
        'changePaymentStatusFilter',
    ];

    public int $statusFilter = Appointment::BOOKED;

    public string $paymentTypeFilter = '';

    public string $paymentStatusFilter = '';

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
        $query = Appointment::with([
            'doctor.user', 'services', 'transaction', 'doctor.reviews',
        ])->where('patient_id', getLoginUser()->patient->id)->select('appointments.*');

        $query->when($this->statusFilter != '' && $this->statusFilter != Appointment::ALL_STATUS,
            function (Builder $q) {
                if ($this->statusFilter != Appointment::ALL) {
                    $q->where('appointments.status', '=', $this->statusFilter);
                }
            });

        $query->when($this->paymentTypeFilter != '' && $this->paymentTypeFilter != Appointment::ALL_PAYMENT,
            function (Builder $q) {
                $q->where('appointments.payment_type', '=', $this->paymentTypeFilter);
            });

        $query->when($this->paymentStatusFilter != '',
            function (Builder $q) {
                if ($this->paymentStatusFilter != Appointment::ALL_PAYMENT) {
                    if ($this->paymentStatusFilter == Appointment::PENDING) {
                        $q->has('transaction', '=', null);
                    } elseif ($this->paymentStatusFilter == Appointment::PAID) {
                        $q->has('transaction', '!=', null);
                    }
                }
            });

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
            $query->whereBetween('appointments.date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('appointments.date', [$startDate, $endDate]);
        }

        return $query;
    }

    public function placeholder()
    {
        return view('livewire.appointment_skeleton');
    }

    public function changeStatusFilter($status)
    {
        $this->statusFilter = $status;
        $this->setBuilder($this->builder());
    }

    public function changePaymentTypeFilter($type)
    {
        $this->paymentTypeFilter = $type;
        $this->setBuilder($this->builder());
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
            Column::make(__('messages.doctor.doctor'),
                'doctor.user.first_name')->view('patients.appointments.components.doctor')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.patient.name'), 'doctor.user.email')
                ->hideIf('doctor.user.email')
                ->searchable(),
            Column::make(__('messages.appointment.appointment_at'),
                'date')->view('patients.appointments.components.appointment_at')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.service_charge'),
                'services.charges')->view('patients.appointments.components.service_charge')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment'), 'payment_type')
                ->format(function ($value, $row) {
                    return view('patients.appointments.components.payment')
                        ->with([
                            'row' => $row,
                            'paid' => Appointment::PAID,
                            'pending' => Appointment::PENDING,
                        ]);
                }),
            Column::make(__('messages.appointment.status'), 'status')->view('patients.appointments.components.status'),
            Column::make(__('messages.common.action'), 'id')
                ->format(function ($value, $row) {
                    return view('patients.appointments.components.action')
                        ->with([
                            'row' => $row,
                            'checkOut' => Appointment::CHECK_OUT,
                            'cancel' => Appointment::CANCELLED,
                        ]);
                }),
        ];
    }

    public function resetPagination()
    {
        $this->resetPage('appointmentsPage');
    }
}