@extends('layouts.app')
@section('title')
    {{ __('messages.prescription.edit_prescription') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">@yield('title')</h1>
            <a href="{{ url()->previous() }}"
               class="btn btn-outline-primary mt-3">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                    @include('flash::message')
                </div>
            </div>
            {{ Form::hidden('createMedicineFromPrescriptionPost', route('prescription.medicine.store'), ['id' => 'createMedicineFromPrescriptionPost']) }}
            {{Form::hidden('uniqueId',2,['class'=>'prescriptionUniqueId'])}}
            {{Form::hidden('associateMedicines',json_encode($medicineList),['class'=>'associatePrescriptionMedicines'])}}
            {{Form::hidden('associateMeals',json_encode($mealList),['class'=>'associatePrescriptionMeals'])}}
            {{Form::hidden('dose_interval',json_encode($doseInverval),['class'=>'DoseInterValId'])}}
            {{Form::hidden('dose_duration',json_encode($doseDuration),['class'=>'DoseDurationId'])}}
            @php($updateRoute = isRole('doctor') ? 'doctors.prescriptions.update' : (isRole('patient') ? 'patients.prescriptions.update' : 'prescriptions.update'))
            {{ Form::model($prescription, ['route' => [$updateRoute, $prescription->id], 'method' => 'patch', 'id' => 'editPrescription']) }}
                <div class="card">
                    <div class="card-body p-12">
                        @include('prescriptions.edit_fields')
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>{{ __('messages.medicines') }}</h3>
                        <a href="javascript:void(0)" class="btn btn-primary add-medicine" data-bs-toggle="modal" data-bs-target="#add_new_medicine">
                            {{__('messages.prescription.new_medicine')}}
                        </a>
                    </div>
                    <div class="card-body">
                        @include('prescriptions.medical-table')
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>{{ __('messages.prescription.physical_information') }}</h3>
                    </div>
                    <div class="card-body">
                        @include('prescriptions.edit-physical-info-fields')
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        @include('prescriptions.edit-other-fields')
                    </div>
                </div>
            {{ Form::close() }}
        </div>
        @include('prescriptions.add_new_medicine')
        @include('prescriptions.templates.templates')
    </div>
@endsection
{{--    <script src="{{mix('assets/js/prescriptions/create-edit.js')}}"></script>--}}
