@extends('layouts.app')
@section('title')
    {{ __('messages.live_consultations') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        @include('layouts.errors')
        <div class="d-flex flex-column">
            {{Form::hidden('liveConsultationUrl',route('doctors.live-consultations.index'),['id' => 'liveConsultationUrl'])}}
            {{Form::hidden('liveConsultationTypeNumber',route('doctors.live.consultation.list'),['id' => 'liveConsultationTypeNumber'])}}
            {{Form::hidden('liveConsultationCreateUrl',route('doctors.live-consultations.store'),['id' => 'liveConsultationCreateUrl'])}}
            {{Form::hidden('zoomCredentialCreateUrl',route('doctors.zoom.credential.create'),['id' => 'zoomCredentialCreateUrl'])}}
            {{Form::hidden('doctorRole',getLogInUser()->hasRole('doctor')?true:false,['id' => 'doctorRole'])}}
            {{Form::hidden('adminRole',getLogInUser()->hasRole('admin')?true:false,['id' => 'adminRole'])}}
            {{Form::hidden('patientRole',getLogInUser()->hasRole('patient')?true:false,['id' => 'patientRole'])}}
            <livewire:live-consultations-table/>
            @role('doctor')
            @include('live_consultations.add_modal')
            @include('live_consultations.edit_modal')
            @include('live_consultations.add_credential_modal')
            @endrole
            @include('live_consultations.show_consultation_modal')
            @include('live_consultations.start_modal')
            @include('generate_patient_smart_cards.components.show_card')
        </div>
    </div>
@endsection
