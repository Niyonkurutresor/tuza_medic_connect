@extends('layouts.app')
@section('title')
    {{ __('messages.purchase_medicine.purchase_medicine') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">@yield('title')</h1>
            <a href="{{ route('medicine-purchase.index') }}"
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
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {{Form::hidden('uniqueId',2,['id'=>'purchaseUniqueId'])}}
                    {{Form::hidden('associateMedicines',json_encode($medicineList),['class'=>'associatePurchaseMedicines'])}}
                    {{ Form::open(['route' => 'medicine-purchase.store','data-turbo'=>'false','id'=>'purchaseMedicineFormId']) }}
                    <div class="row">
                        @include('purchase-medicines.fields')
                    </div>
                    {{ Form::close() }}
                </div>
                @include('purchase-medicines.templates.templates')
            </div>
        </div>
    </div>
@endsection
