@extends('layouts.app')
@section('title')
    {{__('messages.doctors')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:doctor-table/>
        </div>
        @include('doctors.qualification-modal')
    </div>
@endsection
