@extends('layouts.app')
@section('title')
    {{ __('messages.doctor_sessions') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        {{Form::hidden('doctor_Session',getLogInUser()->hasRole('doctor') ? route('doctors.doctor-sessions.index') :
route('doctor-sessions.index'), ['id' => 'doctorSessionUrl'])}}
        <div class="d-flex flex-column">
            <livewire:doctor-schedule-table/>
        </div>
    </div>
@endsection
