@extends('layouts.app')
@section('title')
    {{ __('messages.smart_patient_card.generate_patient_smart_cards') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        {{-- {{ Form::hidden('categoryCreateUrl', route('generate-patient-smart-cards.store'), ['id' => 'indexTemplateCreateUrl']) }} --}}
        @if (isRole('doctor'))
        {{ Form::hidden('categoryCreateUrl', route('doctors.generate-patient-smart-cards.store'), ['id' => 'indexTemplateCreateUrl']) }}
        @endif
        @if (isRole('clinic_admin'))
        {{ Form::hidden('categoryCreateUrl', route('generate-patient-smart-cards.store'), ['id' => 'indexTemplateCreateUrl']) }}
        @endif

        <div class="d-flex flex-column">
            <livewire:generate-patient-smart-cards-table />
        </div>
        @include('generate_patient_smart_cards.components.modal')
        @include('generate_patient_smart_cards/components/show_card')
    </div>
@endsection
