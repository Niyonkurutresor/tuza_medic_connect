<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class PatientTransactionTable extends LivewireTableComponent
{
    protected $model = Transaction::class;
    protected string $tableName = 'transactions';
    protected $listeners = ['refresh' => '$refresh', 'resetPage','statusFilter','paymentFilter','changeDateFilter'];
    public $paymentType;
    public $statusType;
    public string $dateFilter = '';
    public bool $showFilterOnHeader = true;
    public array $FilterComponent = ['transactions.components.filter', Appointment::PAYMENT_METHOD, Transaction::PAYMENT_STATUS];


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

    public function placeholder()
    {
          return view('livewire.transaction_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.appointment.date'), 'created_at')->view('transactions.patient_panel.components.date')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.payment_method'), 'type')->view('transactions.patient_panel.components.payment_method')
                ->sortable(),
            Column::make(__('messages.doctor_appointment.amount'), 'amount')->view('transactions.patient_panel.components.amount')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('transactions.patient_panel.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Transaction::where('user_id', '=', getLogInUserId());

        $query->when($this->paymentType != '',
        function (Builder $q) {
            $q->where('transactions.type', '=', $this->paymentType);
        });
        $query->when($this->statusType != '',
        function (Builder $q) {
            $q->where('transactions.status', '=', $this->statusType);
        });

        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('transactions.created_at', [$startDate, $endDate]);
        }


        return $query->select('transactions.*');
    }

    public function paymentFilter($pType)
    {
        $this->paymentType = $pType;
        $this->setBuilder($this->builder());
    }


    public function statusFilter($statusType)
    {
        $this->statusType = $statusType;
        $this->setBuilder($this->builder());
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