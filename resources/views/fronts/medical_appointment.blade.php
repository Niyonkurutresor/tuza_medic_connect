@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.web.medical_appointment') }}
@endsection
@section('front-content')
    @php
        $styleCss = 'style';
    @endphp
    <div class="book-appointment-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.book_appointment') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">  {{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">  {{ __('messages.web.book_appointment') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->

        <!-- start book appointment section -->
        <section class="book-appointment-section bg-secondary p-t-100 p-b-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="appointment-form form-wraper">
                       <form class="book-appointment-form bg-white rounded-20 box-shadow" id="frontAppointmentBook" action="{{ route('front.appointment.book') }}" method="post">
                           @csrf
                            @include('fronts.common.book_appointment')
                       </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end book appointment section -->
    </div>
@endsection
