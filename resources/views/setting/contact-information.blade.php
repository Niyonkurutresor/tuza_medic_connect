@extends('layouts.app')
@section('title')
    {{$setting['clinic_name']}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            @include('setting.setting_menu')
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{__('messages.setting.contact_information')}}
                        </h3>
                    </div>
                </div>
                <div>
                    {{ Form::open(['route' => 'setting.update', 'files' => true]) }}
                    {{ Form::hidden('sectionName', $sectionName) }}
                    <div class="card-body">
                        <div class="row mb-6">
                            {{ Form::label('address_one',__('messages.setting.address').' 1:',['class'=>'col-lg-4 required form-label']) }}
                            <div class="col-lg-8">
                                {{ Form::text('address_one', $setting['address_one'], ['class' => 'form-control','placeholder'=>__('messages.setting.address').' 1','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('address_two',__('messages.setting.address').' 2:',['class'=>'col-lg-4 required form-label']) }}
                            <div class="col-lg-8">
                                {{ Form::text('address_two', $setting['address_two'], ['class' => 'form-control','placeholder'=>__('messages.setting.address').' 2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 form-label">
                                {{ Form::label('country_id',__('messages.country.country').':',['class'=>'col-lg-4 form-label required']) }}
                            </label>
                            <div class="col-lg-8">
                                {{ Form::select('country_id', $countries, $setting['country_id'], ['id' => 'settingCountryId',
                                        'class' => 'form-select', 'aria-label'=>"Select a Country",
                                        'data-control'=>'select2','placeholder' => __('messages.country.country'),'required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 form-label">
                                {{ Form::label('state_id',__('messages.common.state').':',['class'=>'col-lg-4 required form-label']) }}
                            </label>
                            <div class="col-lg-8">
                                {{ Form::select('state_id', (isset($states) && $states!=null ? $states : []),
            isset($setting['state_id']) ? $setting['state_id'] : null,
            ['id' => 'settingStateId','class' => 'form-select','data-control'=>'select2','required', 'placeholder' => __('messages.common.state')]) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 form-label">
                                {{ Form::label('city_id',__('messages.city.city').':',['class'=>'col-lg-4 required form-label']) }}
                            </label>
                            <div class="col-lg-8">
                                {{ Form::select('city_id',$cities?? [],
               $setting['city_id'] ?? null,['id' => 'settingCityId','class' => 'form-select','data-control'=>'select2','required']) }}
                            </div>
                        </div>
                        <div class="row mb-6">
                            {{ Form::label('postal_code',__('messages.setting.postal_code').':',['class'=>'col-lg-4 required form-label']) }}
                            <div class="col-lg-8">
                                {{ Form::text('postal_code', $setting['postal_code'], ['class' => 'form-control','placeholder'=>__('messages.setting.postal_code'),'required']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
