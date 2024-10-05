<?php

namespace App\Livewire;

use App\Models\Brand;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class MedicineBrandTable extends LivewireTableComponent
{
    protected $model = Brand::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'brands.add-button';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('brands.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'd-flex justify-content-center w-75 ps-125 text-center',
                    'style' => 'width: 85% !important',
                ];
            }

            return [
                'class' => 'w-50',
            ];
        });
    }

    public function placeholder()
   {
         return view('livewire.smart_patient_cards_skeleton');
   }

    public function columns(): array
    {
        return [
            Column::make(__('messages.medicine.brand'), 'name')
                ->view('brands.templates.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.user.email'), 'email')
                ->view('brands.templates.columns.email')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.web.phone'), 'phone')
                ->view('brands.templates.columns.phone')
                ->sortable()
                ->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('brands.action'),
        ];
    }
}
