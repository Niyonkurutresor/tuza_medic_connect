@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_session.add') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0">
                {{ Auth::user()->hasRole('doctor') ? __('messages.doctor_session.my_schedule') : __('messages.doctor_session.add') }}
            </h1>
            <div class="text-end mt-4 mt-md-0">
                @if (getLogInUser()->hasRole('doctor'))
                    <div class="d-flex align-items-center py-1 ms-auto">
                        <a href="{{ route('doctors.doctor-sessions.edit', getLogInUser()->doctor->id) }}"
                            class="btn btn-outline-primary" id="btnBack">{{ __('messages.common.back') }}</a>
                    </div>
                @else
                    <div class="d-flex align-items-center py-1 ms-auto">
                        <a href="{{ route('doctor-sessions.index') }}" class="btn btn-outline-primary"
                            id="btnBack">{{ __('messages.common.back') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="">
        <div class="container-fluid">
            <div class="mb-10">
                <div class="row">
                    <div class="col-12">
                        @include('flash::message')
                        @include('layouts.errors')
                    </div>
                </div>
                {{ Form::hidden('is_edit', false, ['id' => 'doctorSessionIsEdit']) }}
                {{ Form::hidden('get_slot_url', getLogInUser()->hasRole('doctor') ? url('doctors/get-slot-by-gap') : route('get.slot.by.gap'), ['id' => 'getSlotByGapUrl']) }}
                <div class="card">
                    <div class="card-body p-sm-12 p-5">
                        @if (Auth::user()->hasRole('doctor'))
                            {{ Form::open(['route' => 'doctors.doctor-sessions.store', 'id' => 'saveFormDoctor']) }}
                        @else
                            {{ Form::open(['route' => 'doctor-sessions.store', 'id' => 'saveFormDoctor']) }}
                        @endif
                        <div class="card-body p-0">
                            @include('doctor_sessions.fields')
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('doctor_sessions.templates.templates')
