<div class="modal fade" id="addReviewModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.review.add_review')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'addReviewForm']) }}
            <div class="modal-body">
                <input type="hidden" id="reviewDoctorId" value="" name="doctor_id">
                <div>
                    <div class="mb-2">
                        <label class="form-label"
                               for="review">{{ __('messages.review.review') }}:</label>
                        <span class="required"></span>
                        <textarea class="form-control" maxlength="121" id="review"
                                  name="review" placeholder="{{ __('messages.review.review') }}"></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <!--begin::Reset rating-->
                        <label class="btn btn-light fw-bolder btn-sm me-3 d-none" for="review_0">
                            {{ __('messages.common.reset') }}
                        </label>
                        <input class="d-none" name="rating" value="0" checked type="radio"
                               id="review_0"/>
                        <!--end::Reset rating-->

                        <!--begin::Star 1-->
                        <label for="review_1">
                            <span>
                                @include('reviews.rating_star')
                            </span>
                        </label>
                        <input name="rating" value="1" type="radio" id="review_1"/>
                        <!--end::Star 1-->

                        <!--begin::Star 2-->
                        <label for="review_2">
                            <span>
                                 @include('reviews.rating_star')
                            </span>
                        </label>
                        <input name="rating" value="2" type="radio" id="review_2"/>
                        <!--end::Star 2-->

                        <!--begin::Star 3-->
                        <label for="review_3">
                            <span>
                                 @include('reviews.rating_star')
                            </span>
                        </label>
                        <input name="rating" value="3" type="radio" id="review_3"/>
                        <!--end::Star 3-->

                        <!--begin::Star 4-->
                        <label for="review_4">
                            <span>
                                 @include('reviews.rating_star')
                            </span>
                        </label>
                        <input name="rating" value="4" type="radio" id="review_4"/>
                        <!--end::Star 4-->

                        <!--begin::Star 5-->
                        <label for="review_5">
                            <span>
                                 @include('reviews.rating_star')
                            </span>
                        </label>
                        <input name="rating" value="5" type="radio" id="review_5"/>
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

