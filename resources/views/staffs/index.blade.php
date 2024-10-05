@extends('layouts.app')
@section('title')
    {{__('messages.staffs')}}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:staff-table/>
        </div>
    </div>
@endsection
