@extends('layouts.app')
@section('title')
    {{ __('messages.enquiries') }}
@endsection
@section('content')
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            {{Form::hidden('all_enquiry',\App\Models\Enquiry::ALL,['id'=>'allEnquiry'])}}
            <livewire:enquiry-table/>
        </div>
    </div>
@endsection
