<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Service;
use Livewire\Attributes\Lazy;

#[Lazy]
class TransactionTable extends LivewireTableComponent
{
    protected $model = Transaction::class;
    public string $tableName = 'transactions';
    public $paymentType;
    public $statusType;
    public $doctorType;
    public $serviceType;
    public string $dateFilter = '';
    protected $listeners = ['refresh' => '$refresh', 'resetPage','statusFilter','paymentFilter','doctorFilter','serviceFilter','changeDateFilter'];
    public array $FilterComponent = ['transactions.components.filter', Appointment::PAYMENT_METHOD, Transaction::PAYMENT_STATUS];
    public bool $showFilterOnHeader = true;
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
            if ($column->isField('amount')) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [];
        });

    }

    public function builder(): Builder
    {
        $query = Transaction::with(['user.patient','appointment']);

        $query->when($this->paymentType != '',
            function (Builder $q) {
                $q->where('transactions.type', '=', $this->paymentType);
            });
        $query->when($this->statusType != '',
            function (Builder $q) {
                $q->where('transactions.status', '=', $this->statusType);
            });
        $query->when($this->serviceType != '',function (Builder $q) {
            $q->whereHas('appointment', function ($q){
                $q->whereHas('services', function ($subQuery) {
                    $subQuery->where('service_id', $this->serviceType);
                });
            });
        });
        $query->when($this->doctorType != '',function (Builder $q) {
            $q->whereHas('appointment', function ($q){
                $q->where('doctor_id',$this->doctorType);
                $q->whereHas('services', function ($subQuery) {
                    $subQuery->where('service_id', $this->serviceType);
                });
            });
        });

        // date filter

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
                $startDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
                $endDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[1])->format('Y-m-d');
                $query->whereDate('transactions.created_at','>=', $startDate);
                $query->whereDate('transactions.created_at','<=', $endDate);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
                $query->whereDate('transactions.created_at','>=', $startDate);
                $query->whereDate('transactions.created_at','<=', $endDate);
        }

        return $query->select('transactions.*');

    }

    public function placeholder()
    {
        return view('livewire.transaction_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.appointment.patient'), 'user.first_name')->view('transactions.components.patient')
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
            Column::make(__('messages.appointment.date'), 'created_at')->view('transactions.components.date')
                ->sortable(),
            Column::make(__('messages.appointment.payment_method'), 'type')->view('transactions.components.payment_method'),
            Column::make(__('messages.appointment.appointment_status'), 'id')
                ->format(function ($value, $row) {
                    return view('transactions.components.appointment_status')
                        ->with([
                            'row' => $row,
                            'book' => Appointment::BOOKED,
                            'checkIn' => Appointment::CHECK_IN,
                            'checkOut' => Appointment::CHECK_OUT,
                            'cancel' => Appointment::CANCELLED,
                        ]);
                }),
            Column::make(__('messages.doctor_appointment.amount'), 'amount')->view('transactions.components.amount')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('transactions.components.action'),
        ];
    }

    public function doctorFilter($doctorType)
    {
        $this->doctorType = $doctorType;
        $this->setBuilder($this->builder());
        $this->resetPagination();

    }

    public function serviceFilter($serviceType)
    {
        $this->serviceType = $serviceType;
        $this->setBuilder($this->builder());

        $services = Service::with('serviceDoctors.user')->where('id',$serviceType)->get();
        $userName = [];
        foreach ($services as $service) {
            foreach ($service->serviceDoctors as $doctor) {
                $userName[$doctor->id] = $doctor->user->full_name;
            }
        }
        $this->dispatch('update-item', data: $userName);
    }

    public function paymentFilter($pType)
    {
        $this->paymentType = $pType;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }


    public function statusFilter($statusType)
    {
        $this->statusType = $statusType;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }



    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function resetPagination()
    {
        $this->resetPage('transactionsPage');
    }

}