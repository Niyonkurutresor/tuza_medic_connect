@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_about_us') }}
@endsection

@section('front-content')
    <div class="about-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.about_us') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">{{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web.about_us') }}</li>
                            </ol>
                        </nav>
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
                                        <h2 class="number-big text-primary">{{ getSettingValue('about_experience') }}</h2>
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

        <!-- start our-doctors section -->
        <section class="services-counter-section p-t-100 p-b-100">
            <div class="container">
                <div class="bg-white rounded-20 box-shadow py-3 py-sm-0">
                    <div class="row">
                        <div class="col-xl-3 col-6 services-counter-block">
                            <div class="text-center my-4 my-sm-5 pipe">
                                <h4 class="text-primary fs-1 fw-bolder mb-3">{{ $data['specializationsCount'] }}</h4>
                                <h5 class="mb-0">{{ __('messages.specializations') }}</h5>
                            </div>
                        </div>
                        <div class="col-xl-3 col-6 services-counter-block">
                            <div class="text-center my-4 my-sm-5 pipe">
                                <h4 class="text-primary fs-1 fw-bolder mb-3">{{ $data['servicesCount'] }}</h4>
                                <h5 class="mb-0">{{ __('messages.web.services') }}</h5>
                            </div>
                        </div>
                        <div class="col-xl-3 col-6 services-counter-block">
                            <div class="text-center my-4 my-sm-5 pipe">
                                <h4 class="text-primary fs-1 fw-bolder mb-3">{{ $data['doctorsCount'] }}</h4>
                                <h5 class="mb-0">{{ __('messages.doctors') }}</h5>
                            </div>
                        </div>
                        <div class="col-xl-3 col-6 services-counter-block">
                            <div class="text-center my-4 my-sm-5 pipe">
                                <h4 class="text-primary fs-1 fw-bolder mb-3">{{ $data['patientsCount'] }}</h4>
                                <h5 class="mb-0">{{ __('messages.web.satisfied_patient') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end our-doctors section -->

        <!-- start services counter section -->
        <section class="our-doctors-section bg-secondary p-t-100">
            <div class="container">
                <div class="text-center mb-5 pb-1">
                    <h5 class="text-primary top-heading fs-6 mb-3">{{__('messages.web.our_doctor')}}</h5>
                    <h2 class="pb-2 pb-5">{{__('messages.web.Meet_best_doctors')}}</h2>
                </div>
                <div class="row justify-content-center">
                    @foreach($doctors as $doctor)
                    <div class="col-xl-4 col-md-6 our-doctors-block d-flex align-items-stretch">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body text-center d-flex flex-column">
                                <div class="card-image mb-4 rounded-circle">
                                    <img src="{{ $doctor->user->profile_image }}" alt="Infy Care" class="img-fluid rounded-circle object-image-cover" loading="lazy" />
                                </div>
                                <h4 class="text-primary">  {{ $doctor->user->full_name }}</h4>
                                <label class="designation-label pb-4 mb-3 d-block">
                                    {{ $doctor->specializations->first()->name }}
                                </label>
                                <ul class="social-media d-flex justify-content-center">
                                    @if(!empty($doctor->twitter_url))
                                        <span class="pe-2">
                                            <a target="_blank" href="{{ $doctor->twitter_url }}"><i
                                                        class="fab fa-twitter"></i></a>
                                        </span>
                                    @endif
                                    @if(!empty($doctor->linkedin_url))
                                        <span class="pe-2">
                                            <a target="_blank" href="{{ $doctor->linkedin_url }}"><i
                                                        class="fab fa-linkedin"></i></a>
                                        </span>
                                    @endif
                                    @if(!empty($doctor->instagram_url))
                                        <span class="pe-2">
                                            <a target="_blank" href="{{ $doctor->instagram_url }}"><i
                                                        class="fab fa-instagram"></i></a>
                                        </span>
                                    @endif
                                </ul>
                                <a href="{{ route('doctorBookAppointment',$doctor->id) }}"
                                   class="about-appointment-btn btn btn-primary">
                                    <span>{{ __('messages.web.book_an_appointment') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- start services counter section -->

        <!-- start testimonial section -->
    @include('fronts.patient_testimonial')
        <!-- end testimonial section -->
    </div>

@endsection
