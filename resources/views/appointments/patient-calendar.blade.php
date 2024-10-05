@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">@yield('title')</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('patients.patient-appointments-index') }}"
                   class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        {{Form::hidden('book_calender', \App\Models\Appointment::BOOKED,['id' => 'bookCalenderConst'])}}
        {{Form::hidden('check_in_calender', \App\Models\Appointment::CHECK_IN,['id' => 'checkInCalenderConst'])}}
        {{Form::hidden('checkOut_calender', \App\Models\Appointment::CHECK_OUT,['id' => 'checkOutCalenderConst'])}}
        {{Form::hidden('cancel_calender', \App\Models\Appointment::CANCELLED,['id' => 'cancelCalenderConst'])}}
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">{{__('messages.appointment.calendar')}}</h2>
                        <div class="d-flex">
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="d-flex me-4 mb-1">
                                <span class="badge bg-primary badge-circle me-1 slot-color-dot"></span>
                                <span class="">{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[1]))}}</span>
                                </div>
                                <div class="d-flex me-4 mb-1">
                                <span class="badge bg-success badge-circle me-1 slot-color-dot"></span>
                                <span class="">{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[2]))}}</span>
                                </div>
                                <div class="d-flex me-4 mb-1">
                                <span class="badge bg-warning badge-circle me-1 slot-color-dot"></span>
                                <span class="">{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[3]))}}</span>
                                </div>
                                <div class="d-flex mb-1">
                                <span class="badge bg-danger badge-circle me-1 slot-color-dot"></span>
                                <span class="">{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[4]))}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="appointmentCalendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('appointments.models.appointment-model')
@endsection

