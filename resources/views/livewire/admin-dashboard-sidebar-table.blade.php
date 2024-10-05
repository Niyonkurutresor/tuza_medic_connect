<div>
    <div class="row">

        <div class="col-xxl-6 col-xl-4 col-md-6 widget">
            <a href="{{ route('appointments.index') }}" class="text-decoration-none">
                <div
                    class="admin-wiget-appointment-card1 rounded-10 p-xxl-8 px-7 py-10 d-flex align-items-center justify-content-between mb-5">
                    <div class="text-start text-dark">
                        <h3 class="mb-0 fs-6 mb-3 fw-light">{{ __('messages.patient_dashboard.upcoming_appointments') }}
                        </h3>
                        <h1 class="fs-2-xxl fw-bolder">{{ $upcomingAppointmentCount }}</h1>
                    </div>
                    <div
                        class="bg-cyan-500 widget-icon admin-patient-widget-icon rounded-50 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-md display-6 admin-card-icon text-white"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xxl-6 col-xl-4 col-md-6 widget">
            <a href="{{ route('appointments.index') }}" class="text-decoration-none">
                <div
                    class="admin-wiget-appointment-card3 rounded-10 p-xxl-8 px-7 py-10 d-flex align-items-center justify-content-between mb-5">
                    <div class="text-start text-dark">
                        <h3 class="mb-0 fs-6 mb-3 fw-light">{{ __('messages.doctor_dashboard.total_appointments') }}
                        </h3>
                        <h1 class="fs-2-xxl fw-bolder">{{ $totalAppointmentCount }}</h1>
                    </div>
                    <div
                        class="bg-cyan-500 widget-icon admin-patient-widget-icon rounded-50 d-flex align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt display-6 admin-card-icon text-white"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
