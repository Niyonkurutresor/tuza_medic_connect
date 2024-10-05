<?php

namespace App\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class MedicineTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'medicines.add-button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('medicines.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('name') || $column->isField('selling_price') || $column->isField('buying_price')) {
                return [
                    'class' => 'pt-5',
                ];
            }

            return [];
        });
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('selling_price') || $column->isField('buying_price')) {
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
            Column::make(__('messages.medicine.medicine'), 'name')
                ->view('medicines.templates.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.brand'), 'brand.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.available_quantity'), 'available_quantity')
                ->view('medicines.templates.columns.avalable_quantity')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->view('medicines.templates.columns.selling_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->view('medicines.templates.columns.buying_price')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('medicines.action'),

        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        return Medicine::with('category', 'brand')->select('medicines.*');
    }
}
