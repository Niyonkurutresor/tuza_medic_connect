@extends('layouts.app')
@section('title')
    {{ __('messages.clinic_schedules') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">{{ __('messages.clinic_schedules') }}</h1>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                <div class="row">
                    <div class="col-12">
                        @include('flash::message')
                        @include('layouts.errors')
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-sm-12 p-5 p-0">
                        {{ Form::open(['route' => 'clinic-schedules.store', 'id' => 'clinicScheduleSaveForm']) }}
                        <div class="card-body p-0">
                            @include('clinic_schedule.fields')
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
