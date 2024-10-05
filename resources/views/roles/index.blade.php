@extends('layouts.app')
@section('title')
    {{__('messages.roles')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:role-table/>
        </div>
    </div>
@endsection
