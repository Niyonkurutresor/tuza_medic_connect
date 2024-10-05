@extends('layouts.app')
@section('title')
    {{ __('messages.visit.visit_details') }}
@endsection
@section('header_toolbar')
    <div class="toolbar">
        <div class="container-fluid d-flex flex-stack mb-2">
            <div>
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-3 me-1">@yield('title')</h1>
            </div>
            {{ Form::hidden('no_records_found', __('messages.common.no_records_found'),['id' => 'noRecordsFoundMSG']) }}
            {{ Form::hidden('doctor_login', getLogInUser()->hasRole('doctor'),['id' => 'doctorLogin']) }}
            <div class="d-flex align-items-center py-1 ms-auto">
                <a href="{{getLogInUser()->hasRole('doctor') ? route('doctors.visits.edit', $visit->id) : route('visits.edit', $visit->id)}}">
                    <button type="button" class="btn btn-primary me-4">{{ __('messages.common.edit') }}</button>
                </a>
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</button>
                </a>
            </div>
        </div>
        @include('visits.templates.templates')
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            @include('flash::message')
            @include('layouts.errors')
            <div class="card-title m-0 mt-lg-5">
                <div class="flex-column flex-xl-row">
                    @include('visits.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
