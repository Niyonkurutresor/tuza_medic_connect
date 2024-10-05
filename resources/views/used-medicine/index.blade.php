@extends('layouts.app')
@section('title')
    {{ __('messages.used_medicine.used_medicine') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('flash::message')
            <livewire:used-medicine-table/>
        </div>
    </div>
@endsection
