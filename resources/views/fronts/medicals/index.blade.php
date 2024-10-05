@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical') }}
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="home-page">
    <!-- start hero section -->
    <section class="hero-section p-t-100 p-b-100">
        <div class="container p-t-100">
            <div class="row align-items-center flex-column-reverse flex-lg-row">
                <div class="col-lg-6 text-lg-end text-center">
                    <div class="hero-content mt-5 mt-lg-0">
                        <p class="text-primary fs-5 fw-bold">{{ $sliders->title }}</p>
                        <h1 class="mb-5">
                            {{ $sliders->short_description }}
                        </h1>
                        @if(!getLogInUser())
                            <a href="{{ route('register') }}"
                               class="btn btn-primary" data-turbo="false">{{ __('messages.web.sign_up') }}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end text-center">
                    <img src="{{ $sliders->slider_image }}" alt="Infy Care" class="img-fluid object-image-cover" loading="lazy" />
                </div>
            </div>
        </div>
    </section>
    <!-- end hero section -->

    <!-- start about section -->
    <section class="about-section p-b-100">
        <div class="container">
            <div class="row align-items-center flex-column-reverse flex-xl-row">
                <div class="col-xxl-6 col-xl-5 after-rectangle-shape position-relative about-left-content left-shape">
                    <div class="row position-relative z-index-1">
                        <div class="col-xl-6 col-md-3 about-block">
                            <div class="about-image-box rounded-20 bg-white">
                                <img src="{{ getSettingValue('about_image_2') }}" alt="About" class="rounded-20" loading="lazy" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-3 about-block">
                            <div class="about-image-box rounded-20 bg-white">
                                <img src="{{ getSettingValue('about_image_1') }}" alt="About" class="rounded-20" loading="lazy" />
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-3 about-block">
                            <div
                                    class="about-content-box rounded-20 bg-white d-flex align-items-center justify-content-center h-100">
                                <div class="text-center">
                                    <h2 class="number-big text-primary">{{ $aboutExperience->value }}</h2>
                                    <p class="mb-0">{{ __('messages.web.year_experience') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-3 about-block">
                            <div class="about-image-box bg-white rounded-20">
                                <img src="{{ getSettingValue('about_image_3') }}" alt="About" class="rounded-20" loading="lazy" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-7">
                    <div class="about-right-content mb-md-5 mb-4 mb-xl-0 text-center text-xl-start">
                        <h5 class="text-primary top-heading fs-6 mb-3">{{ __('messages.web.about_us') }}</h5>
                        <h2 class="pb-2">{{ getSettingValue('about_title') }}</h2>
                        <p class="paragraph pb-1">
                            {{ getSettingValue('about_short_description') }}
                        </p>
                        <ul class="d-flex ps-0 mb-4 pb-2 justify-content-center justify-content-xl-start flex-wrap">
                            <li class="mb-2">{{__('messages.web.emergency_help')}}</li>
                            <li class="mb-2">{{__('messages.web.qualified_doctors')}}</li>
                            <li class="mb-2">{{__('messages.web.best_professionals')}}</li>
                            <li class="mb-2">{{__('messages.web.medical_treatment')}}</li>
                        </ul>
                        <a href="{{ route('medicalContact') }}"
                           class="btn btn-primary " data-turbo="false">{{__('messages.web.contact_us')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- end about section -->

        <!-- start how-it-work section -->
        <section class="how-work-section p-t-100 p-b-100">
            <div class="container">
            <div class="text-center mb-lg-5 mb-4">
                <h5 class="text-primary top-heading fs-6 mb-3">{{__('messages.web.working_process')}}</h5>
                <h2 class="pb-2">{{__('messages.web.how_we_works')}}?</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-md-6">
                    <div class="card mx-lg-2 h-100 text-md-start text-center">
                        <div class="card-body">
                            <h3 class="card-number mb-4 pb-3">
                                1
                            </h3>
                            <h4 class="card-title fs-5">
                                {{__('messages.web.registration')}}
                            </h4>
                            <p class="paragraph mb-0">
                                {{__('messages.web.patient_can_do_registration___')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mt-md-0 mt-4">
                    <div class="card mx-lg-2 h-100 text-md-start text-center">
                        <div class="card-body">
                            <h3 class="card-number mb-4 pb-3">
                                2
                            </h3>
                            <h4 class="card-title fs-5">
                                {{__('messages.web.make_appointment')}}
                            </h4>
                            <p class="paragraph mb-0">
                                {{__('messages.web.patient_can_book_an_appointment___')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mt-xl-0 mt-4 pt-xl-0 pt-lg-3">
                    <div class="card mx-lg-2 h-100 text-md-start text-center">
                        <div class="card-body">
                            <h3 class="card-number mb-4 pb-3">
                                3
                            </h3>
                            <h4 class="card-title fs-5">
                                {{__('messages.web.take_treatment')}}
                            </h4>
                            <p class="paragraph mb-0">
                                {{__('messages.web.doctors_can_interact___')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end how-it-work section -->

    <!-- start appointment section -->
    <section class="appointmnet-section p-t-100 p-b-100">
        <div class="container">
            <div class="bg-primary border-bmr-100 appointmnet-section__inner-block">
                <div class="row align-items-center">
                    <div class="col-lg-6 align-self-end d-none d-lg-block">
                        <img src="{{ asset('assets/front/images/appointment.png') }}" alt="Book An Appointment" class="img-fluid object-image-cover" loading="lazy" />
                    </div>
                    <div class="col-lg-6 contact-form">
                        <h2 class="pb-2 text-white text-center mb-4 pb-3">{{__('messages.web.book_an_appointment')}}</h2>
                        <form action="{{ route('front.home.appointment.book')}}" method="POST" turbo:load>
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="contact-form__input-block">
                                        <input name="first_name" type="text" class="form-control required form-control-transparent"
                                               placeholder="{{ __('messages.doctor.first_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form__input-block">
                                        <input type="text" name="last_name" class="form-control required form-control-transparent"
                                               placeholder="{{ __('messages.doctor.last_name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-form__input-block">
                                        <input type="email" name="email" class="form-control required form-control-transparent"
                                               placeholder="{{ __('messages.web.email') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form__input-block">
                                        {{ Form::select('doctor_id',$doctors, null,['class' => 'form-select form-control-transparent required', 'data-control'=>"select2", 'required','placeholder' => __('messages.common.select_doctor'), 'id' => 'frontDoctorId']) }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form__input-block position-relative">
                                        <input type="text" name="date" id="frontAppointmentDate"
                                               class="form-control form-control-transparent appointment-calendar" placeholder="{{ __('messages.doctor.select_date') }}"
                                               autocomplete="true" required readonly>
                                        <span
                                                class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4">
                                                <i class="fa-solid fa-calendar-days text-white post"></i>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center mt-4">
                                    <button type="submit" class="btn btn-light">{{__('messages.web.appointment_now')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end appointment section -->

    <!-- start services section -->
    <section class="services-section overflow-hidden p-b-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-4">
                    <div class="text-xxl-start text-center mb-lg-0 mb-5">
                        <h5 class="text-primary top-heading fs-6 mb-3">{{__('messages.web.services')}}</h5>
                        <h2 class="pb-2">{{__('messages.web.we_cover_a_big___')}}</h2>
                        <p class="paragraph pb-3">
                            {{__('messages.web.we_provide_the_special_tips___')}}
                        </p>
                        <a href="{{ route('medicalServices') }}"
                           class="btn btn-primary">{{__('messages.web.all_services')}}</a>
                    </div>
                </div>
                <div class="col-xxl-8 after-rectangle-shape position-relative right-shape mt-lg-5 mt-xxl-0">
                    <div class="services-carousel z-index-1">
                            @foreach($frontMedicalServices as $frontMedicalService)
                        <div class="services-block">
                            <div class="row position-relative z-index-1">
                                @if(isset($frontMedicalService[0]))
                                <div class="col-md-6 text-center services-innner-block">
                                    <div class="icon-box mx-auto d-flex align-items-center justify-content-center">
                                        <img src="{{ $frontMedicalService[0]['icon'] }}" alt="Emergency" class="img-fluid object-image-cover" loading="lazy" />
                                    </div>
                                    <h4 class="text-primary">{{ $frontMedicalService[0]['name'] }}</h4>
                                    <p class="paragraph pb-3">
                                        {{ $frontMedicalService[0]['short_description'] }}
                                    </p>
                                </div>
                                @endif
                                    @if(isset($frontMedicalService[1]))
                                <div class="col-md-6 text-center services-innner-block">
                                    <div class="icon-box mx-auto d-flex align-items-center justify-content-center">
                                        <img src="{{ $frontMedicalService[1]['icon'] }}" alt="Emergency" class="img-fluid object-image-cover" loading="lazy" />
                                    </div>
                                    <h4 class="text-primary">{{ $frontMedicalService[1]['name']}}</h4>
                                    <p class="paragraph pb-3">
                                        {{ $frontMedicalService[1]['short_description'] }}
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- end services section -->

        <!-- start testimonial section -->
    @include('fronts.patient_testimonial')
    <!-- end testimonial section -->
    </div>
@endsection
