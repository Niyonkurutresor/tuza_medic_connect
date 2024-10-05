@extends('layouts.app')
@section('title')
    {{ __('messages.subscribers') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:subscriber-table/>
        </div>
    </div>
@endsection
