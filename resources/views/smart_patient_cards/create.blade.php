@extends('layouts.app')
@section('title')
   {{ __('messages.smart_patient_card.add_smart_card') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>{{ __('messages.smart_patient_card.add_smart_card') }}</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('smart-patient-cards.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card w-100">
            <div class="card-body w-100">
                @if (isRole('doctor'))
                {{ Form::open(['route' => ['doctors.smart-patient-cards.store'], 'method' => 'POST', 'files' => true,'id'=> 'createStaffForm']) }}
                @endif
                @if (isRole('clinic_admin'))
                {{ Form::open(['route' => ['smart-patient-cards.store'], 'method' => 'POST', 'files' => true,'id'=> 'createStaffForm']) }}
                @endif
                @include('smart_patient_cards.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
