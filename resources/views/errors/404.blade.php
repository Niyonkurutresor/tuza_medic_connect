@extends('fronts.layouts.app')
@section('front-title')
    Error
@endsection
@section('front-content')
    <div class="page-content bg-white">
        <section class="section-area section-sp2 error-404 p-t-100">
            <div class="container">
                <div class="inner-content">
                    <img src="{{ asset('assets/img/404-error-image.svg') }}" alt="">
                    <h3 class="error-text">The Page you were looking for, couldn't be found.</h3>
                    <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
                    <div class="clearfix mb-5">
                        <a href="{{ url()->previous() }}" class="btn btn-primary m-r5">Back</a>
                        <a href="{{ route('medical') }}" class="btn btn-primary">Back To Home</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
