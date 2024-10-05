<?php

namespace App\Livewire;

use App\Models\LiveConsultation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class LiveConsultationsTable extends LivewireTableComponent
{
    protected $model = LiveConsultation::class;

    public string $tableName = 'live-consultations';

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'live_consultations.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['live_consultations.components.filter', LiveConsultation::status];

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeStatusFilter'];

    public string $statusFilter = '';

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
            if ($column->isField('status')) {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function placeholder()
    {
          return view('livewire.live_consultations_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.live_consultation.consultation_title'),
                'consultation_title')->view('live_consultations.components.title')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.date'),
                'consultation_date')->view('live_consultations.components.consultation_date')
                ->sortable(),
            Column::make(__('messages.live_consultation.created_by'),
                'user.first_name')->view('live_consultations.components.created_by')
                ->sortable(function (Builder $query, $direction) {
                    return $query->orderBy(User::select('first_name')->whereColumn('users.id', 'created_by'),
                        $direction);
                })->searchable(),
            Column::make(__('messages.live_consultation.created_for'),
                'doctor.user.first_name')->view('live_consultations.components.doctor'),
            Column::make(__('messages.appointment.patient'),
                'patient_id')->view('live_consultations.components.patient'),
            Column::make(__('messages.doctor.status'), 'status')->view('live_consultations.components.status'),
            Column::make(__('messages.patient.password'), 'password')->view('live_consultations.components.password')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('live_consultations.components.action'),
        ];
    }

    public function changeStatusFilter($value)
    {
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function builder(): Builder
    {
        $query = LiveConsultation::with('patient.user', 'doctor.user', 'user')->select('live_consultations.*');

        $query->when($this->statusFilter !== '' && $this->statusFilter != LiveConsultation::ALL,
            function (Builder $query) {
                $query->where('live_consultations.status', $this->statusFilter);
            });

        if (getLogInUser()->hasRole('patient')) {
            $query->where('live_consultations.patient_id', getLoginUser()->patient->id)->select('live_consultations.*');
        }

        if (getLogInUser()->hasRole('doctor')) {
            $query->where('live_consultations.doctor_id', getLoginUser()->doctor->id)->select('live_consultations.*');
        }

        return $query;
    }

    public function resetPagination()
    {
        $this->resetPage('live-consultationsPage');
    }
}
