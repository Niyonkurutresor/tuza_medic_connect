@extends('layouts.app')
@section('title')
    {{__('messages.specializations')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:specialization-table/>
        </div>
    </div>
    @include('specializations.create-modal')
    @include('specializations.edit-modal')
@endsection
