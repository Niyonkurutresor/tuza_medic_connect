<?php

namespace App\Livewire;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class SpecializationTable extends LivewireTableComponent
{
    protected $model = Specialization::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'specializations.components.add_button';

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

    public function placeholder()
    {
         return view('livewire.smart_patient_cards_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')->view('specializations.components.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('specializations.components.action'),
        ];
    }

    public function builder(): Builder
    {
        return Specialization::query();
    }
}
