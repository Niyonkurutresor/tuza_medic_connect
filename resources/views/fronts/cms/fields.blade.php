<div class="row">
    <div class="col-lg-4 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.cms.about_image'). " "}}1:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ !empty($cmsData['about_image_1']) ? $cmsData['about_image_1'] : asset('web/media/avatars/male.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.common.change_image') }}">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" id="profile_image" name="about_image_1" class="image-upload d-none about-image-validation" accept="image/*" /> 
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
        </div>
    </div>

    <div class="col-lg-4 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.cms.about_image'). " "}}2:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ !empty($cmsData['about_image_2']) ? $cmsData['about_image_2'] : asset('web/media/avatars/male.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.common.change_image') }}">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" id="profile_image" name="about_image_2" class="image-upload d-none about-image-validation" accept="image/*" /> 
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
        </div>
    </div>

    <div class="col-lg-4 mb-7">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.cms.about_image'). " "}}3:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url('{{ !empty($cmsData['about_image_3']) ? $cmsData['about_image_3'] : asset('web/media/avatars/male.png') }}')">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.common.change_image') }}">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" id="profile_image" name="about_image_3" class="image-upload d-none about-image-validation" accept="image/*" /> 
                        </label> 
                    </span>
                </div>
            </div>
            <div class="form-text">{{ __('messages.doctor.allowed_img') }}</div>
        </div>
    </div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_title', __('messages.web.about_title').':', ['class' => 'form-label required']) }}
        {{ Form::text('about_title', $cmsData['about_title'], ['class' => 'form-control', 'placeholder' => __('messages.web.about_title'), 'required', 'id' => 'aboutTitleId']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_experience', __('messages.web.about_experience').':', ['class' => 'form-label required']) }}
        {{ Form::text('about_experience', $cmsData['about_experience'], ['class' => 'form-control', 'placeholder' => __('messages.doctor.experience'), 'required','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'id' => 'aboutExperienceId']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('about_short_description', __('messages.web.about_short_description').':', ['class' => 'form-label required']) }}
        {{ Form::textarea('about_short_description', $cmsData['about_short_description'], ['class' => 'form-control', 'placeholder' => __('messages.web.about_short_description'),'id' => 'cmsShortDescription', 'required', 'rows'=> 5]) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('term_condition', __('messages.cms.terms_conditions').':', ['class' => 'form-label required']) }}
        <div id="cmsTermConditionId" class="editor-height" style="height: 200px"></div>
        {{ Form::hidden('terms_conditions', null, ['id' => 'termData']) }}
    </div>
</div>
<div class="col-lg-12">
    <div class="mb-5">
        {{ Form::label('privacy_policy', __('messages.cms.privacy_policy').':', ['class' => 'form-label required']) }}
        <div id="cmsPrivacyPolicyId" class="editor-height" style="height: 200px"></div>
        {{ Form::hidden('privacy_policy', null, ['id' => 'privacyData']) }}
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary']) }}
</div>
</div>
