@extends('layouts.app')
@section('title')
    {{__('messages.staffs')}}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">{{__('messages.staff.staff_details')}}</h1>
            <div class="text-end mt-4 mt-md-0">
                <a href="{{route('staffs.edit',$staff->id)}}">
                    <button type="button" class="btn btn-primary me-4">{{ __('messages.common.edit') }}</button>
                </a>
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-outline-primary float-end">{{ __('messages.common.back') }}</button>
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-5 col-12">
                            <div class="d-sm-flex align-items-center mb-5 mb-xxl-0 text-center text-sm-start">
                                <div class="image image-circle image-lg-small">
                                    <img src="{{ $staff->profile_image }}" alt="user">
                                </div>
                                <div class="ms-0 ms-md-10 mt-5 mt-sm-0  ">
                                    <span class="text-success mb-2 d-block">{{ $staff->role_name }}</span>
                                    <h2>{{ $staff->full_name }}</h2>
                                    <a href="mailto:{{ $staff->email }}"
                                       class="text-gray-600 text-decoration-none fs-4">
                                        {{ $staff->email }}
                                    </a><br>
                                    <a href="tel:{{ $staff->region_code }} {{ $staff->contact }}"
                                       class="text-gray-600 text-decoration-none fs-4">
    {{ !empty($staff->contact) ? '+'. $staff->region_code .' '. $staff->contact  : __('messages.common.n/a') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-7 overflow-hidden">
                    <ul class="nav nav-tabs mb-sm-7 mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
                        <li class="nav-item position-relative me-7 mb-3" role="presentation">
                            <button class="nav-link active p-0" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                                    type="button" role="tab" aria-controls="overview" aria-selected="true">
                                {{ __('messages.common.overview') }}
                            </button>
                        </li>
                    </ul>
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="row">
                                        @include('staffs.show_fields')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
