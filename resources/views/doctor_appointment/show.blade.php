@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('header_toolbar')
    <div class="toolbar">
        <div class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{ url()->previous() }}"
                   class="btn btn-sm btn-primary">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid">
        <div class="container">
            <div class="card-title m-0">
                <div class="d-flex flex-column flex-xl-row">
                    @include('doctor_appointment.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_js')
    <script>
        let recordsURL = {{url('doctors/appointments')}};
    </script>
    <script src="{{mix('assets/js/doctor_appointments/doctor_appointments.js')}}"></script>
@endsection
