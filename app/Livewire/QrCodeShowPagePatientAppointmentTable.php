<?php

namespace App\Livewire;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Attributes\Lazy;

#[Lazy]
class QrCodeShowPagePatientAppointmentTable extends LivewireTableComponent
{
    public $patientId;

    protected $model = Appointment::class;

    protected $listeners = ['refresh' => '$refresh', 'resetPage', 'changeStatusFilter', 'changeDateFilter'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringStatus(false);
    }

    public function builder(): Builder
    {
        $query = Appointment::with('doctor')->where('patient_id', '=', $this->patientId)->select('appointments.*');

        if (getLogInUser()->hasRole('doctor')) {
            $query = Appointment::with(['doctor.user', 'doctor.reviews'])->where('patient_id', '=', $this->patientId)->whereDoctorId(getLogInUser()->doctor->id)->select('appointments.*');
        }

        return $query;
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.doctor.doctor'), 'doctor.user.first_name')->view('patients.components.doctor')
                ->sortable()
                ->searchable(
                    function (Builder $query, $direction) {
                        return $query->whereHas('doctor.user', function (Builder $q) use ($direction) {
                            $q->whereRaw("TRIM(CONCAT(first_name,' ',last_name,' ')) like '%{$direction}%'");
                        });
                    }
                ),
            Column::make(__('messages.appointment.appointment_at'), 'date')->view('patients.components.appointment_at')
                ->sortable()->searchable(),
            Column::make(__('messages.appointment.status'), 'id')
                ->format(function ($value, $row) {
                    return view('patient_qr_code.components.status')
                        ->with([
                            'row' => $row,
                            'book' => Appointment::BOOKED,
                            'checkIn' => Appointment::CHECK_IN,
                            'checkOut' => Appointment::CHECK_OUT,
                            'cancel' => Appointment::CANCELLED,
                        ]);
                }),
        ];
    }
}
