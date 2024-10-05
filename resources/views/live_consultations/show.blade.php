@extends('layouts.app')
@section('title')
    {{ __('messages.live_consultation.live_consultation_details') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @if(getLogInUser()->hasRole('doctor'))
                <div class="text-end mt-4 mt-md-0">
                    @if( $data['liveConsultation']->status != 2 )
                        <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}" class="btn btn-primary me-4 live-consultation-edit-btn" data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.edit') }}" data-id="{{$data['liveConsultation']->id}}">
                            {{ __('messages.common.edit') }}
                        </a>
                    @endif
                    <a class="btn btn-outline-primary float-end" href="{{ route('doctors.live-consultations.index') }}">
                        {{ __('messages.common.back') }}
                    </a>
                </div>
            @else
                <a class="btn btn-outline-primary float-end" href="{{ route('patients.live-consultations.index') }}">
                    {{ __('messages.common.back') }}
                </a>
            @endif
        </div>
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.live_consultation.consultation_title')}}:</label>
                            <span class="fs-4 text-gray-800">{{$data['liveConsultation']->consultation_title}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.live_consultation.consultation_date')}}:</label>
                            <span class="fs-4 text-gray-800">
                                {{ \Carbon\Carbon::parse($data['liveConsultation']->consultation_date)->isoFormat('hh:mm A') }},
                                {{ \Carbon\Carbon::parse($data['liveConsultation']->consultation_date)->isoFormat('DD MMM YYYY') }}
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.live_consultation.consultation_duration_minutes') }}:</label>
                            <span class="fs-4 text-gray-800">{{$data['liveConsultation']->consultation_duration_minutes}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.patient').(' ').__('messages.common.name')}}:</label>
                            <span class="fs-4 text-gray-800">{{$data['liveConsultation']->patient->user->full_name}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.doctor').(' ').__('messages.common.name')}}:</label>
                            <span class="fs-4 text-gray-800">{{$data['liveConsultation']->doctor->user->full_name}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.live_consultation.host_video')}}:</label>
                            @if($data['liveConsultation']->host_video == 0)
                                <span class="fs-4 text-gray-800">{{ __('messages.live_consultation.disabled') }}</span>
                            @else
                                <span class="fs-4 text-gray-800">{{ __('messages.live_consultation.enable') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-0 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.live_consultation.client_video')}}:</label>
                            @if($data['liveConsultation']->participant_video == 0)
                                <span class="fs-4 text-gray-800">{{ __('messages.live_consultation.disabled') }}</span>
                            @else
                                <span class="fs-4 text-gray-800">{{ __('messages.live_consultation.enable') }}</span>
                            @endif
                        </div>
                        <div class="col-md-6 d-flex flex-column">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.description') }}:</label>
                            @if($data['liveConsultation']->description)
                                <span class="fs-4 text-gray-800">{{$data['liveConsultation']->description}}</span>
                            @else
                                <span class="fs-4 text-gray-800">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('live_consultations.edit_modal')
    </div>
@endsection
