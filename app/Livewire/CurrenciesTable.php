<?php

namespace App\Livewire;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class CurrenciesTable extends LivewireTableComponent
{
    protected $model = Currency::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'currencies.components.add_button';

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
            Column::make(__('messages.currency.currency_name'), 'currency_name')->view('currencies.components.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.currency.currency_icon'), 'currency_icon')->view('currencies.components.icon')
                ->searchable(),
            Column::make(__('messages.currency.currency_code'), 'currency_code')->view('currencies.components.code')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('currencies.components.action'),
        ];
    }

    public function builder(): Builder
    {
        return Currency::query();
    }
}
