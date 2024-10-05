@extends('layouts.app')
@section('title')
    {{__('messages.smart_patient_card.smart_patient_card_templates')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:smart-patient-cards-table/>
        </div>
    </div>
@endsection
