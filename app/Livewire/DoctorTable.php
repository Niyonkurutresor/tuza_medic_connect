<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorTable extends LivewireTableComponent
{
    protected $model = Doctor::class;

    public string $tableName = 'doctors';

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'doctors.components.add_button';

    public bool $showFilterOnHeader = true;

    public array $FilterComponent = ['doctors.components.status_filter', User::STATUS];

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

            return [];
        });
    }

    public function builder(): Builder
    {
        $query = Doctor::with(['user', 'specializations', 'reviews'])->select('doctors.*');

        $query->when($this->statusFilter != '' && $this->statusFilter != User::ALL,
            function (Builder $query) {
                return $query->whereHas('user', function (Builder $q) {
                    $q->where('status', $this->statusFilter);
                });
            });

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.doctor.doctor'), 'user.first_name')->view('doctors.components.doctor_name')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.visit.doctor'), 'user.email')
                ->hideIf('user.email')
                ->searchable(),
            Column::make(__('messages.doctor.status'), 'user.status')->view('doctors.components.status')->sortable(),
            Column::make(__('messages.common.email_verified'), 'user.email_verified_at')->view('doctors.components.email_verified')
                ->sortable(),
            Column::make(__('messages.common.impersonate'), 'user.status')->view('doctors.components.impersonate'),
            Column::make(__('messages.patient.registered_on'), 'created_at')->view('doctors.components.registered_on')->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('doctors.components.action'),
        ];
    }

    public function placeholder()
    {
          return view('livewire.listing_skeleton');
    }

    public function changeStatusFilter($value): void
    {
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function resetPagination()
    {
        $this->resetPage('doctorsPage');
    }
}
