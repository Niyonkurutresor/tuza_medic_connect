    <div class="row">
    <div class="col-md-6 mb-5">
        {{ Form::label('firstName',__('messages.patient.first_name').':' ,['class' => 'form-label required']) }}
        {{ Form::text('first_name',!empty($patient->user) ? $patient->user->first_name : null,['class' => 'form-control','placeholder' => __('messages.patient.first_name'),'required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('lastName',__('messages.patient.last_name').':' ,['class' => 'form-label required']) }}
        {{ Form::text('last_name',!empty($patient->user) ? $patient->user->last_name : null,['class' => 'form-control','placeholder' => __('messages.patient.last_name'),'required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('patientUniqueId',__('messages.patient.patient_unique_id').':' ,['class' => 'form-label required']) }}
        {{ Form::text('patient_unique_id',isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null,['class' => 'form-control','required','maxLength' => '8','readonly']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('email',__('messages.patient.email').':' ,['class' => 'form-label required']) }}
        {{ Form::email('email',!empty($patient->user) ? $patient->user->email : null,['class' => 'form-control','placeholder' => __('messages.patient.email'),'required']) }}
    </div>
    @if(empty($patient))
        <div class="col-md-6 mb-5">
            <div class="mb-1">
                {{ Form::label('password',__('messages.patient.password').':' ,['class' => 'form-label required']) }}
                <span data-bs-toggle="tooltip" title="{{ __('messages.flash.user_8_or') }}">
                <i class="fa fa-question-circle"></i></span>
                <div class="mb-3 position-relative">
                    {{Form::password('password',['class' => 'form-control','placeholder' => __('messages.patient.password'),'autocomplete' => 'off','required','aria-label'=>"Password",'data-toggle'=>"password"])}}
                    <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"> <i class="bi bi-eye-slash-fill"></i> </span>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-5">
                <div class="mb-1">
                    {{ Form::label('confirmPassword',__('messages.patient.confirm_password').':' ,['class' => 'form-label required']) }}
                    <span data-bs-toggle="tooltip"
                          title="{{ __('messages.flash.user_8_or') }}">
                    <i class="fa fa-question-circle"></i></span>
                    <div class="mb-3 position-relative">
                        {{Form::password('password_confirmation',['class' => 'form-control','placeholder' => __('messages.user.confirm_password'),'autocomplete' => 'off','required','aria-label'=>"Password",'data-toggle'=>"password"])}}
                        <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4 input-icon input-password-hide cursor-pointer text-gray-600"> <i class="bi bi-eye-slash-fill"></i> </span>
                    </div>
                </div>
        </div>
    @endif
    <div class="col-md-6 mb-5">
        {{ Form::label('contact', __('messages.patient.contact_no').':', ['class' => 'form-label']) }}
        {{ Form::tel('contact', !empty($patient->user) ? '+'.$patient->user->region_code.$patient->user->contact : null, ['class' => 'form-control',
            'placeholder' => __('messages.patient.contact_no'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',!empty($patient->user) ? $patient->user->region_code : null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
        <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('gender', __('messages.staff.gender').':', ['class' => 'form-label required']) }}
        <span class="is-valid">
            <div class="mt-2">
                <input class="form-check-input" type="radio" name="gender" value="1" checked
                        {{ !empty($patient->user) && $patient->user->gender === 1 ? 'checked' : '' }} >
                <label class="form-label">{{ __('messages.staff.male') }}</label>&nbsp;&nbsp;
                <input class="form-check-input" type="radio" name="gender" value="2"
                        {{ !empty($patient->user) && $patient->user->gender === 2 ? 'checked' : '' }} >
                <label class="form-label">{{ __('messages.staff.female') }}</label>
            </div>
        </span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('dob',__('messages.patient.dob').':' ,['class' => 'form-label']) }}
        {{ Form::text('dob',!empty($patient->user) ? $patient->user->dob : null,['class' => 'form-control patient-dob','id' => __('messages.patient.dob'), 'placeholder' => __('messages.doctor.dob')]) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $data['bloodGroupList'] ,!empty($patient->user) ? $patient->user->blood_group : null, ['placeholder' => __('messages.patient.blood_group'),'class' => 'form-select io-select2', 'aria-label'=>"Select a Blood Group",'data-control'=>'select2']) }}
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mt-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.patient.profile')}}:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url({{ !empty($patient->profile) ? $patient->profile : asset('web/media/avatars/male.png') }})">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{ __('messages.user.edit_profile') }}">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" name="profile" id="profilePicture" class="image-upload d-none profile-validation" accept="image/*" />
                        </label>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="fw-bolder fs-3 mb-7 mt-5">{{ __('messages.patient.address_information') }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('address1',__('messages.patient.address1').':' ,['class' => 'form-label']) }}
        {{ Form::text('address1',!empty($patient->address) ? $patient->address->address1 : null,['class' => 'form-control','placeholder' => __('messages.patient.address1')]) }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('address2',__('messages.patient.address2').':' ,['class' => 'form-label']) }}
        {{ Form::text('address2',!empty($patient->address) ? $patient->address->address2 : null,['class' => 'form-control','placeholder' => __('messages.patient.address2')]) }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('country_id',__('messages.country.country').':',['class'=>'form-label']) }}
        {{ Form::select('country_id', $data['countries'] ,null, ['id' => 'patientCountryId','data-placeholder' => __('messages.country.country'),'class' => 'form-select io-select2', 'aria-label'=>"Select a Country",
        'data-control'=>'select2']) }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('state_id',__('messages.state.state').':',['class'=>'form-label']) }}
        {{ Form::select('state_id', [], null, ['id' => 'patientStateId','class' => 'form-select io-select2',
'data-placeholder' => __('messages.common.select_state'),'aria-label'=>"Select State",'data-control'=>'select2']) }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('city_id',__('messages.city.city').':',['class'=>'form-label']) }}
        {{ Form::select('city_id', [], null, ['id' => 'patientCityId','class' => 'form-select io-select2', 'data-placeholder' => __('messages.common.select_city'),'aria-label'=>"Select City",'data-control'=>'select2']) }}
    </div>
    <div class="col-md-6 mb-7">
        {{ Form::label('postalCode',__('messages.patient.postal_code').':' ,['class' => 'form-label']) }}
        {{ Form::text('postal_code',!empty($patient->address) ? $patient->address->postal_code : null,['class' => 'form-control','placeholder' => __('messages.patient.postal_code')]) }}
    </div>
    <div>
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
        <a href="{{route('patients.index')}}" type="reset"
           class="btn btn-secondary">{{__('messages.common.discard')}}</a>
    </div>
</div>
