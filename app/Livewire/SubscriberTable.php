<?php

namespace App\Livewire;

use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class SubscriberTable extends LivewireTableComponent
{
    protected $model = Subscribe::class;

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

    public function builder(): Builder
    {
        return Subscribe::query();
    }

    public function placeholder()
   {
         return view('livewire.used_medicine_skeleton');
   }

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.email'), 'email')->view('fronts.subscribers.components.email')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('fronts.subscribers.components.action'),
        ];
    }
}
