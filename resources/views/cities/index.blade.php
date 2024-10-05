@extends('layouts.app')
@section('title')
    {{__('messages.cities')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:city-table/>
        </div>
    </div>
    @include('cities.create-modal')
    @include('cities.edit-modal')
@endsection
