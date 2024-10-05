@extends('layouts.app')
@section('title')
    {{ __('messages.visit.visit_details') }}
@endsection
@section('header_toolbar')
    <div class="toolbar">
        <div class="container-fluid d-flex flex-stack">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">@yield('title')</h1>
            </div>
            <div class="d-flex align-items-center py-1 ms-auto">
                <div class="d-flex align-items-center py-1 me-2">
                    <a href="{{ route('patients.patient.visits.index') }}">
                        <button type="button" class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid d-flex flex-column-fluid">
        <div class="container-fluid visit-detail-width">
            @include('flash::message')
            @include('layouts.errors')
            <div class="card-title m-0">
                <div class="flex-column flex-xl-row">
                    @include('patient_visits.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection

