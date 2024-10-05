@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_doctors') }}
@endsection

@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="our-team-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.our_team') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">{{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('messages.web.our_team') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- end our-team section -->
        <section class="our-team-section bg-secondary">
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($doctors as $doctor)
                    <div class="col-xl-4 col-md-6 our-team-block d-flex align-items-stretch">
                        <div class="card mx-lg-2 flex-fill">
                            <div class="card-body text-center d-flex flex-column">
                                <div class="card-image mb-4 rounded-circle">
                                    <img src="{{ $doctor->user->profile_image }}" alt="Infy Care" class="img-fluid rounded-circle object-image-cover" loading="lazy" />
                                </div>
                                <h4 class="text-primary">{{ $doctor->user->full_name }}</h4>
                                <label class="designation-label pb-4 mb-3 d-block">
                                    {{ $doctor->specializations->first()->name }}
                                </label>
                                <ul class="social-media d-flex justify-content-center" >
                                    @if(!empty($doctor->twitter_url))
                                        <li class="pe-2">
                                            <a target="_blank" href="{{ $doctor->twitter_url }}"><i
                                                        class="fab fa-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if(!empty($doctor->linkedin_url))
                                        <li class="pe-2">
                                            <a target="_blank" href="{{ $doctor->linkedin_url }}"><i
                                                        class="fab fa-linkedin"></i></a>
                                        </li>
                                    @endif
                                    @if(!empty($doctor->instagram_url))
                                        <li class="pe-2">
                                            <a target="_blank" href="{{ $doctor->instagram_url }}"><i
                                                        class="fab fa-instagram"></i></a>
                                        </li>
                                    @endif
                                </ul>
                                <a href="{{ route('doctorBookAppointment',$doctor->id) }}"
                                   class="doctor-appointment-btn btn btn-primary mt-auto align-self-center">
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
    </div>
@endsection
