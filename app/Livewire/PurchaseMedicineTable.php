<?php

namespace App\Livewire;

use App\Models\PurchaseMedicine;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class PurchaseMedicineTable extends LivewireTableComponent
{
    protected $model = PurchaseMedicine::class;

    public bool $showButtonOnHeader = true;

    public bool $showFilterOnHeader = false;

    public bool $paginationIsEnabled = true;

    public string $buttonComponent = 'purchase-medicines.action';

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public function configure(): void
    {
        $this->setQueryStringStatus(false);
        $this->setDefaultSort('purchase_medicines.created_at', 'desc');
        $this->setPrimaryKey('id');

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
            Column::make(__('messages.purchase_medicine.purchase_number'), 'purchase_no')
                ->sortable()->searchable()->view('purchase-medicines.columns.purchase_number'),
            Column::make(__('messages.purchase_medicine.total'), 'total')
                ->sortable()->searchable()->view('purchase-medicines.columns.total'),
            Column::make(__('messages.purchase_medicine.tax'), 'tax')
                ->sortable()->searchable()->view('purchase-medicines.columns.tax'),
            Column::make(__('messages.purchase_medicine.discount'), 'discount')
                ->sortable()->searchable()->view('purchase-medicines.columns.discount'),
            Column::make(__('messages.purchase_medicine.net_amount'), 'net_amount')
                ->sortable()->searchable()->view('purchase-medicines.columns.net_amount'),
            Column::make(__('messages.purchase_medicine.payment_mode'), 'payment_type')
                ->sortable()->searchable()->view('purchase-medicines.columns.payment_type'),
            Column::make(__('messages.common.action'), 'id')->view('purchase-medicines.columns.action'),
        ];
    }
}
