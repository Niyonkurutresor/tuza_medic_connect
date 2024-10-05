@extends('layouts.app')
@section('title')
    {{__('messages.countries')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:countries-table/>
        </div>
    </div>
    @include('countries.add-modal')
    @include('countries.edit-modal')
@endsection
