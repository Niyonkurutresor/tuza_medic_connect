<?php

namespace App\Livewire;

use App\Models\Visit;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorVisitTable extends LivewireTableComponent
{
    protected $model = Visit::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'visits.doctor_panel.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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

    /**
     *df
     */
    public function columns(): array
    {
        return [
            Column::make(__('messages.visit.patient'), 'patient.user.first_name')->view('visits.doctor_panel.components.patient')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('patient.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.visit.doctor'), 'patient.user.email')
                ->hideIf('patient.user.email')
                ->searchable(),
            Column::make(__('messages.visit.visit_date'), 'visit_date')->view('visits.doctor_panel.components.visit_date')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('visits.doctor_panel.components.action'),
        ];
    }

    public function placeholder()
    {
          return view('livewire.staff_skeleton');
    }

    public function builder(): Builder
    {
        return Visit::with(['patient.user', 'doctor.reviews'])->where('doctor_id', getLoginUser()->doctor->id)
            ->select('visits.*');
    }
}
