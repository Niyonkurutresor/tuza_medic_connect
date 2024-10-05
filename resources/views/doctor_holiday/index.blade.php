@extends('layouts.app')
@section('title')
    {{__('messages.holiday.doctor_holiday')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:doctor-holiday-table/>
        </div>
    </div>
@endsection
