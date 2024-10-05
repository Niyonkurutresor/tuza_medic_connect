@extends('layouts.auth')
@section('title')
    {{__('messages.register')}}
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid align-items-center justify-content-center p-4">
        <div class="col-12 text-center">
            <a href="{{ route('medical') }}" class="image mb-7 mb-sm-10">
                <img alt="Logo" src="{{ asset(getAppLogo()) }}" class="img-fluid" style="width:90px;" loading="lazy">
            </a>
        </div>
        <div class="width-540">
            @include('flash::message')
            @include('layouts.errors')
        </div>
        <div class="bg-white rounded-15 shadow-md width-540 px-5 px-sm-7 py-10 mx-auto">
            <h1 class="text-center mb-7">{{__('messages.web.patient_registration')}}</h1>
            <form method="POST" action="{{ route('register') }}" >
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="formInputFirstName" class="form-label">
                            {{ __('messages.patient.first_name').':' }}<span class="required"></span>
                        </label>
                        <input name="first_name" type="text" class="form-control" id="name" aria-describedby="firstName" placeholder="{{ __('messages.patient.first_name') }}" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6 mb-sm-7 mb-4">
                        <label for="last_name" class="form-label">
                            {{ __('messages.patient.last_name') .':' }}<span class="required"></span>
                        </label>
                        <input name="last_name" type="text" class="form-control" id="last_name" aria-describedby="lastName" placeholder="{{ __('messages.patient.last_name') }}" required value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-sm-7 mb-4">
                        <label for="email" class="form-label">
                            {{ __('messages.patient.email').':' }}<span class="required"></span>
                        </label>
                        <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="{{ __('messages.patient.email') }}" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="mb-5 fv-row">
                    <div class="row">
                        <div class="col-md-6 mb-sm-7 mb-4 position-relative">
                            <label for="password" class="form-label">
                                {{ __('messages.patient.password').':' }}<span class="required"></span>
                            </label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('messages.patient.password') }}" aria-describedby="password" required>
                            <span
                                class="position-absolute d-flex align-items-center top-0 mt-7 bottom-0 end-0 me-6 input-icon input-password-hide cursor-pointer text-gray-600 change-type">
                                <i class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                        <div class="col-md-6 mb-sm-7 mb-4 position-relative">
                            <label for="password_confirmation" class="form-label">
                                {{ __('messages.patient.confirm_password') .':' }}<span class="required"></span>
                            </label>
                            <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('messages.patient.confirm_password') }}" id="password_confirmation" aria-describedby="confirmPassword" required>
                            <span
                                class="position-absolute d-flex align-items-center top-0 mt-7 bottom-0 end-0 me-6 input-icon input-password-hide cursor-pointer text-gray-600 change-type">
                                <i class="fas fa-eye-slash"></i>
                            </span> 
                        </div>
                    </div>

                    <div class="mb-sm-7 mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="toc" value="1" required/>
                        <span class="text-gray-700 me-2 ml-1">{{__('messages.web.i_agree')}}
									<a href="{{ route('terms.conditions') }}"
                                       class="ms-1 link-primary">{{__('messages.web.terms_and_conditions')}}</a>.
                        </span>
                    </div>

                    @if (getSettingValue('recaptcha'))
                        <div class="form-group mb-4 captcha-customize">
                            <div class="g-recaptcha" id="g-recaptcha"
                                data-sitekey="{{$captchakey}}"
                                data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback">
                            </div>
                        </div>
                    @endif

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">{{__('messages.common.submit')}}</button>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <span class="text-gray-700 me-2">{{__('messages.web.already_have_an_account').'?'}}</span>
                        <a href="{{ route('login') }}" class="link-info fs-6 text-decoration-none">
                            {{__('messages.web.sign_in_here')}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
