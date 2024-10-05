@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection
@section('content')
    <div class="container-fluid">
        {{ Form::open(['route' => 'setting.update', 'files' => true,'id' => 'generalSettingForm']) }}
        <div class="d-flex flex-column">
            @include('setting.setting_menu')
            {{ Form::hidden('sectionName', $sectionName) }}
            {{ Form::hidden('setting_country_id', false,['id' => 'settingCountryId']) }}
            {{ Form::hidden('setting_state_id', false,['id' => 'settingStateId']) }}
            {{ Form::hidden('setting_city_id', false,['id' => 'settingCityId']) }}
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-center">
                    <h3 class="m-0">{{__('messages.setting.general_details')}}
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-6">
                    {{ Form::label('clinic_name',__('messages.setting.clinic_name').':',
                                     ['class'=>'col-lg-4 form-label required']) }}
                    <div class="col-lg-8">
                        {{ Form::text('clinic_name', $setting['clinic_name'], ['class' => 'form-control','placeholder'=>__('messages.setting.clinic_name'),'required']) }}
                    </div>
                </div>
                <div class="row mb-6">
                    {{ Form::label('contact_no', __('messages.patient.contact_no').':', ['class' => 'col-lg-4 form-label required']) }}
                    <div class="col-lg-8">
                        {{ Form::tel('contact_no','+'.$setting['region_code'].$setting['contact_no'] ?? null, ['class' => 'form-control', 'placeholder' => __('messages.patient.contact_no'), 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                        {{ Form::hidden('region_code',$setting['region_code'] ?? null ,['id'=>'prefix_code']) }}
                        <span id="valid-msg" class="text-success d-block fw-400 fs-small mt-2 hide">✓ {{ __('messages.valid_number') }}</span>
                        <span id="error-msg" class="text-danger d-block fw-400 fs-small mt-2 hide"> {{ __('messages.invalid_number') }}</span>
                    </div>
                </div>
                <div class="row mb-6">
                    {{ Form::label('default_country_code', __('messages.setting.default_country_code').':', ['class' => 'col-lg-4 form-label required']) }}
                    <div class="col-lg-8">
                        {{ Form::text('default_country_data', null, ['class' => 'form-control','placeholder'=>__('messages.setting.default_country_code'), 'id'=>'defaultCountryData']) }}
                        {{ Form::hidden('default_country_code',$setting['default_country_code'] ,['id'=>'defaultCountryCode',]) }}
                    </div>
                </div>
                <div class="row mb-6">
                    {{ Form::label('email',__('messages.user.email').':',['class'=>'col-lg-4 form-label required']) }}
                    <div class="col-lg-8">
                        {{ Form::email('email', $setting['email'], ['class' => 'form-control ','placeholder'=>__('messages.user.email'),'required']) }}
                    </div>
                </div>
                <div class="row mb-6">
                    {{ Form::label('specialities',__('messages.setting.specialities').':',
                                     ['class'=>'col-lg-4 form-label required']) }}
                    <div class="col-lg-8">
                        {{ Form::select('specialities[]', $specialities, json_decode($setting['specialities']), ['multiple',
                         'class' => 'form-select', 'aria-label'=>"Select a Country",
                         'data-control'=>'select2','required']) }}
                    </div>
                </div>
                <div class="row mb-6">
                        <label for="appLogoPreview" class="col-lg-4 required form-label">{{ __('messages.setting.logo').':'}}</label>
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="appLogoPreview"
                                         style="background-image: url('{{($setting['logo'])?asset($setting['logo']):asset('assets/image/infyCare-favicon.ico')}}')">
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small"
                                          data-bs-toggle="tooltip"
                                          data-placement="top" data-bs-original-title="{{ __('messages.setting.change_app_logo') }}">
                                        <label>
                                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                            <input type="file" id="logo" name="logo" class="image-upload d-none" accept="image/*"/>
                                        </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label for="faviconPreview"
                           class="col-lg-4 required form-label"> {{__('messages.setting.favicon'). ':'}}</label>
                    <div class="col-lg-8">
                        <div class="mb-3" io-image-input="true">
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="faviconPreview"
                                         style="background-image: url('{{($setting['favicon'])?asset($setting['favicon']):asset('assets/image/infyom-logo.png')}}');">
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                          data-placement="top" data-bs-original-title="{{ __('messages.setting.change_favicon') }}">
                    <label>
                        <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                        <input type="file" id="favicon" name="favicon" class="image-upload d-none" accept="image/*"/>
                    </label>
                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-lg-4 form-label required">
                        <span>{{__('messages.setting.do_not_allow_to_login_without_email_verification')}}:</span>
                        <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="{{ __('messages.setting.when_checkbox_disable') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
                    </label>
                    <div class="col-lg-8">
                        {{ Form::checkbox('email_verified', 1, $setting['email_verified'], ['class' => 'form-check-input m-0']) }}
                    </div>
                </div>

                <div class="card-header px-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{__('messages.setting.currency_settings')}}
                        </h3>
                    </div>
                </div>

                <div class="row">
                    <div class="row mb-6">
                        <label class="col-lg-4 form-label">
                            <span>{{__('messages.setting.currency')}}:</span>
                        </label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::select('currency', $currencies, $setting['currency'], [
                                    'class' => 'form-select', 'aria-label'=>"Select a Currency",
                                    'data-control'=>'select2','placeholder' => __('messages.setting.currency')]) }}
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="row mb-6">
                        <label class="col-lg-4 form-label">
                            <span>{{__('messages.common.default_language')}}:</span>
                            <span data-bs-toggle="tooltip"
                              data-placement="top"
                              data-bs-original-title="{{ __('messages.setting.default_language_suggest') }}">
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                            </span>

                        </label>
                        <div class="col-lg-8 fv-row">
                            {{ Form::select('language', $languages, $courentlanguage, [
                                    'class' => 'form-select', 'aria-label'=>"Select a Currency",
                                    'data-control'=>'select2','placeholder' =>__('messages.select_language'),'required']) }}
                        </div>

                    </div>

                </div>

                <div class="row mb-6">
                    <label class="col-lg-4 form-label">
                        <span>{{__('messages.common.google_recaptcha')}}:</span>
                    </label>
                    <div class="col-lg-8">
                        <div class="form-check form-check-solid form-switch">
                            <input name="recaptcha" {{$setting['recaptcha'] == 1 ? 'checked' : ''}} value="1" class="form-check-input settingrecaptcha" type="checkbox" id="settingrecaptcha">
                        </div>
                    </div>
                </div>

                <div class="recaptcha-field" style="display: {{$setting['recaptcha'] == 1 ? '' : 'none'}}">
                    <div class="row mb-6">
                        {{ Form::label('email',__('messages.common.google_captcha_key').':',['class'=>'col-lg-4 form-label required']) }}
                        <div class="col-lg-8">
                            {{ Form::text('googleCaptchaKey', $setting['googleCaptchaKey'], ['class' => 'form-control google-captcha-key','placeholder'=>'Google Captcha Key:','required']) }}
                        </div>
                    </div>
                    <div class="row mb-6">
                        {{ Form::label('email',__('messages.common.google_captcha_secret').':',['class'=>'col-lg-4 form-label required']) }}
                        <div class="col-lg-8">
                            {{ Form::text('googleCaptchaSecret', $setting['googleCaptchaSecret'], ['class' => 'form-control google-captcha-secret','placeholder'=>'Google Captcha Secret:','required']) }}
                        </div>
                    </div>
                </div>

                <div class="card-header px-0">
                    <div class="d-flex align-items-center justify-content-center">
                        <h3 class="m-0">{{__('messages.appointment.payment_method')}}
                        </h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-6">
                        <div class="table-responsive px-0">
                            <table>
                                <tbody class="d-flex flex-wrap">
                                @foreach($paymentGateways as $key => $paymentGateway)
                                    <tr class="w-100 d-flex justify-content-between">
                                        <td class="p-2">
                                            <div class="form-check form-check-custom">
                                                <input class="form-check-input" type="checkbox" value="{{$key}}"
                                                       name="payment_gateway[]"
                                                       id="{{$key}}" {{in_array($paymentGateway, $selectedPaymentGateways) ?'checked':''}} />
                                                <label class="form-label" for="{{$key}}">
                                                    {{$paymentGateway}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Submit Field -->
                    <div class="form-group col-sm-12">
                        {{ Form::submit(__('messages.user.save_changes'),['class' => 'btn btn-primary','id'=>'settingSubmitBtn']) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    </div>
@endsection
