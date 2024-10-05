<div>
    <div class="tab-content mt-0">
        <div class="tab-pane fade show active" id="month">
            <div class="table-responsive livewire-table">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.doctor_appointment.patient') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.patient.patient_unique_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.appointment.date') }}</th>
                        </tr>
                    </thead>

                    <tbody id="doctorMonthlyReport">
                        @forelse($appointments['records'] as $appointment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="image image-circle image-mini me-3">
                                            <img src="{{ $appointment['patient']['profile'] }}" alt="user"
                                                class="">
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('doctors.patient.detail', $appointment['patient']['id']) }}"
                                                class="text-primary-800 mb-1 fs-6 text-decoration-none">
                                                {{ $appointment['patient']['user']['full_name'] }}</a>
                                            <span
                                                class="text-muted fw-bold d-block">{{ $appointment['patient']['user']['email'] }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-start">
                                    <span
                                        class="badge bg-light-success">{{ $appointment['patient']['patient_unique_id'] }}</span>
                                </td>
                                <td class="mb-1 fs-6 text-muted fw-bold text-center">
                                    <div class="badge bg-light-info">
                                        <div class="mb-2">{{ $appointment['from_time'] }}
                                            {{ $appointment['from_time_type'] }} - {{ $appointment['to_time'] }}
                                            {{ $appointment['to_time_type'] }}</div>
                                        <div class="">
                                            {{ \Carbon\Carbon::parse($appointment['date'])->isoFormat('DD MMM YYYY') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted fw-bold">
                                    {{ __('messages.common.no_data_available') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="week">
            <div class="table-responsive livewire-table">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.doctor_appointment.patient') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.patient.patient_unique_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.appointment.date') }}</th>
                        </tr>
                    </thead>
                    <tbody id="doctorWeeklyReport"></tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="day">
            <div class="table-responsive livewire-table">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.doctor_appointment.patient') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.patient.patient_unique_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.appointment.date') }}</th>
                        </tr>
                    </thead>
                    <tbody id="doctorDailyReport">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
