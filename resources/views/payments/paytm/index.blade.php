@extends('layouts.auth')
@section('title')
    {{ __('messages.paytm') }}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="width-540">
            @include('flash::message')
            @include('layouts.errors')
        </div>
        <div class="bg-white rounded-15 shadow-md px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{ __('messages.payment_detail') }}</h1>
            <form action="{{ route('make.payment',['appointmentId' => $appointmentId]) }}" method="POST"
                  enctype="multipart/form-data">
                {!! csrf_field() !!}

                <div class="pb-10 pb-lg-5">
                    <h2 class="fw-bolder text-dark"></h2>
                    <div class="text-muted fw-bold fs-6">
                        {{ __('messages.payment_for_booking_appointment_with_doctor') }} :
                        {{$doctor->user->full_name}} at
                        {{\Carbon\Carbon::parse($appointment->date)->format('d/m/Y')}} {{$appointment->from_time}}
                        {{$appointment->from_time_type}} to {{$appointment->to_time}}
                        {{$appointment->to_time_type}}
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <span>{{$errors->first()}}</span>
                    </div>
                @endif
                @if(session('success_msg'))
                    <div class="alert alert-success fade in alert-dismissible show">
                        {{ session('success_msg') }}
                    </div>
                @endif
                @if(session('error_msg'))
                    <div class="alert alert-danger fade in alert-dismissible show">
                        {{ session('error_msg') }}
                    </div>
                @endif

                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{ __('messages.web.name') }}:<span class="required"></span>
                    </label>
                    <input type="text" class="form-control" name="name"
                           value="{{ $patient->user->full_name }}" placeholder="{{ __('messages.payment_method.name')}}" required
                           readonly>
                </div>

                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{ __('messages.web.email') }}:<span class="required"></span>
                    </label>

                    <input type="email" class="form-control" name="email"
                           value="{{ $patient->user->email }}" placeholder="{{ __('messages.payment_method.email')}}" required
                           readonly>
                </div>

                <div class="mb-sm-7 mb-4">
                    <label for="email" class="form-label">
                        {{ __('messages.mobile_no') }}:<span class="required"></span>
                    </label>

                    <input type="text" class="form-control" name="mobile"
                           value="{{ ($patient->user->contact) ? $patient->user->contact : '' }}"
                           placeholder="{{ __('messages.payment_method.mobile_no')}}" required>
                </div>

                <h6>  {{ __('messages.appointment.payment') }} : {{$appointment->payable_amount}} Rs/-</h6>

                <div class="d-inline-flex">
                    <a href="{{route('paytm.failed')}}">
                        <button type="button" class="btn btn-light me-5">
                            {{ __('messages.common.cancel') }}
                        </button>
                    </a>
                    <button type="submit" class="btn btn-primary">{{ __('messages.common.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
