<div>
    <div class="d-flex border-0 pt-5">
        <h3 class="align-items-start flex-column">
            <span class="fw-bolder fs-3 mb-1">{{ __('messages.admin_dashboard.recent_patients_registration') }}</span>
        </h3>
        <div class="ms-auto d-sm-block d-none">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active text-primary btn-active-light-primary fw-bolder px-4 active dayData" data-bs-toggle="tab" href="" id="dayData">{{ __('messages.admin_dashboard.day') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 weekData" data-bs-toggle="tab" href="" id="weekData">{{ __('messages.admin_dashboard.week') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 monthData" data-bs-toggle="tab" href="" id="monthData">{{ __('messages.admin_dashboard.month') }}</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="d-flex ms-auto d-sm-none d-block mt-2 mb-2 justify-content-end">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn btn-sm btn-color-muted btn-active text-primary btn-active-light-primary fw-bolder px-4 active dayData" data-bs-toggle="tab" href="" id="dayData">{{ __('messages.admin_dashboard.day') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 weekData" data-bs-toggle="tab" href="" id="weekData">{{ __('messages.admin_dashboard.week') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 monthData" data-bs-toggle="tab" href="" id="monthData">{{ __('messages.admin_dashboard.month') }}</a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="month">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.name') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.patient_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.doctor_dashboard.total_appointments') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.patient.registered_on') }}</th>
                        </tr>
                    </thead>
                    <tbody id="monthlyReport" class="text-gray-600 fw-bold">
                        @forelse($data['patients'] as $patient)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="image image-circle image-mini me-3">
                                        <img src="{{ $patient->profile }}" alt="user" class="">
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="{{ route('patients.show', $patient->id) }}" class="text-primary-800 mb-1 fs-6 text-decoration-none">{{ $patient->user->fullname }}</a>
                                        <span class="text-muted fw-bold d-block">{{ $patient->user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-start">
                                <span class="badge bg-light-success">{{ $patient->patient_unique_id }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light-danger">{{ $patient->appointments_count }}</span>
                            </td>
                            <td class="text-center text-muted fw-bold">
                                <span class="badge bg-light-info">
                                    {{ \Carbon\Carbon::parse($patient->user->created_at)->isoFormat('DD MMM YYYY hh:mm A') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="5" class="text-center text-muted fw-bold">
                                {{ __('messages.common.no_data_available') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="week">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.name') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.patient_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.doctor_dashboard.total_appointments') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.patient.registered_on') }}</th>
                        </tr>
                    </thead>
                    <tbody id="weeklyReport" class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="day">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th class="w-25px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.name') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7">
                                {{ __('messages.admin_dashboard.patient_id') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.doctor_dashboard.total_appointments') }}</th>
                            <th class="min-w-150px text-muted mt-1 fw-bold fs-7 text-center">
                                {{ __('messages.patient.registered_on') }}</th>
                        </tr>
                    </thead>
                    <tbody id="dailyReport" class="text-gray-600 fw-bold">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

