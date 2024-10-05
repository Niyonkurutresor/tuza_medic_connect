@extends('layouts.app')
@section('title')
    {{ __('messages.slider.edit_slider') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex justify-content-between align-items-end mb-5">
            <h1>@yield('title')</h1>
            <a class="btn btn-outline-primary float-end"
               href="{{ route('banner.index') }}">{{ __('messages.common.back') }}</a>
        </div>

        <div class="col-12">
            @include('layouts.errors')
        </div>
        <div class="card">
            <div class="card-body">
                {{ Form::open(['route' => ['banner.update', $banner->id], 'method' => 'put','files' => 'true']) }}
                    @include('fronts.sliders.edit_fields')
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
