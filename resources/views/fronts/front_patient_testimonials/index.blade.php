@extends('layouts.app')
@section('title')
    {{ __('messages.front_patient_testimonials') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:front-patient-testimonial-table/>
        </div>
    </div>
@endsection
