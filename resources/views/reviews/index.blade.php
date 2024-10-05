@extends('layouts.app')
@section('title')
    {{ __('messages.reviews') }}
@endsection
@section('content')
    @php $style = 'style'; @endphp
    <div class="container-fluid">
        @include('flash::message')
        <div class="d-flex flex-column">
            @if($doctors->count() > 0)
                <div class="row">
                    @endif
                    @forelse($doctors as $doctor)
                        <div class="col-md-6 col-xxl-4 ribbon ribbon-top ribbon-vertical mt-5">
                            @if($doctor->reviews->avg('rating') != 0)
                                <div class="ribbon-label bg-primary align-items-center">
                                    <div class="star-ratings">
                                        <div class="avg-review-star-div">
                                            @php
                                                $rating = $doctor->reviews->avg('rating');
                                            @endphp
                                            @foreach(range(1, 5) as $i)
                                                @if($rating > 0)
                                                    @if($rating > 0.5)
                                                        <i class="fas fa-star review-star"></i>
                                                    @else
                                                        <i class="fas fa-star-half-alt review-star"></i>
                                                    @endif
                                                @else
                                                    <i class="far fa-star review-star"></i>
                                                @endif
                                                @php $rating--; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card h-100">
                                <div class="card-body d-flex flex-center flex-column">
                                    <div class="image image-circle image-medium text-center">
                                        <img src="{{ $doctor->user->profile_image }}" alt="image">
                                    </div>
                                    <span class="fs-4 text-gray-800 fw-bolder text-center mt-2">{{ $doctor->user->full_name }}</span>
                                    <div class="fw-bold text-gray-400 mb-6 text-center">
                                        @foreach($doctor->specializations as $specialization)
                                            @if($loop->last)
                                                {{ $specialization->name }}
                                            @else
                                                {{ $specialization->name }},
                                            @endif
                                        @endforeach
                                    </div>

                                    @forelse($doctor->reviews->where('patient_id', getLogInUser()->patient->id) as $review)
                                        @if(isset($review) && ($review->patient_id == getLogInUser()->patient->id))
                                            <div class="mt-auto">
                                                <div class="fw-bold mb-3 text-center">
                                                    {{ $review->review }}
                                                </div>
                                            </div>
                                            <div class="text-center review-star-div">
                                                @php
                                                    $rating = $review->rating;
                                                @endphp
                                                @foreach(range(1, 5) as $i)
                                                    @if($rating > 0)
                                                        @if($rating > 0.5)
                                                            <i class="fas fa-star review-star"></i>
                                                        @else
                                                            <i class="fas fa-star-half-alt review-star"></i>
                                                        @endif
                                                    @else
                                                        <i class="far fa-star review-star"></i>
                                                    @endif
                                                    @php $rating--; @endphp
                                                @endforeach
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-primary mt-3 editReviewBtn"
                                                        data-id="{{ $review->id }}"
                                                        data-target="#editReviewModal" data-toggle="modal">
                                                    <i class="fas fa-edit"></i> <span>{{ __('messages.review.edit_review') }}</span>
                                                </button>
                                            </div>
                                        @endif
                                    @empty
                                        <div class="mt-auto text-center">
                                            <button class="btn btn-primary addReviewBtn" data-id="{{ $doctor->id }}"
                                                    data-target="#addReviewModal" data-toggle="modal">
                                                <i class="fas fa-pen"></i><span> {{ __('messages.review.write_a_review') }}</span>
                                            </button>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body">
                                <div class="card-px text-center pb-5"><h2
                                            class="fs-2x fw-bold mb-0">{{ __('messages.review.no_doctors_available_to_give_rating') }}</h2>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
        </div>
    </div>
        </div>
    </div>
    @include('reviews.review_modal')
    @include('reviews.edit_review_modal')
    @include('generate_patient_smart_cards/components/show_card')
@endsection
