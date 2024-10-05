@extends('layouts.app')
@section('title')
    {{ __('messages.prescription.prescription_details') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1"> @yield('title') </h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{ route('prescriptions.pdf',$prescription['prescription']) }}"
                   target="_blank"
                   class="btn btn-success me-2 edit-btn mt-3">{{ __('auth.app.print').' '.__('messages.prescription.prescription') }}
                </a>
                @php
                $medicineBill = App\Models\MedicineBill::whereModelType('App\Models\Prescription')->whereModelId( $prescription['prescription']->id)->first();
                @endphp
                @if(isset($medicineBill->payment_status) && $medicineBill->payment_status == false)
                <a class="btn btn-primary edit-btn mt-3"
                   href="{{route('prescriptions.edit',[$prescription['prescription']->appointment_id, 'prescription' => $prescription['prescription']->id])}}">
                    {{ __('messages.common.edit') }}
                </a>
                @endif
                <a href="{{ url()->previous()}}"
                   class="btn btn-outline-primary ms-2 mt-3">{{ __('messages.common.back') }}</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    @include('prescriptions.show_fields_with_medicine')
                </div>
            </div>
        </div>
    </div>
@endsection
