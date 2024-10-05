<div class="row gx-10 mb-5">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('title', __('messages.slider.title').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::text('title', null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.slider.title'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.slider.short_description').':', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
            {{ Form::textarea('short_description', null, ['class' => 'form-control form-control-solid', 'placeholder' =>__('messages.slider.short_description'), 'required', 'rows'=> 5,'id'=>'sliderShortDescription']) }}
        </div>
    </div>  
    <div class="col-lg-6 mb-7">
        <div class="justify-content-center">
            <label class="form-label fs-6 fw-bolder required text-gray-700 mr-3">{{ __('messages.slider.image').':' }}</label>
            <span
                    data-bs-toggle="tooltip" title="Best resolution for this image will be 2000x1333"> <i
                        class="fa fa-question-circle"></i></span>
        </div>
        @php $styleCss = 'style'; @endphp
        <div class="image-input image-input-outline">
            <div class="image-input-wrapper w-125px h-125px"
            {{ $styleCss }}="background-image: url('{{ asset('web/media/avatars/male.png') }}')">
        </div>

        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
               data-bs-toggle="tooltip" title=""
               data-bs-original-title="{{ __('messages.common.change_image') }}">
            <i class="bi bi-pencil-fill fs-7">
                <input type="file" name="image" accept=".png, .jpg, .jpeg">
            </i>
            <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
            <input type="hidden" name="avatar_remove">
        </label>
    </div>
</div>
<div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('sliders.index') }}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    </div>
</div>

