@extends('layouts.app')
@section('title')
    {{ __('messages.medicine_bills.medicine_bills') }}
@endsection

@section('content')
    <div class="container-fluid">
        @include('flash::message')
        {{-- {{Form::hidden('billUrl',route('bills.index'),['id'=>'indexBillUrl','class'=>'billUrl'])}}
        {{Form::hidden('patientUrl',url('patients'),['id'=>'indexPatientUrl','class'=>'patientUrl'])}}
        {{ Form::hidden('billLang', __('messages.delete.bill'), ['id' => 'billLang']) }} --}}
        <div class="d-flex flex-column">
            <livewire:medicine-bill-table/>
        </div>
    </div>
@endsection
    {{--   assets/js/custom/input_price_format.js --}}
    {{--   assets/js/bills/bill.js -}}
    {{--   assets/js/custom/new-edit-modal-form.js -}}
    {{--   assets/js/custom/reset_models.js --}}
