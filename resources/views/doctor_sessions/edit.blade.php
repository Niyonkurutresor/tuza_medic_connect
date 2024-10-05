@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_session.edit') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-md-flex align-items-center justify-content-between mb-5">
            <h1 class="mb-0"> {{ (Auth::user()->hasRole('doctor')) ? __('messages.doctor_session.my_schedule') : __('messages.doctor_session.edit') }}</h1>
            @if(getLogInUser()->hasRole('doctor'))

            @else
                <div class="text-end mt-4 mt-md-0">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-outline-primary" id="btnBack">{{ __('messages.common.back') }}</a>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('flash::message')
                    @include('layouts.errors')
                </div>
            </div>
            {{ Form::hidden('is_edit', true,['id' => 'doctorSessionIsEdit']) }}
            {{ Form::hidden('get_slot_url', getLogInUser()->hasRole('doctor') ? url('doctors/get-slot-by-gap') : route('get.slot.by.gap'),['id' => 'getSlotByGapUrl']) }}
            <div class="card">
                <div class="card-body p-sm-12 p-5">
                    @if(getLogInUser()->hasRole('doctor'))
                        {{ Form::model($doctorSession,['route' => ['doctors.doctor-sessions.update', $doctorSession->id], 'method' => 'patch','id' => 'saveFormDoctor']) }}
                    @else
                        {{ Form::model($doctorSession,['route' => ['doctor-sessions.update', $doctorSession->id], 'method' => 'patch','id' => 'saveFormDoctor']) }}
                    @endif
                    <div class="card-body p-0">
                        @if(getLogInUser()->hasRole('doctor'))
                            @include('doctor_sessions.doctor_schedule_edit')
                        @else
                            @include('doctor_sessions.fields')
                        @endif
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('doctor_sessions.templates.templates')
