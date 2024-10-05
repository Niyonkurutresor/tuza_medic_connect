<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Patient;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Lazy;

#[Lazy]
class GeneratePatientSmartCardsTable extends LivewireTableComponent
{
    protected $model = Patient::class;




    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'generate_patient_smart_cards.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function placeholder()
    {
          return view('livewire.doctor_schedule_skeleton');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('patients.created_at', 'desc');
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
        // if (isRole('patient')) {
        //     $query = Patient::whereHas('smartPatientCard')->where('user_id',auth()->user()->id)->with(['user'])->select('*');
        // }else{
            $query = Patient::whereNot('template_id')->with(['user'])->select('*');
        // }
        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.web.name'), 'user.first_name')->view('patients.components.name')
            ->sortable()
            ->searchable(
                function (Builder $query, $direction) {
                    return $query->whereHas('user', function (Builder $q) use ($direction) {
                        $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                    });
                }
            ),
            Column::make(__('messages.patient.name'), 'user.email')
                ->hideIf('user.email')
                ->searchable(),
            Column::make(__('messages.patient.patient_unique_id'), "patient_unique_id")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.smart_patient_card.templat_name'), "smartPatientCard.template_name")
                ->sortable()
                ->searchable(function ($query, $search) {
                    $query->where('smartPatientCard.template_name', 'like', '%' . $search . '%');
            }),
            Column::make(__('messages.common.action'), 'id')->view('generate_patient_smart_cards.components.action'),
        ];
    }
}
