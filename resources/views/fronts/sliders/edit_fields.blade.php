<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('title', __('messages.slider.title').':', ['class' => 'form-label required']) }}
            {{ Form::text('title', !empty($banner) ? $banner->title : null, ['class' => 'form-control', 'placeholder' => __('messages.slider.title'), 'required']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('short_description', __('messages.slider.short_description').':', ['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip"
                  data-placement="top"
                  data-bs-original-title={{ __('messages.common.maximum_55') }}>
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark"></i>
                        </span>
            {{ Form::textarea('short_description', !empty($banner) ? $banner->short_description : null, ['class' => 'form-control', 'placeholder' => __('messages.slider.short_description'), 'required', 'rows'=> 5,'id'=>'shortDescription','maxlength'=>55]) }}
        </div>
    </div>
    <div class="col-lg-6 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{ __('messages.slider.image').':' }}</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{$banner->slider_image}}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small"
                          data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.common.change_image') }}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profile_image" name="image" class="image-upload d-none profile-validation" accept="image/*" />
                        </label>
                    </span>
                </div>
            </div>
            <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
        </div>
    </div>
    <div class="d-flex">
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{ route('banner.index') }}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
