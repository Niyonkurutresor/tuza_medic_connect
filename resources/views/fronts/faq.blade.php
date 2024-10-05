@extends('fronts.layouts.app')
@section('front-title')
    {{ __('messages.faqs') }}
@endsection

@section('front-content')



    @php
        $styleCss = 'style';
    @endphp
    <div class="our-faqs-page">
        <!-- start hero section -->
        <section class="hero-content-section bg-white p-t-100 p-b-100">
            <div class="container p-t-30">
                <div class="col-12">
                    <div class="hero-content text-center">
                        <h1 class="mb-3">
                            {{ __('messages.web.faqs') }}
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('medical') }}">{{ __('messages.web.home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> {{ __('messages.web.faqs') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- end hero section -->



        <!-- end our-team section -->
        <section class="our-faqs-section bg-secondary">
            <div class="container">
                <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="accordion ttr-accordion1" id="accordionRow1">
                                @foreach($faqs as $key => $faq)
                                    @if($loop->odd)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{$loop->index +1 }}">
                                                <button class="accordion-button collapsed" type="button" data-id="{{$loop->index +1 }}"
                                                        data-bs-toggle="collapse" id="collapseId{{$loop->index +1 }}"
                                                        data-bs-target="#collapse{{$loop->index +1 }}" aria-expanded="false"
                                                        aria-controls="collapse{{$loop->index +1 }}">{{ $faq->question }}</button>
                                            </h2>
                                            <div id="collapse{{$loop->index +1 }}" class="accordion-collapse collapse"
                                                 aria-labelledby="heading{{$loop->index +1 }}"
                                                 data-bs-parent="#accordionRow1">
                                                <div class="accordion-body">
                                                    <p class="mb-0">{{ $faq->answer }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="accordion ttr-accordion1" id="accordionRow2">
                                @foreach($faqs as $key => $faq)
                                    @if($loop->even)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{$loop->index +1 }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{$loop->index +1 }}" aria-expanded="false"
                                                        aria-controls="collapse{{$loop->index +1 }}">{{ $faq->question }}</button>
                                            </h2>
                                            <div id="collapse{{$loop->index +1 }}" class="accordion-collapse collapse"
                                                 aria-labelledby="heading{{$loop->index +1 }}"
                                                 data-bs-parent="#accordionRow2">
                                                <div class="accordion-body">
                                                    <p class="mb-0">{{ $faq->answer }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <!-- end our-team section -->
    </div>
@endsection
