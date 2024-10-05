@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_contact') }}
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="contact-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.contact_us') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">{{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">  {{ __('messages.web.contact_us') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start contact form section -->
        <section class="contact-section bg-secondary p-t-100 p-b-100">
            <div class="container">
                <div class="bg-white rounded-20 box-shadow main-box">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 d-none d-md-block">
                            <div class="card bg-primary contect-information">
                                <div class="card-body">
                                    <h4 class="text-white mb-4 pb-2"> {{__('messages.web.contact_us_for_any_information')}}</h4>
                                    <div class="text-white">
                                        <h5 class="mb-3"> {{__('messages.web.location')}}</h5>
                                        <p class="paragraph text-white"> {{ getSettingValue('address_one') }}</p>
                                    </div>
                                    <div class="text-white">
                                        <h5 class="mb-3">{{__('messages.web.email')}} &  {{__('messages.web.phone')}}</h5>
                                        <a href=" mailto:{{getSettingValue('email')}}" class="text-decoration-none text-white d-block">
                                            {{ getSettingValue('email') }}
                                        </a>
                                        <a href="  tel:+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}"
                                           class="text-decoration-none text-white d-block">
                                            +{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 ps-md-0">
                            <form id="enquiryForm" action="{{ route('enquiries.store') }}"
                                  class="contact-form ajax-form" method="POST">
                                @method('post')
                                @csrf
                                <div class="ajax-message"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="contact-form__input-block">
                                            {{ Form::text('name',old('name'), ['class' => 'form-control','id'=>'name', 'placeholder' => __('messages.web.name'),'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form__input-block">
                                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email','placeholder' => __('messages.web.email'),'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form__input-block">
                                            {{ Form::tel('phone', null,['class' => 'form-control','placeholder' => __('messages.web.phone'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                                            {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
                                            <span id="valid-msg" class="hide">✓ &nbsp; {{ __('messages.valid_number') }}</span>
                                            <span id="error-msg" class="hide"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form__input-block">
                                            {{ Form::text('subject', null, ['class' => 'form-control', 'id' => 'subject','placeholder' => __('messages.web.subject'),'required','maxlength'=>'121']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form__input-block">
                                            {{ Form::textarea('message', null, ['class' => 'form-control form-textarea', 'id' => 'message','placeholder' =>  __('messages.web.message'),'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <div class="g-recaptcha"
                                                 data-sitekey="{{ config('app.google_recaptcha_site_key') }}"
                                                 data-callback="verifyRecaptchaCallback"
                                                 data-expired-callback="expiredRecaptchaCallback"></div>
                                            <input class="form-control d-none" {{$styleCss}}="display:none;" name="
                                        gre_captcha" data-recaptcha="true" data-error="Please complete the Captcha">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-end mt-3">
                                        {{ Form::button(__('messages.web.send_message'),['type'=>'submit','class' => 'btn btn-primary','id'=>'submitBtn']) }}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact form section -->

        <!-- start contact information section -->
        <section class="information-section p-t-100 p-b-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body d-flex flex-column">
                                <div class="contact-icon-box d-flex align-items-center justify-content-center mb-4">
                                    <i class="fa-solid fa-phone text-primary fs-3"></i>
                                </div>
                                <h4 class="mb-3 pt-2">  {{__('messages.user.contact_number')}}</h4>
                                <a href=" tel:+{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}" class="text-decoration-none text-gray-100 d-block fw-light">
                                    +{{ getSettingValue('region_code') }} {{ getSettingValue('contact_no') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-md-0 mt-4">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body d-flex flex-column">
                                <div class="contact-icon-box d-flex align-items-center justify-content-center mb-4">
                                    <i class="fa-solid fa-envelope text-primary fs-3"></i>
                                </div>
                                <h4 class="mb-3 pt-2">   {{__('messages.web.email_address')}}</h4>
                                <a href=" mailto:{{getSettingValue('email')}}" class="text-decoration-none text-gray-100 d-block fw-light">
                                    {{ getSettingValue('email') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-xl-0 mt-4 pt-xl-0 pt-lg-3">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body d-flex flex-column">
                                <div class="contact-icon-box d-flex align-items-center justify-content-center mb-4">
                                    <i class="fa-solid fa-location-dot text-primary fs-3"></i>
                                </div>
                                <h4 class="mb-3 pt-2">{{__('messages.setting.address')}}</h4>
                                <p class="paragraph mb-0">
                                    {{ getSettingValue('address_one') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end contact information section -->
    </div>
@endsection
