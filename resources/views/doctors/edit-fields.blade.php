<div class="row">
    <div class="col-md-6 mb-5">
        {{ Form::label('First Name',__('messages.doctor.first_name').':' ,['class' => 'form-label required']) }}
        {{ Form::text('first_name', $user->first_name,['class' => 'form-control','placeholder' => __('messages.doctor.first_name'),'required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Last Name',__('messages.doctor.last_name').':' ,['class' => 'form-label required']) }}
        {{ Form::text('last_name', $user->last_name,['class' => 'form-control','placeholder' => __('messages.doctor.last_name'),'required']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Email',__('messages.user.email').':' ,['class' => 'form-label required']) }}
        {{ Form::email('email', $user->email,['class' => 'form-control','placeholder' =>  __('messages.web.email')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Contact',__('messages.user.contact_number').':' ,['class' => 'form-label']) }}
        {{ Form::tel('contact', '+'.$user->region_code.$user->contact,['class' => 'form-control','placeholder' =>  __('messages.patient.contact_no'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
        {{ Form::hidden('region_code',!empty($user->user) ? $user->user->region_code : null,['id'=>'prefix_code']) }}
        <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
        <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('DOB',__('messages.doctor.dob').':' ,['class' => 'form-label']) }}
        {{ Form::text('dob', $user->dob,['class' => 'form-control doctor-dob','placeholder' => __('messages.doctor.dob'), 'id'=>'dob']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Specialization',__('messages.doctor.specialization').':' ,['class' => 'form-label required']) }}
        {{ Form::select('specializations[]',$data['specializations'], $data['doctorSpecializations'],['class' => 'io-select2 form-select', 'data-control'=>"select2", 'multiple']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Experience', __('messages.doctor.experience').':', ['class' => 'form-label']) }}
        {{ Form::text('experience', $doctor->experience, ['class' => 'form-control', 'placeholder' => __('messages.doctor.experience'),'step'=>'any']) }}
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label required">
            {{__('messages.doctor.select_gender')}}
            :
        </label>
        <span class="is-valid">
                <div class="mt-2">
                    <input class="form-check-input" type="radio" name="gender" value="1" {{ !empty($user->gender) && $user->gender === 1 ? 'checked' : '' }}>
                    <label class="form-label mr-3">{{__('messages.doctor.male')}}</label>
                    <input class="form-check-input ms-2" type="radio" name="gender" value="2" {{ !empty($user->gender) && $user->gender === 2 ? 'checked' : ''}}>
                    <label class="form-label mr-3">{{__('messages.doctor.female')}}</label>
                </div>
            </span>
    </div>
    <div class="col-md-6 mb-5">
        <label class="form-label">{{ __('messages.patient.blood_group').':' }}</label>
        {{ Form::select('blood_group', $bloodGroup , $user->blood_group, ['class' => 'io-select2 form-select', 'data-control'=>"select2",'placeholder' => __('messages.doctor.select_blood_group')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('twitter',__('messages.doctor.twitter').':' ,['class' => 'form-label']) }}
        {{ Form::text('twitter_url', !empty($doctor->twitter_url) ? $doctor->twitter_url : null,['class' => 'form-control','placeholder' =>  __('messages.common.twitter_url'),'id' => 'twitterUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('linkedin',__('messages.doctor.linkedin').':' ,['class' => 'form-label']) }}
        {{ Form::text('linkedin_url', !empty($doctor->linkedin_url) ? $doctor->linkedin_url : null,['class' => 'form-control','placeholder' =>  __('messages.common.linkedin_url'), 'id' => 'linkedinUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('instagram',__('messages.doctor.instagram').':' ,['class' => 'form-label']) }}
        {{ Form::text('instagram_url', !empty($doctor->instagram_url) ? $doctor->instagram_url : null,['class' => 'form-control','placeholder' =>  __('messages.common.instagram_url'), 'id' => 'instagramUrl']) }}
    </div>
    <div class="col-md-6 mb-5">
        <div class="mb-3" io-image-input="true">
            <label for="exampleInputImage" class="form-label">{{__('messages.doctor.profile')}}:</label>
            <div class="d-block">
                <div class="image-picker">
                    <div class="image previewImage" id="exampleInputImage" style="background-image: url({{ !empty($user->profile_image) ? $user->profile_image : asset('web/media/avatars/male.png') }})">
                    </div>
                    <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                          data-placement="top" data-bs-original-title="{{__('messages.user.edit_profile')}}">
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
            <input name="status" class="form-check-input checkBoxClass"
                   type="checkbox" {{$user->status == 1 ? 'checked' : ''}}>
            <label class="form-check-label" for="allowmarketing"></label>
        </div>
    </div>
</div>
<div class="row gx-10 mb-5">
    <div class="col-md-6 mb-5">
        {{ Form::label('Address 1', __('messages.doctor.address1').':', ['class' => 'form-label']) }}
        {{ Form::text('address1', isset($user->address->address1) ? $user->address->address1 : '', ['class' => 'form-control', 'placeholder' =>  __('messages.doctor.address1')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Address 2', __('messages.doctor.address2').':', ['class' => 'form-label']) }}
        {{ Form::text('address2', isset($user->address->address2) ? $user->address->address2 : '', ['class' => 'form-control', 'placeholder' =>  __('messages.doctor.address2')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('Country',__('messages.doctor.country').':' ,['class' => 'form-label']) }}
        {{ Form::select('country_id', $countries, isset($user->address->country_id) ? $user->address->country_id:null,
['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=>'editDoctorCountryId','placeholder' => __('messages.common.select_country')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('State',__('messages.doctor.state').':' ,['class' => 'form-label']) }}
        {{ Form::select('state_id', (isset($state) && $state!=null) ? $state:[], isset($user->address->state_id) ? $user->address->state_id:null, ['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'editDoctorStateId','placeholder' => __('messages.common.select_state')]) }}
    </div>
    <div class="col-md-6 mb-5">
        {{ Form::label('City',__('messages.doctor.city').':' ,['class' => 'form-label']) }}
        {{ Form::select('city_id', (isset($cities) && $cities!=null) ? $cities:[], isset($user->address->city_id) ? $user->address->city_id:null, ['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'editDoctorCityId','placeholder' => __('messages.common.select_city')]) }}
    </div>
    <div class="col-md-6">
        {{ Form::label('Postal Code', __('messages.doctor.postal_code').':', ['class' => 'form-label']) }}
        {{ Form::text('postal_code', isset($user->address->postal_code) ? $user->address->postal_code : '', ['class' => 'form-control', 'placeholder' => __('messages.doctor.postal_code')]) }}
    </div>
</div>
<div>
    <div class="fw-bolder fs-3 rotate collapsible mb-4">{{ __('messages.doctor.qualification_information') }}
    </div>
    <a class="btn btn-primary float-end mb-4" id="addQualification">{{__('messages.doctor.add_qualification')}}</a>
</div>
<input type="hidden" name="deletedQualifications" value="" id="deletedQualifications">
<div class="row showQualification w-100">
    <div class="col-md-4 mb-5">
        {{ Form::label('Degree', __('messages.doctor.degree').':', ['class' => 'form-label required']) }}
        {{ Form::text('degree', null, ['class' => 'form-control degree', 'placeholder' => __('messages.doctor.degree'), 'id'=>'degree']) }}
    </div>
    <div class="col-md-4 mb-5">
        {{ Form::label('university', __('messages.doctor.university').':', ['class' => 'form-label required']) }}
        {{ Form::text('university', null, ['class' => 'form-control university', 'placeholder' => __('messages.doctor.university'), 'id'=>'university']) }}
    </div>
    <div class="col-md-4 mb-5">
        <label class="form-label required">{{__('messages.doctor.year')}}:</label>
        {{ Form::select('year', $years,!empty($qualifications->year) ? $qualifications->year : null, ['class' => 'io-select2 form-select year', 'data-control'=>"select2", 'id'=> 'year', 'placeholder' =>  __('messages.doctor.select_year')]) }}
    </div>
    <div class="mb-5 col-md-4">
        <button type="button" class="btn btn-primary me-3"
                id="saveQualification">{{__('messages.common.save')}}</button>
        <button type="button" class="btn btn-secondary"
                id="cancelQualification">{{__('messages.common.discard')}}</button>
    </div>
</div><br>
<div class="table-responsive-sm w-100 mt-4">
    <table class="table table-row-dashed table-row-gray-300 gy-7 align-middle" id="doctorQualificationTbl">
        <thead>
        <tr class="fw-bolder fs-6 text-gray-800">
            <th>{{Str::upper(__('messages.doctor.sr_no'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.degree'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.collage_university'))}}</th>
            <th>{{ Str::upper(__('messages.doctor.year'))}}</th>
            <th class="text-center">{{ Str::upper(__('messages.common.action'))}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($qualifications as $index => $qualification)
            <tr>
                <td id="qualificationId" data-value="{{ $index+1 }}">{{$index+1}}</td>
                <td id="degreeTd">{{$qualification->degree}}</td>
                <td id="universityTd">{{$qualification->university}}</td>
                <td id="yearTd">{{$qualification->year}}</td>
                <td class="text-center whitespace-nowrap">
                    <div class="d-flex justify-content-center">
                        <a data-id="{{$index+1}}" data-primary-id="{{$qualification->id}}" title="{{ __('messages.common.edit') }}"
                           class="btn edit-btn-qualification btn-icon px-1 fs-3 text-primary" data-bs-toggle="tooltip"
                           data-bs-original-title="{{ __('messages.common.edit') }}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a data-id="{{$qualification->id}}" title="{{ __('messages.common.delete') }}" class="delete-btn-qualification btn btn-icon px-1 fs-3 text-danger"  data-bs-toggle="tooltip"
                           data-bs-original-title="{{ __('messages.common.delete') }}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex mt-4">
    <button type="submit" class="btn btn-primary">{{__('messages.common.save')}}</button>&nbsp;&nbsp;&nbsp;
    <a href="{{route('doctors.index')}}" type="reset" id="ResetForm"
       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
</div>
