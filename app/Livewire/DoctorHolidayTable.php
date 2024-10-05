<?php

namespace App\Livewire;

use App\Models\DoctorHoliday;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorHolidayTable extends LivewireTableComponent
{
    protected $model = DoctorHoliday::class;

    public bool $showButtonOnHeader = true;

    protected string $tableName = 'holidays';

    public string $buttonComponent = 'doctor_holiday.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['doctor_holiday.components.filter', []];

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeDateFilter'];

    public string $dateFilter = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    /**
     * @var string[]
     */
    public function changeDateFilter($date)
    {
        $this->dateFilter = $date;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function placeholder()
    {
          return view('livewire.doctor_holiday_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.visit.doctor'), 'doctor.doctorUser.first_name')
                ->view('doctor_holiday.components.doctor')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('doctor.doctorUser', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.visit.doctor'), 'doctor.doctorUser.email')
                ->hideIf('doctor.doctorUser.email')
                ->searchable(),
            Column::make(__('messages.web.reason'), 'name')->view('doctor_holiday.components.reason')
                ->sortable(),
            Column::make(__('messages.holiday.holiday_date'), 'date')->view('doctor_holiday.components.holiday_date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('doctor_holiday.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = DoctorHoliday::with('doctor')->select('doctor_holidays.*');
        if ($this->dateFilter != '' && $this->dateFilter != getWeekDate()) {
            $timeEntryDate = explode(' - ', $this->dateFilter);
            $startDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('d/m/Y', $timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        } else {
            $timeEntryDate = explode(' - ', getWeekDate());
            $startDate = Carbon::parse($timeEntryDate[0])->format('Y-m-d');
            $endDate = Carbon::parse($timeEntryDate[1])->format('Y-m-d');
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        return $query;
    }

    public function resetPagination()
    {
        $this->resetPage('holidaysPage');
    }
}