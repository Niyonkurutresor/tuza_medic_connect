<?php

namespace App\Livewire;

use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class StateTable extends LivewireTableComponent
{
    protected $model = State::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'states.components.add_button';

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
          return view('livewire.staff_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')->view('states.components.name')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.state.country'), 'country_id')->view('states.components.country')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('states.components.action'),
        ];
    }

    public function builder(): Builder
    {
        return State::with('country')->select('states.*');
    }
}
