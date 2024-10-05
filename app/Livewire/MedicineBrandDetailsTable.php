<?php

namespace App\Livewire;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class MedicineBrandDetailsTable extends LivewireTableComponent
{
    protected $model = Medicine::class;

    public $brandDetails;

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function mount(string $brandDetails): void
    {
        $this->brandDetails = $brandDetails;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('selling_price')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding: 0rem !important',
                ];
            }
            if ($column->isField('buying_price')) {
                return [
                    'class' => 'text-end',
                    'style' => 'padding: 0rem !important',
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
            Column::make(__('messages.medicine.category'), 'category.name')
                ->view('brands.templates.columnsDetails.category')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.medicine'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.brand'), 'category_id')
                ->hideIf('category_id'),

            Column::make(__('messages.medicine.selling_price'), 'selling_price')
                ->view('brands.templates.columnsDetails.selling')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.medicine.buying_price'), 'buying_price')
                ->view('brands.templates.columnsDetails.buying')
                ->searchable()
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        /** @var Medicine $query */
        $query = Medicine::with('category', 'brand')->where('brand_id', $this->brandDetails);

        return $query;
    }
}
