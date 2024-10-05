@extends('layouts.app')
@section('title')
    {{__('messages.visit.edit_visit')}}
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
                    {{ Form::model($visit,['route' => ['doctors.visits.update', $visit->id], 'method' => 'patch','id' => 'saveForm']) }}
                @else
                    {{ Form::model($visit,['route' => ['visits.update', $visit->id], 'method' => 'patch','id' => 'saveForm']) }}
                @endif
                    @include('visits.fields')
                    {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
