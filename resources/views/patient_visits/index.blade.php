@extends('layouts.app')
@section('title')
    {{ __('messages.visits') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:patient-visit-table/>
        </div>
    </div>
    @include('generate_patient_smart_cards.components.show_card')
@endsection
