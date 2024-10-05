@extends('layouts.app')
@section('title')
    {{ __('messages.purchase_medicine.purchase_medicine') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            {{Form::hidden('medicineUrl',route('medicines.index'),['id'=>'indexMedicineUrl'])}}
            {{ Form::hidden('medicines-show-modal', url('medicines-show-modal'), ['id'=>'medicinesShowModal']) }}
            {{ Form::hidden('medicineLang',__('messages.delete.medicine'), ['id' => 'medicineLang']) }}
            <livewire:purchase-medicine-table/>
            @include('medicines.show_modal')
        </div>
    </div>
@endsection
