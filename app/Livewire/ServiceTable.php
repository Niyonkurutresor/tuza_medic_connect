<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class ServiceTable extends LivewireTableComponent
{
    protected $model = Service::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'services.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

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
            if (in_array($column->getField(), ['charges', 'status'], true)) {
                return [
                    'class' => 'text-end',
                ];
            }

            return [];
        });
    }

    public function placeholder()
    {
          return view('livewire.staff_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.front_service.icon'), 'category_id')->view('services.components.icon'),
            Column::make(__('messages.common.name'), 'name')->view('services.components.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.service.category'), 'serviceCategory.name')->view('services.components.category')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.appointment.service_charge'), 'charges')->view('services.components.service_charge')
                ->sortable()->searchable(),
            Column::make(__('messages.doctor.status'), 'status')->view('services.components.status')->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('services.components.action'),
        ];
    }

    public function builder(): Builder
    {
        $query = Service::with(['serviceCategory', 'media'])->select('services.*');

        $query->when($this->statusFilter !== '' && $this->statusFilter != Service::ALL,
            function (Builder $query) {
                $query->where('status', $this->statusFilter);
            });

        return $query;
    }
}
