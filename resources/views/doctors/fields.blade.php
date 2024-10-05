<div class="row">
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('First Name',__('messages.doctor.first_name').':' ,['class' => 'form-label required']) }}
            {{ Form::text('first_name', null,['class' => 'form-control','placeholder' => __('messages.doctor.first_name'),'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('Last Name',__('messages.doctor.last_name').':' ,['class' => 'form-label required']) }}
            {{ Form::text('last_name', null,['class' => 'form-control','placeholder' => __('messages.doctor.last_name'),'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('Email',__('messages.user.email').':' ,['class' => 'form-label required']) }}
            {{ Form::email('email', null,['class' => 'form-control','placeholder' => __('messages.user.email')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('Contact',__('messages.user.contact_number').':' ,['class' => 'form-label']) }}
            {{ Form::tel('contact', null,['class' => 'form-control','placeholder' => __('messages.user.contact_number'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
            {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}
            <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
            <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="mb-1">
            {{ Form::label('password',__('messages.staff.password').':' ,['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip" title="{{ __('messages.flash.user_8_or') }}">
                <i class="fa fa-question-circle"></i>
            </span>
            <div class="mb-3 position-relative">
                {{Form::password('password',['class' => 'form-control','placeholder' => __('messages.staff.password'),'autocomplete' => 'off','required','aria-label'=>"Password",'data-toggle'=>"password"])}}
                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"> <i class="bi bi-eye-slash-fill"></i> </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <div class="mb-1">
            {{ Form::label('Confirm Password',__('messages.user.confirm_password').':' ,['class' => 'form-label required']) }}
            <span data-bs-toggle="tooltip" title="{{ __('messages.flash.user_8_or') }}">
                <i class="fa fa-question-circle"></i>
            </span>
            <div class="mb-3 position-relative">
                {{Form::password('password_confirmation',['class' => 'form-control','placeholder' => __('messages.user.confirm_password'),'autocomplete' => 'off','required','aria-label'=>"Password",'data-toggle'=>"password"])}}
                <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"> <i class="bi bi-eye-slash-fill"></i> </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('DOB',__('messages.doctor.dob').':' ,['class' => 'form-label']) }}
            {{ Form::text('dob', null,['class' => 'form-control doctor-dob','placeholder' => __('messages.doctor.dob'), 'id'=>'dob']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('Specialization',__('messages.doctor.specialization').':' ,['class' => 'form-label required']) }}
            {{ Form::select('specializations[]',$specializations, null,['class' => 'io-select2 form-select', 'data-control'=>"select2", 'multiple', 'data-placeholder' => __('messages.doctor.specialization')]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            {{ Form::label('Experience',__('messages.doctor.experience').':' ,['class' => 'form-label']) }}
            {{ Form::text('experience', null,['class' => 'form-control','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','placeholder' => __('messages.doctor.experience'),'step'=>'any']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-5">
            <label class="form-label required">
                {{__('messages.doctor.select_gender')}}
                :
            </label>
            <span class="is-valid">
                <div class="mt-2">
                    <input class="form-check-input" type="radio" checked name="gender" value="1">
                    <label class="form-label mr-3">{{__('messages.doctor.male')}}</label>
                    <input class="form-check-input ms-2" type="radio" name="gender" value="2">
                    <label class="form-label mr-3">{{__('messages.doctor.female')}}</label>
                </div>
            </span>
        </div>
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $bloodGroup , null, ['class' => 'io-select2 form-select', 'data-control'=>"select2",'placeholder' => __('messages.patient.blood_group')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('twitter',__('messages.doctor.twitter').':' ,['class' => 'form-label']) }}
        {{ Form::text('twitter_url', null,['class' => 'form-control','placeholder' => __('messages.common.twitter_url'), 'id' => 'twitterUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('linkedin',__('messages.doctor.linkedin').':' ,['class' => 'form-label']) }}
        {{ Form::text('linkedin_url', null,['class' => 'form-control','placeholder' => __('messages.common.linkedin_url'), 'id' => 'linkedinUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('instagram',__('messages.doctor.instagram').':' ,['class' => 'form-label']) }}
        {{ Form::text('instagram_url', null,['class' => 'form-control','placeholder' => __('messages.common.instagram_url'), 'id' => 'instagramUrl']) }}
    </div>
    <div class="col-lg-6">
        <div class="mb-5">
            <div class="mb-3" io-image-input="true">
                <label for="exampleInputImage" class="form-label">{{__('messages.doctor.profile')}}:</label>
                <div class="d-block">
                    <div class="image-picker">
                        <div class="image previewImage" id="exampleInputImage" style="background-image: url({{ !empty($service->icon) ? $service->icon : asset('web/media/avatars/male.png') }})">
                        </div>
                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                              data-placement="top" data-bs-original-title="{{ __('messages.user.edit_profile') }}">
                        <label> 
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i> 
                            <input type="file" id="profilePicture" name="profile" class="image-upload d-none profile-validation" accept="image/*" /> 
                        </label> 
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="col-md-6 mb-5">
    <label class="form-label">{{__('messages.doctor.status')}}:</label>
    <div class="col-lg-8">
        <div class="form-check form-check-solid form-switch">
            <input tabindex="12" name="status" value="0" class="form-check-input" type="checkbox"
                   id="allowmarketing" checked="checked">
            <label class="form-check-label" for="allowmarketing"></label>
        </div>
    </div>
</div>
<div class="fw-bolder fs-3 rotate collapsible mb-7">
    {{__('messages.doctor.address_information')}}
</div>
<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('Address1',__('messages.doctor.address1').':' ,['class' => 'form-label']) }}
        {{ Form::text('address1', null,['class' => 'form-control','placeholder' => __('messages.doctor.address1')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Address2',__('messages.doctor.address2').':' ,['class' => 'form-label']) }}
        {{ Form::text('address2', null,['class' => 'form-control','placeholder' => __('messages.doctor.address2')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Country',__('messages.doctor.country').':' ,['class' => 'form-label']) }}
        {{ Form::select('country_id', $country, null,['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=>'editDoctorCountryId','placeholder' => __('messages.doctor.country')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('State',__('messages.doctor.state').':' ,['class' => 'form-label']) }}
        {{ Form::select('state_id', [], null,['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'editDoctorStateId','placeholder' => __('messages.doctor.state')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('City',__('messages.doctor.city').':' ,['class' => 'form-label']) }}
        {{ Form::select('city_id', [], null,['class' => 'io-select2 form-select', 'data-control'=>'select2', 'id'=> 'editDoctorCityId','placeholder' => __('messages.doctor.city')]) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{__('messages.doctor.postal_code')}}:</label>
        {{ Form::text('postal_code',null,['class' => 'form-control','placeholder' => __('messages.doctor.postal_code')]) }}
    </div>
</div>
<div class="d-flex">
    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
    <a href="{{route('doctors.index')}}" type="reset"
       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
</div>
