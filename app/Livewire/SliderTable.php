<?php

namespace App\Livewire;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class SliderTable extends LivewireTableComponent
{
    public bool $showSearch = false;

    protected $model = Slider::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false)
            ->setSearchDisabled();

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
        return Slider::with('media')->latest();
    }

    public function placeholder()
    {
          return view('livewire.slider_skeleton');
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.slider.image'), 'title')->view('fronts.sliders.components.image'),
            Column::make(__('messages.slider.title'), 'title')->view('fronts.sliders.components.title'),
            Column::make(__('messages.slider.short_description'),
                'short_description')->view('fronts.sliders.components.short_description'),
            Column::make(__('messages.common.action'), 'id')->view('fronts.sliders.components.action'),
        ];
    }
}
