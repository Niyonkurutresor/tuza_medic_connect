@extends('layouts.app')
@section('title')
    {{__('messages.web.enquiry_details')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('enquiries.index') }}">{{ __('messages.common.back') }}</a>
        </div>
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    @include('fronts.enquiries.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
