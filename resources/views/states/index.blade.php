@extends('layouts.app')
@section('title')
    {{__('messages.states')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:state-table/>
        </div>
    </div>
    @include('states.add-modal')
    @include('states.edit-modal')
@endsection
