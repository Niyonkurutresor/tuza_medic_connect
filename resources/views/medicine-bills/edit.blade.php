@extends('layouts.app')
@section('title')
    {{ __('messages.medicine_bills.edit_medicine_bill') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">@yield('title')</h1>
            <a href="{{ route('medicine-bills.index') }}"
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
                    <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                </div>
            </div>
            {{--  @dd($medicineBill)  --}}
            <div class="card">
                {{--  @dd($medicineCategoriesList)  --}}
                <div class="card-body">
                    {{Form::hidden('uniqueId',count($medicineBill->saleMedicine)+1,['id'=>'medicineUniqueId'])}}
                    {{Form::hidden('associateMedicines',json_encode($medicineList),['class'=>'associatePurchaseMedicines'])}}
                    {{Form::hidden('medicineCategories',json_encode($medicineCategoriesList),['id'=>'showMedicineCategoriesMedicineBill'])}}

                    {{ Form::model($medicineBill, ['route' => ['medicine-bills.update', $medicineBill->id], 'method' => 'patch', 'id' => 'MedicinebillForm']) }}
                    {{--  @include('medicine-bills.fields')  --}}
                    <div class="row">
                        @include('medicine-bills.medicine-table')
                    </div>
                    {{ Form::close() }}
                </div>
                @include('medicine-bills.templates.templates')
            </div>
        </div>
    {{--  </div>
    @include('bills.templates.templates')
    {{Form::hidden('billSaveUrl',route('bills.update', $bill->id),['id'=>'editBillSaveUrl','class'=>'billSaveUrl'])}}
    {{Form::hidden('billUrl',route('bills.index'),['id'=>'editBillUrl','class'=>'billUrl'])}}
    {{Form::hidden('associateMedicines',json_encode($associateMedicines),['id'=>'editBillAssociateMedicines','class'=>'associateMedicines'])}}
    {{Form::hidden('uniqueId',$bill->billItems->count() + 1,['id'=>'editBillUniqueId','class'=>'uniqueId'])}}
    {{Form::hidden('billDate',$bill->bill_date->format('Y-m-d h:i A'),['id'=>'editBillDate','class'=>'billDate'])}}
    {{Form::hidden('patientAdmissionDetailUrl',url('patient-admission-details'),['id'=>'editBillPatientAdmissionDetailUrl','class'=>'patientAdmissionDetailUrl'])}}
    {{Form::hidden('patientAdmissionId',$bill->patient_admission_id,['id'=>'editBillPatientAdmissionId','class'=>'patientAdmissionId'])}}
    {{Form::hidden('billId',$bill->id,['id'=>'editBillId','class'=>'billId'])}}
    {{Form::hidden('isEdit',true,['id'=>'editBillIsEdit','class'=>'isEdit'])}}  --}}
@endsection
    {{--     assets/js/moment.min.js --}}
    {{--  assets/js/bills/edit.js --}}
    {{--  assets/js/custom/input_price_format.js --}}
    {{--  assets/js/bills/new.js --}}
