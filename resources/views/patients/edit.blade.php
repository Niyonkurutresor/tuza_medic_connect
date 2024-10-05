@extends('layouts.app')
@section('title')
    {{ __('messages.patient.edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('patients.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::model($patient, ['route' => ['patients.update', $patient->id], 'method' => 'patch', 'files' => 'true','id'=>'editPatientForm']) }}
                    {{ Form::hidden('is_edit', true,['id' => 'staffIsEdit']) }}
                    {{ Form::hidden('is_edit', true,['id' => 'patientIsEdit']) }}
                    {{ Form::hidden('edit_patient_country_id', isset($patient->address->country_id) ? $patient->address->country_id:null,
                            ['id' => 'editPatientCountryId']) }}
                    {{ Form::hidden('edit_patient_state_id', isset($patient->address->state_id) ? $patient->address->state_id:null,
                            ['id' => 'editPatientStateId']) }}
                    {{ Form::hidden('edit_patient_city_id', isset($patient->address->city_id) ? $patient->address->city_id:null,
                            ['id' => 'editPatientCityId']) }}
                    {{ Form::hidden('backgroundImg',asset('web/media/avatars/male.png'),['id' => 'patientBackgroundImg']) }}
                    @include('patients.fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
