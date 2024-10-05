@extends('layouts.app')
@section('title')
    {{__('messages.visit.add_visit')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            @role('doctor')
                <a href="{{ route('doctors.visits.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @else
                <a href="{{ route('visits.index') }}"
                   class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</a>
            @endrole
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                @if(getLogInUser()->hasRole('doctor'))
                    {{ Form::open(['route' => 'doctors.visits.store','id' => 'saveForm']) }}
                @else
                    {{ Form::open(['route' => 'visits.store','id' => 'saveForm']) }}
                @endif
                <div class="card-body p-0">
                    @include('visits.fields')
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
