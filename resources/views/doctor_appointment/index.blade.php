@extends('layouts.app')
@section('title')
    {{ __('messages.appointments') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:doctor-panel-appointment-table/>
        </div>
    </div>
    @include('doctor_appointment.models.doctor-payment-status-model')
@endsection
