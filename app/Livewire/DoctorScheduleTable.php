<?php

namespace App\Livewire;

use App\Models\DoctorSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class DoctorScheduleTable extends LivewireTableComponent
{
    protected $model = DoctorSession::class;

    public bool $showButtonOnHeader = true;

    public string $buttonComponent = 'doctor_sessions.components.add_button';

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

    public function columns(): array
    {
        return [
            Column::make(__('messages.doctor.doctor'),
                'doctor.user.first_name')->view('doctor_sessions.components.doctor_name')
                ->sortable(
                    //                    function (Builder $query, $direction) {
                    //                        return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                    //                            $q->orderBy(User::select('first_name')->whereColumn('users.id', 'user_id'), $direction);
                    //                        });
                    //                    }
                )->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.visit.doctor'), 'doctor.user.email')
                ->hideIf('doctor.user.email')
                ->searchable(),
            Column::make(__('messages.doctor_session.session_meeting_time'),
                'session_meeting_time')->view('doctor_sessions.components.schedule_meeting_time')
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'), 'id')->view('doctor_sessions.components.action'),
        ];
    }

    public function placeholder()
    {
          return view('livewire.doctor_schedule_skeleton');
    }

    public function builder(): Builder
    {
        $query = DoctorSession::with(['doctor.user', 'doctor.reviews'])->select('doctor_sessions.*');

        if (getLoginUser()->hasRole('doctor')) {
            $query->where('doctor_id', getLoginUser()->doctor->id);
        }

        return $query;
    }
}
