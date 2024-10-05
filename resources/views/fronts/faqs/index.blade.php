@extends('layouts.app')
@section('title')
    {{ __('messages.faqs') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            <livewire:faq-table/>
        </div>
    </div>
@endsection
