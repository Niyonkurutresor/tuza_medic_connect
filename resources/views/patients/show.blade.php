@extends('layouts.app')
@section('title')
    {{ __('messages.patients') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">{{__('messages.patient.details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                @if(!getLogInUser()->hasRole('doctor'))
                    <a href="{{route('patients.edit',$patient->id)}}">
                        <button type="button" class="btn btn-primary me-4">{{ __('messages.common.edit') }}</button>
                    </a>
                @endif
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</button>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-5 col-12">
                            <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                                <div class="image image-circle image-lg-small">
                                    <img src="{{ $patient->profile }}" alt="user">
                                </div>
                                <div class="ms-0 ms-md-10 mt-5 mt-sm-0  ">
                                    <span class="text-success mb-2 d-block">{{ $patient->user->role_name }}</span>
                                    <h2>{{ $patient->user->full_name }}</h2>
                                    <a href="mailto:{{ $patient->user->email }}"
                                       class="text-gray-600 text-decoration-none fs-4">
                                        {{ $patient->user->email }}
                                    </a><br>
                                    @if($patient->user->contact != null)
                                        <a href="tel:{{ $patient->user->region_code }} {{ $patient->user->contact }}"
                                       class="text-gray-600 text-decoration-none fs-4">
                                        {{ !empty($patient->user->contact) ? '+'. $patient->user->region_code .' '. $patient->user->contact  : __('messages.common.n/a') }}
                                    </a>
                                    @else
                                       <a class="text-gray-600 text-decoration-none fs-4">
                                        {{__('messages.common.n/a') }}
                                       </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-7 col-12">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                                    <div class="border rounded-10 p-5 h-100">
                                        <h2 class="text-primary mb-3">{{$data['todayAppointmentCount']}}</h2>
                                        <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient_dashboard.today_appointments')}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12 mb-6 mb-md-0">
                                    <div class="border rounded-10 p-5 h-100">
                                        <h2 class="text-primary mb-3">{{$data['upcomingAppointmentCount']}}</h2>
                                        <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient_dashboard.upcoming_appointments')}}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="border rounded-10 p-5 h-100">
                                        <h2 class="text-primary mb-3">{{$data['completedAppointmentCount']}}</h2>
                                        <h3 class="fs-5 fw-light text-gray-600 mb-0">{{__('messages.patient_dashboard.completed_appointments')}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-7">
                <ul class="nav nav-tabs mb-sm-7 mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
                    <li class="nav-item position-relative me-7 mb-3" role="presentation">
                        <button class="nav-link active p-0" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                                type="button" role="tab" aria-controls="overview" aria-selected="true">
                            {{ __('messages.common.overview')  }}
                        </button>
                    </li>
                    <li class="nav-item position-relative me-7 mb-3" role="presentation">
                        <button class="nav-link p-0" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments"
                                type="button" role="tab" aria-controls="appointments" aria-selected="false">
                            {{ __('messages.appointments')  }}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                         aria-labelledby="overview-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    {{Form::hidden('patient_role',getLogInUser()->hasRole('patient'),['id' => 'patientRolePatientDetail'])}}
                                    @include('patients.show_fields')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="appointments" role="tabpanel"
                         aria-labelledby="appointments-tab">
                        <livewire:patient-show-page-appointment-table :patientId="$patient->id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
