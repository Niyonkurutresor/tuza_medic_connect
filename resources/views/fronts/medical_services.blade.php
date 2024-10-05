@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_services') }}
@endsection

@section('front-content')
    <div class="services-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.services') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}"> {{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web.services') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- end our-team section -->
        <section class="services-section bg-secondary p-t-100">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($services as $service)
                    <div class="col-xl-4 col-md-6 services-block d-flex align-items-stretch">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body text-center d-flex flex-column">
                                <div class="services-icon-box mx-auto d-flex align-items-center justify-content-center">
                                    <img src="{{ $service->icon }}" alt="Emergency" class="img-fluid object-image-cover" loading="lazy">
                                </div>
                                <h4 class="text-primary"> {{ $service->name }}</h4>
                                <p class="paragraph pb-3">
                                    {{ $service->short_description }}
                                </p>
                                <a href="{{ route('serviceBookAppointment',$service->id) }}"
                                   class="btn btn-primary mt-auto align-self-center">
                                    <span>{{ __('messages.web.book_an_appointment') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end our-team section -->

        <!-- start services counter section -->
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
        <!-- end services counter section -->
    </div>
@endsection
