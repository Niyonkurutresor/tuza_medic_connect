@if($frontPatientTestimonials->count() > 0)
<section class="testimonial-section p-t-100 p-b-100 bg-secondary">
    <div class="container">
        <div class="text-center">
            <h5 class="text-primary top-heading fs-6 mb-3">{{__('messages.web.testimonial')}}</h5>
            <h2 class="mb-5 pb-2">{{__('messages.web.see_what_are_the_patients')}} {{__('messages.web.saying_about_us')}}</h2>
        </div>
        <div class="position-relative testimonial-block">
            <div class="quotation-mark">
                <img src="{{ asset('assets/front/images/quotation.png') }}" alt="Quotation Mark" class="object-image-cover" loading="lazy">
            </div>
            <div class="testimonial-carousel position-relative">
                    @foreach($frontPatientTestimonials as $frontPatientTestimonial)
                <div class="testimonial-section__testimonial-card rounded-20 position-relative" data-rel="{{ $loop->index +1 }}">
                    <p class="paragraph mb-4 pb-1 fs-6">
                        {{ $frontPatientTestimonial->short_description }}
                    </p>
                    <div class="d-flex align-items-center flex-wrap">
                        <span class="me-3 image-circle image-mini image me-3">
                            <img src="{{ $frontPatientTestimonial->front_patient_profile }}" alt="" class="user-img" loading="lazy">
                        </span>
                        <h3 class="profile-name mb-1 me-2">{{ $frontPatientTestimonial->name }}</h3>
                        <h4 class="profile-info fw-light fs-6 mb-1">- Patient</h4>
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </div>
</section>
@endif
