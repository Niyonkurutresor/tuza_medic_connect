<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class StaffTable extends LivewireTableComponent
{
    protected $model = User::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'staffs.components.add_button';

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

        $this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
            if ($columnIndex == '4') {
                return [
                    'class' => 'text-center',
                ];
            }

            return [];
        });
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.user.full_name'), 'first_name')->view('staffs.components.staff_name')
                ->sortable()->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                    }
                ),
            Column::make(__('messages.patient.name'), 'email')
                ->hideIf('email')
                ->searchable(),
            Column::make(__('messages.common.email'), 'email')->hideIf(1),
            Column::make(__('messages.staff.role'), 'email')->view('staffs.components.role'),
            Column::make(__('messages.common.email_verified'),
                'email_verified_at')->view('staffs.components.email_verified')->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('staffs.components.action'),
        ];
    }

    public function placeholder()
   {
         return view('livewire.staff_skeleton');
   }

    public function builder(): Builder
    {
        return User::with(['roles'])->where('type', User::STAFF)->where('id', '!=', getLogInUserId())->select('users.*');
    }
}
