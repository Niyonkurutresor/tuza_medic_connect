@extends('layouts.app')
@section('title')
    {{ __('messages.medicine_bills.medicine_bill_details')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">{{__('messages.medicine_bills.medicine_bill_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                @if(isset($medicineBill->payment_status) && $medicineBill->payment_status == false)
                <a class="btn btn-primary edit-btn"
                   href="{{route('medicine-bills.edit', ['medicine_bill' => $medicineBill->id]) }}">{{ __('messages.common.edit') }}</a>
                 @endif
                   <a href="{{route('medicine-bills.index')}}"
                   class="btn btn-outline-primary ms-2">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    @include('medicine-bills.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
