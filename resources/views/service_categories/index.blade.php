@extends('layouts.app')
@section('title')
    {{__('messages.service_categories')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:service-category-table/>
            @include('service_categories.create-modal')
            @include('service_categories.edit-modal')
        </div>
    </div>
@endsection
