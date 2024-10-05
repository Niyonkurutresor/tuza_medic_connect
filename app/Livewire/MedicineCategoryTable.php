<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class MedicineCategoryTable extends LivewireTableComponent
{
    protected $model = Category::class;

    public string $tableName = 'categories';

    public bool $showButtonOnHeader = true;

    public bool $showFilterOnHeader = true;

    public string $buttonComponent = 'categories.add-button';

    public array $FilterComponent = ['categories.filter-button', Category::STATUS_ARR];

    protected $listeners = ['refresh' => '$refresh', 'changeFilter', 'resetPage'];

    public string $statusFilter = '';

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('categories.created_at', 'desc')
            ->setQueryStringStatus(false);
        $this->setThAttributes(function (Column $column) {
            if ($column->isField('id')) {
                return [
                    'class' => 'd-flex justify-content-end w-75 ps-125 text-center',
                    'style' => 'width: 85% !important',
                ];
            }

            return [
                'class' => 'w-100',
            ];
        });
    }

    public function placeholder()
   {
         return view('livewire.medicine_category_skeleton');
   }

    public function changeFilter($value)
    {
        $this->resetPage($this->getComputedPageName());
        $this->statusFilter = $value;
        $this->setBuilder($this->builder());
        $this->resetPagination();
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.common.name'), 'name')
                ->view('categories.templates.columns.name')
                ->searchable()
                ->sortable(),
            Column::make(__('messages.common.active'), 'is_active')
                ->view('categories.templates.columns.is_active')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('categories.action'),
        ];
    }

    public function builder(): Builder
    {
        /** @var Category $query */
        $query = Category::query()->select('categories.*');
        $query->when(isset($this->statusFilter), function (Builder $q) {
            if (!empty($this->statusFilter)){
                if ($this->statusFilter == 0) {
                } else {
                    if ($this->statusFilter == 2) {
                        $q->where('is_active', 0);
                    } else {
                        $q->where('is_active', $this->statusFilter);
                    }
                }
            }
        });

        return $query;
    }

    public function changeStatus($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category->is_active == Category::ACTIVE) {
            $category->is_active = Category::INACTIVE;
        } else {
            $category->is_active = Category::ACTIVE;
        }
        $category->save();

        $this->dispatchBrowserEvent('success', 'Status updated successfully.');
    }

    public function resetPagination()
    {
        $this->resetPage('categoriesPage');
    }
}
