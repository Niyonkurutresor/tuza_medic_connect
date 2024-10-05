@extends('layouts.app')
@section('title')
    {{ __('messages.front_patient_testimonial.add_front_patient_testimonial') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('front-patient-testimonials.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => 'front-patient-testimonials.store','files' => 'true']) }}
                    @include('fronts.front_patient_testimonials.fields')
                    {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
