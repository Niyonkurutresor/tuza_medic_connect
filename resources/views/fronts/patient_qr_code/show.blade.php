@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_doctors') }}
@endsection

@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="our-team-page">

        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.qr_patient_detail.patient_detail') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">{{ __('messages.web.home') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.qr_patient_detail.patient_detail') }}</li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-secondary pt-5">
            <div class="container">
                <div class="d-flex flex-column">
                    <div class="card mb-3">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-xxl-5 col-12">
                                    <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                                        <div class="image-circle image-lg-small me-4">
                                            <img src="{{ $patient->profile }}" class="qrcodeimg" alt="user" loading="lazy">
                                        </div>
                                        <div class="ms-0 ms-md-10 mt-5 mt-sm-0  ">
                                            <span class="text-success mb-2 d-block">{{ $patient->user->role_name }}</span>
                                            <h6>{{ $patient->user->full_name }}</h6>
                                            <a href="mailto:{{ $patient->user->email }}"
                                                class="text-decoration-none patient-email">
                                                {{ $patient->user->email }}
                                            </a><br>
                                            @if ($patient->user->contact != null)
                                                <a href="tel:{{ $patient->user->region_code }} {{ $patient->user->contact }}"
                                                    class="text-decoration-none patient-contact">
                                                    {{ !empty($patient->user->contact) ? '+' . $patient->user->region_code . ' ' . $patient->user->contact : __('messages.common.n/a') }}
                                                </a>
                                            @else
                                                <a class="text-decoration-none patient-contact">
                                                    {{ __('messages.common.n/a') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-7 col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                                            <div class="border rounded-10 p-4 h-100">
                                                <h4 class="text-primary mb-3">{{ $data['todayAppointmentCount'] }}</h4>
                                                <h6 class="fs-6 fw-light text-gray-600 mb-0">
                                                    {{ __('messages.patient_dashboard.today_appointments') }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                                            <div class="border rounded-10 p-4 h-100">
                                                <h4 class="text-primary mb-3">{{ $data['upcomingAppointmentCount'] }}</h4>
                                                <h6 class="fs-6 fw-light text-gray-600 mb-0">
                                                    {{ __('messages.patient_dashboard.upcoming_appointments') }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="border rounded-10 p-4 h-100">
                                                <h4 class="text-primary mb-3">{{ $data['completedAppointmentCount'] }}</h4>
                                                <h6 class="fs-6 fw-light text-gray-600 mb-0">
                                                    {{ __('messages.patient_dashboard.completed_appointments') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @hasanyrole('clinic_admin|doctor|patient')
                        @if (auth()->user()->hasRole('patient'))
                            @if (auth()->user()->id == $patient->user->id)
                            <div class="mt-7">
                                <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                    id="myTab" role="tablist">
                                    <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                        <button class="nav-link qrcode-option active p-0 fs-6" id="overview-tab"
                                            data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab"
                                            aria-controls="overview" aria-selected="true">
                                            {{ __('messages.common.overview') }}
                                        </button>
                                    </li>
                                    <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                        <button class="nav-link qrcode-option p-0 fs-6" id="appointments-tab"
                                            data-bs-toggle="tab" data-bs-target="#appointments" type="button"
                                            role="tab" aria-controls="appointments" aria-selected="false">
                                            {{ __('messages.appointments') }}
                                        </button>
                                    </li>
                                    <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                        <button class="nav-link qrcode-option p-0 fs-6" id="visits-tab" data-bs-toggle="tab"
                                            data-bs-target="#visits" type="button" role="tab" aria-controls="visits"
                                            aria-selected="false">
                                            visits
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                        aria-labelledby="overview-tab">
                                        <div class="card qr-card mb-5">
                                            <div class="card-body">
                                                <div class="row">
                                                    {{ Form::hidden('patient_role', getLogInUser()->hasRole('patient'), ['id' => 'patientRolePatientDetail']) }}
                                                    @include('fronts.patient_qr_code.show_fields')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="appointments" role="tabpanel"
                                        aria-labelledby="appointments-tab">
                                        <div class="card qr-card qr-patient-detal-show mb-5">
                                            <div class="card-body qr-appointment-card">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <thead class="bg-gray text-success">
                                                            <tr class="header-qr-appontment">
                                                                <th scope="col"
                                                                    class="text-secondary fw-normal qr-code-first-header">
                                                                    {{ __('messages.visit.doctor') }}</th>
                                                                <th scope="col" class="text-secondary fw-normal">
                                                                    {{ __('messages.appointment.appointment_at') }}</th>
                                                                <th scope="col" class="text-secondary fw-normal">
                                                                    {{ __('messages.appointment.status') }}
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-success qr-appointment-record">
                                                            <tr>
                                                                <td> </td>
                                                            </tr>
                                                            @foreach ($appointment as $val)
                                                                <tr class="shadow-sm border-0">
                                                                    <td scope="row"
                                                                        class="d-flex text-secondary qr-appointment-name data-qr-code qr-code-name">
                                                                        <div class="image-circle me-3">
                                                                            <img src="{{ $val->doctor->user->profile_image }}"
                                                                                class="qr-doctor-img" alt=""
                                                                                width="55" height="55" loading="lazy">
                                                                        </div>
                                                                        <span
                                                                            class="qr-patient-appointment-name">{{ $val->doctor->user->full_name }}
                                                                            <br> {{ $val->doctor->user->email }}
                                                                        </span>
                                                                    </td>
                                                                    <td scope="row">
                                                                        <div class="badge appintment-time bg-info">
                                                                            <div class="mb-2">{{ $val->from_time }}
                                                                                {{ $val->from_time_type }}
                                                                                - {{ $val->to_time }} {{ $val->to_time_type }}
                                                                            </div>
                                                                            <div class="">
                                                                                {{ \Carbon\Carbon::parse($val->date)->isoFormat('DD MMM YYYY') }}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td scope="row" class="text-secondary data-qr-code">
                                                                        @if ($val->status == $book)
                                                                            <span class="badge py-2 book-badge">
                                                                                {{ $val->status == $book ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[1])) : '' }}</span>
                                                                        @endif
                                                                        @if ($val->status == $checkIn)
                                                                            <span class="badge py-2 book-checkin">
                                                                                {{ $val->status == $checkIn ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[2])) : '' }}</span>
                                                                        @endif
                                                                        @if ($val->status == $checkOut)
                                                                            <span class="badge py-2 book-checkout">
                                                                                {{ $val->status == $checkOut ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[3])) : '' }}</span>
                                                                        @endif
                                                                        @if ($val->status == $cancel)
                                                                            <span class="badge py-2 book-cancel">
                                                                                {{ $val->status == $cancel ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[4])) : '' }}</span>
                                                                        @endif
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="visits" role="tabpanel" aria-labelledby="visits-tab">
                                        <div class="card qr-card qr-patient-detal-show mb-5">
                                            <div class="card-body qr-appointment-card">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <thead class="bg-gray ">
                                                            <tr class="header-qr-appontment">
                                                                <th scope="col"
                                                                    class="text-secondary fw-normal qr-code-first-header">
                                                                    {{ __('messages.visit.doctor') }}</th>
                                                                <th scope="col" class="text-secondary fw-normal">
                                                                    Visit Date</th>
                                                                <th scope="col" class="text-secondary fw-normal">
                                                                    Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class=" qr-visit-record">
                                                            <tr>
                                                                <td> </td>
                                                            </tr>
                                                            @foreach ($visit as $val)
                                                                <tr class="shadow-sm border-0">
                                                                    <td scope="row"
                                                                        class="d-flex text-secondary qr-visit-name data-qr-code qr-code-name">
                                                                        <div class="image-circle me-3">
                                                                            <img src="{{ $val->visitDoctor->user->profile_image }}"
                                                                                class="qr-doctor-img" alt=""
                                                                                width="55" height="55" loading="lazy">
                                                                        </div>
                                                                        <span
                                                                            class="qr-patient-visit-name">{{ $val->visitDoctor->user->full_name }}
                                                                            <br> {{ $val->visitDoctor->user->email }}
                                                                        </span>
                                                                    </td>
                                                                    <td scope="row" class="text-secondary data-qr-code">
                                                                        <span
                                                                            class="badge bg-info me-2">{{ \Carbon\Carbon::parse($val->visit_date)->isoFormat('DD MMM YYYY') }}</span>
                                                                    </td>
                                                                    <td scope="row" class="data-qr-code">
                                                                        <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                                                            id="myTab" role="tablist">
                                                                            <button class="btn px-1 text-secondary fs-6"
                                                                                id="viewpatientdata-tab" data-bs-toggle="tab"
                                                                                data-bs-target="#viewpatientdata"
                                                                                type="button" role="tab"
                                                                                aria-controls="viewpatientdata"
                                                                                aria-selected="false">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="viewpatientdata" role="tabpanel"
                                        aria-labelledby="viewpatientdata-tab">
                                        <div class="card qr-card mb-5">
                                            <div class="card-body">
                                                    <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                                        id="myTab" role="tablist">
                                                        <button class="ms-auto nav-link qrcode-option p-0 fs-6"
                                                            id="visits-tab" data-bs-toggle="tab" data-bs-target="#visits"
                                                            type="button" role="tab" aria-controls="visits"
                                                            aria-selected="false">
                                                            back
                                                        </button>
                                                    </ul>
                                                <div class="row">
                                                    {{ Form::hidden('patient_role', getLogInUser()->hasRole('patient'), ['id' => 'patientRolePatientDetail']) }}
                                                    @if(!empty($visit[0]))
                                                        @include('fronts.patient_qr_code.show_visit_patient_detail')
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            @endif
                        @else
                            @hasanyrole('clinic_admin|doctor')
                                <div class="mt-7">
                                    <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                        id="myTab" role="tablist">
                                        <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                            <button class="nav-link qrcode-option active p-0 fs-6" id="overview-tab"
                                                data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab"
                                                aria-controls="overview" aria-selected="true">
                                                {{ __('messages.common.overview') }}
                                            </button>
                                        </li>
                                        <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                            <button class="nav-link qrcode-option p-0 fs-6" id="appointments-tab"
                                                data-bs-toggle="tab" data-bs-target="#appointments" type="button"
                                                role="tab" aria-controls="appointments" aria-selected="false">
                                                {{ __('messages.appointments') }}
                                            </button>
                                        </li>
                                        <li class="nav-item position-relative qrcode-option-li" role="presentation">
                                            <button class="nav-link qrcode-option p-0 fs-6" id="visits-tab" data-bs-toggle="tab"
                                                data-bs-target="#visits" type="button" role="tab" aria-controls="visits"
                                                aria-selected="false">
                                                visits
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                            aria-labelledby="overview-tab">
                                            <div class="card qr-card mb-5">
                                                <div class="card-body">
                                                    <div class="row">
                                                        {{ Form::hidden('patient_role', getLogInUser()->hasRole('patient'), ['id' => 'patientRolePatientDetail']) }}
                                                        @include('fronts.patient_qr_code.show_fields')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="appointments" role="tabpanel"
                                            aria-labelledby="appointments-tab">
                                            <div class="card qr-card qr-patient-detal-show mb-5">
                                                <div class="card-body qr-appointment-card">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead class="bg-gray text-success">
                                                                <tr class="header-qr-appontment">
                                                                    <th scope="col"
                                                                        class="text-secondary fw-normal qr-code-first-header">
                                                                        {{ __('messages.visit.doctor') }}</th>
                                                                    <th scope="col" class="text-secondary fw-normal">
                                                                        {{ __('messages.appointment.appointment_at') }}</th>
                                                                    <th scope="col" class="text-secondary fw-normal">
                                                                        {{ __('messages.appointment.status') }}
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-success qr-appointment-record">
                                                                <tr>
                                                                    <td> </td>
                                                                </tr>
                                                                @foreach ($appointment as $val)
                                                                    <tr class="shadow-sm border-0">
                                                                        <td scope="row"
                                                                            class="d-flex text-secondary qr-appointment-name data-qr-code qr-code-name">
                                                                            <div class="image-circle me-3">
                                                                                <img src="{{ $val->doctor->user->profile_image }}"
                                                                                    class="qr-doctor-img" alt=""
                                                                                    width="55" height="55" loading="lazy">
                                                                            </div>
                                                                            <span
                                                                                class="qr-patient-appointment-name">{{ $val->doctor->user->full_name }}
                                                                                <br> {{ $val->doctor->user->email }}
                                                                            </span>
                                                                        </td>
                                                                        <td scope="row">
                                                                            <div class="badge appintment-time bg-info">
                                                                                <div class="mb-2">{{ $val->from_time }}
                                                                                    {{ $val->from_time_type }}
                                                                                    - {{ $val->to_time }} {{ $val->to_time_type }}
                                                                                </div>
                                                                                <div class="">
                                                                                    {{ \Carbon\Carbon::parse($val->date)->isoFormat('DD MMM YYYY') }}
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td scope="row" class="text-secondary data-qr-code">
                                                                            @if ($val->status == $book)
                                                                                <span class="badge py-2 book-badge">
                                                                                    {{ $val->status == $book ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[1])) : '' }}</span>
                                                                            @endif
                                                                            @if ($val->status == $checkIn)
                                                                                <span class="badge py-2 book-checkin">
                                                                                    {{ $val->status == $checkIn ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[2])) : '' }}</span>
                                                                            @endif
                                                                            @if ($val->status == $checkOut)
                                                                                <span class="badge py-2 book-checkout">
                                                                                    {{ $val->status == $checkOut ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[3])) : '' }}</span>
                                                                            @endif
                                                                            @if ($val->status == $cancel)
                                                                                <span class="badge py-2 book-cancel">
                                                                                    {{ $val->status == $cancel ? __('messages.common.' . strtolower(\App\Models\Appointment::STATUS[4])) : '' }}</span>
                                                                            @endif
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="visits" role="tabpanel" aria-labelledby="visits-tab">
                                            <div class="card qr-card qr-patient-detal-show mb-5">
                                                <div class="card-body qr-appointment-card">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <thead class="bg-gray ">
                                                                <tr class="header-qr-appontment">
                                                                    <th scope="col"
                                                                        class="text-secondary fw-normal qr-code-first-header">
                                                                        {{ __('messages.visit.doctor') }}</th>
                                                                    <th scope="col" class="text-secondary fw-normal">
                                                                        Visit Date</th>
                                                                    <th scope="col" class="text-secondary fw-normal">
                                                                        Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class=" qr-visit-record">
                                                                <tr>
                                                                    <td> </td>
                                                                </tr>
                                                                @foreach ($visit as $val)
                                                                    <tr class="shadow-sm border-0">
                                                                        <td scope="row"
                                                                            class="d-flex text-secondary qr-visit-name data-qr-code qr-code-name">
                                                                            <div class="image-circle me-3">
                                                                                <img src="{{ $val->visitDoctor->user->profile_image }}"
                                                                                    class="qr-doctor-img" alt=""
                                                                                    width="55" height="55" loading="lazy">
                                                                            </div>
                                                                            <span
                                                                                class="qr-patient-visit-name">{{ $val->visitDoctor->user->full_name }}
                                                                                <br> {{ $val->visitDoctor->user->email }}
                                                                            </span>
                                                                        </td>
                                                                        <td scope="row" class="text-secondary data-qr-code">
                                                                            <span
                                                                                class="badge bg-info me-2">{{ \Carbon\Carbon::parse($val->visit_date)->isoFormat('DD MMM YYYY') }}</span>
                                                                        </td>
                                                                        <td scope="row" class="data-qr-code">
                                                                            <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                                                                id="myTab" role="tablist">
                                                                                <button class="btn px-1 text-secondary fs-6"
                                                                                    id="viewpatientdata-tab" data-bs-toggle="tab"
                                                                                    data-bs-target="#viewpatientdata"
                                                                                    type="button" role="tab"
                                                                                    aria-controls="viewpatientdata"
                                                                                    aria-selected="false">
                                                                                    <i class="fas fa-eye"></i>
                                                                                </button>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="viewpatientdata" role="tabpanel"
                                            aria-labelledby="viewpatientdata-tab">
                                            <div class="card qr-card mb-5">
                                                <div class="card-body">
                                                        <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap qrcode-option-ul"
                                                            id="myTab" role="tablist">
                                                            <button class="ms-auto nav-link qrcode-option p-0 fs-6"
                                                                id="visits-tab" data-bs-toggle="tab" data-bs-target="#visits"
                                                                type="button" role="tab" aria-controls="visits"
                                                                aria-selected="false">
                                                                back
                                                            </button>
                                                        </ul>
                                                    <div class="row">
                                                        {{ Form::hidden('patient_role', getLogInUser()->hasRole('patient'), ['id' => 'patientRolePatientDetail']) }}
                                                        @if(!empty($visit[0]))
                                                        @include('fronts.patient_qr_code.show_visit_patient_detail')
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endrole
                        @endif
                    @endrole
                </div>
            </div>
        </section>
    </div>
@endsection
