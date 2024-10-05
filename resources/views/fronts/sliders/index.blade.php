@extends('layouts.app')
@section('title')
    {{ __('messages.sliders') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:slider-table/>
        </div>
    </div>
@endsection
