<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\SmartPatientCards;
use Livewire\Attributes\Lazy;

#[Lazy]
class SmartPatientCardsTable extends LivewireTableComponent
{
    protected $model = SmartPatientCards::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'smart_patient_cards.components.add_button';

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');

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
         return view('livewire.doctor_schedule_skeleton');
   }

    public function columns(): array
    {
        return [
            Column::make(__('messages.smart_patient_card.templat_name'), "template_name")
                ->sortable()
                ->searchable(),
            Column::make(__('messages.smart_patient_card.header_color'), "header_color")
                ->sortable()->view('smart_patient_cards.components.color_code'),
            Column::make(__('messages.smart_patient_card.email_show'), "show_email")
                ->view('smart_patient_cards.components.email_show')
                ->sortable(),
            Column::make(__('messages.smart_patient_card.phone_show'), "show_phone")
                ->view('smart_patient_cards.components.show_phone')
                ->sortable(),
            Column::make(__('messages.smart_patient_card.dob_show'), "show_dob")
                ->view('smart_patient_cards.components.show_dob')
                ->sortable(),
            Column::make(__('messages.smart_patient_card.blood_group_show'), "show_blood_group")
                ->view('smart_patient_cards.components.show_blood_group')
                ->sortable(),
            Column::make(__('messages.smart_patient_card.address_show'), "show_address")
                ->view('smart_patient_cards.components.show_address')
                ->sortable(),
            Column::make(__('messages.smart_patient_card.unique_id_show'), "show_patient_unique_id")
                ->view('smart_patient_cards.components.show_patient_unique_id')
                ->sortable(),
            Column::make(__('messages.common.action'), 'id')->view('smart_patient_cards.components.action'),
        ];
    }
}
