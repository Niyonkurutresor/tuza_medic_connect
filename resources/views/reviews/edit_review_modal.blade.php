<div class="modal fade" id="editReviewModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.review.edit_review')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editReviewForm']) }}
            <div class="modal-body">
                <input type="text" id="editDoctorId" class="d-none" value="" name="doctor_id">
                <input type="text" id="editReviewId" class="d-none" value="" name="id">
                <div>
                    <div class="mb-2">
                        <label class="form-label"
                               for="editReview">{{ __('messages.review.review') }}:</label>
                        <span class="required"></span>
                        <textarea class="form-control" id="editReview" maxlength="121"
                                  name="review" placeholder="{{ __('messages.review.review') }}"></textarea>
                    </div>
                    <div class="rating d-flex justify-content-center">
                        <!--begin::Reset rating-->
                        <label class="btn btn-light fw-bolder btn-sm rating-label me-3 d-none"
                               for="editRating-0">
                            {{ __('messages.common.reset') }}
                        </label>
                        <input class="rating-input d-none" name="rating" value="0" checked type="radio"
                               id="editRating-0"/>
                        <!--end::Reset rating-->

                        <!--begin::Star 1-->
                        <label class="rating-label" for="editRating-1">
							                            <span class="svg-icon fs-6">
							                                @include('reviews.rating_star')
							                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="1" type="radio" id="editRating-1"/>
                        <!--end::Star 1-->

                        <!--begin::Star 2-->
                        <label class="rating-label" for="editRating-2">
							                            <span class="svg-icon">
							                                 @include('reviews.rating_star')
							                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="2" type="radio" id="editRating-2"/>
                        <!--end::Star 2-->

                        <!--begin::Star 3-->
                        <label class="rating-label" for="editRating-3">
							                            <span class="svg-icon">
							                                 @include('reviews.rating_star')
							                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="3" type="radio" id="editRating-3"/>
                        <!--end::Star 3-->

                        <!--begin::Star 4-->
                        <label class="rating-label" for="editRating-4">
							                            <span class="svg-icon">
							                                 @include('reviews.rating_star')
							                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="4" type="radio" id="editRating-4"/>
                        <!--end::Star 4-->

                        <!--begin::Star 5-->
                        <label class="rating-label" for="editRating-5">
							                            <span class="svg-icon">
							                                 @include('reviews.rating_star')
							                            </span>
                        </label>
                        <input class="rating-input" name="rating" value="5" type="radio" id="editRating-5"/>
                        <!--end::Star 5-->
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary m-0']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss'=>'modal']) }}
            </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

