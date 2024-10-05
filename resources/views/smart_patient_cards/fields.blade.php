<div class="card main-div d-flex flex-xxl-row flex-column-reverse">
    <div class="col-xxl-5 col-12 p-5">
        <div class="row col-11 col-sm-8 col-md-6 col-xxl-10">
            <div class="mb-5">
                {{ Form::label('template_name', __('messages.smart_patient_card.templat_name').':', ['class' => 'form-label required']) }}
                {{ Form::text('template_name', isset($smart_patient_cards) ? $smart_patient_cards->template_name : null, ['class' => 'form-control', 'id' => 'template_name', 'placeholder' => __('messages.smart_patient_card.enter_template_name'), 'required']) }}
            </div>
            <div class="mb-5">
                {{ Form::label('header_color', __('messages.smart_patient_card.header_color').':', ['class' => 'form-label required']) }} <br>
                {{ Form::color('header_color', isset($smart_patient_cards) ? $smart_patient_cards->header_color : null, ['class' => '', 'id' => 'header_color', 'placeholder' => '', 'required']) }}
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.email_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_email" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_email == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_email_switch">
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.phone_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_phone" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_phone == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_phone_switch" >
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.dob_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_dob" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_dob == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_dob_switch" >
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.blood_group_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_blood_group" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_blood_group == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_blood_group_switch" >
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.address_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_address" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_address == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_address_switch" >
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="form-label">{{__('messages.smart_patient_card.unique_id_show').':'}}</label>
                <div class="col-lg-8">
                    <div class="form-check form-check-solid form-switch">
                        <input tabindex="12" name="show_patient_unique_id" value="1"
                            {{ isset($smart_patient_cards) && $smart_patient_cards->show_patient_unique_id == 1 ? 'checked' : '' }}
                            {{ !isset($smart_patient_cards) ? 'checked' : '' }}
                            class="form-check-input" type="checkbox" id="card_show_patient_unique_id_switch" >
                        <label class="form-check-label" for="allowmarketing"></label>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
                <a href="{{ route('smart-patient-cards.index') }}" type="reset"
                    class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
            </div>
        </div>


    </div>
    <div class="col-xxl-7 col-12 bg-secondary p-5">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card smart-card-tem-body" id="card">
                <div class="card-header smart-card-header d-flex flex-xxl-row flex-column align-items-center">
                    <div class="flex-1 d-flex align-items-center me-3">
                        <div class="logo me-4">
                            <img src="{{ url($logo[0]) }}" alt="logo" class="h-100 img-fluid" />
                        </div>
                        <h4 class="text-white mb-0 fw-bold">{{ $clinic_name }}</h4>
                    </div>
                    <div class="flex-1 text-end">
                        <address class="text-white fs-12 mb-0">
                            <p class="mb-0">
                                {{$address_one}}
                            </p>
                        </address>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-md-row flex-column justify-content-between">
                        <div class="">
                            <div class="d-flex flex-md-row flex-column mb-3">
                                <div class="card-img me-3">
                                    <img src="{{ !empty($smart_patient_cards->profile_image) ? $smart_patient_cards->profile_image : asset('web/media/avatars/male.png') }}"
                                        alt="profile-img" class="object-fit-cover" id="card_profilePicture"
                                        width="110px" />
                                </div>

                                <div class="">
                                    <table class="table table-borderless patient-desc mb-0">
                                        <tr>
                                            <td class="pe-3">{{__('messages.web.patient_name').':'}}</td>
                                            <td id="card_name">James Bond</td>
                                        </tr>
                                        <tr id="card_show_email" style="word-break: break-all" class=" @if (isset($smart_patient_cards) && $smart_patient_cards->show_email != 1) d-none @endif ">
                                            <td class="pe-3">{{__('messages.web.email').':'}}</td>
                                            <td>example@gmail.com</td>
                                        </tr>
                                        <tr id="card_show_phone" class=" @if (isset($smart_patient_cards) && $smart_patient_cards->show_phone != 1) d-none @endif ">
                                            <td class="pe-3">{{__('messages.web.contact').':'}}</td>
                                            <td>1234567890</td>
                                        </tr>
                                        <tr id="card_show_dob" class=" @if (isset($smart_patient_cards) && $smart_patient_cards->show_dob != 1) d-none @endif ">
                                            <td class="pe-3">{{__('messages.patient.dob').':'}}</td>
                                            <td>25/02/2006</td>
                                        </tr>
                                        <tr id="card_show_blood_group" class=" @if (isset($smart_patient_cards) && $smart_patient_cards->show_blood_group != 1) d-none @endif ">
                                            <td class="pe-3">{{__('messages.patient.blood_group').':'}}</td>
                                            <td>A+</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="card_show_address" class=" @if (isset($smart_patient_cards) && $smart_patient_cards->show_address != 1) d-none @endif ">
                                <div class="d-flex address-text me-5" >
                                    <div class="mb-0 me-3">{{__('messages.setting.address').':'}}</div>
                                    <div>
                                        <address class="mb-0" id="card-address">
                                            D.No.1 Street name Address line 2 line 3
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="qr-main-div w-25 mt-5">
                            <div class="text-end mb-5">
                                <div class="qr-code ms-auto">
                                    <img src="{{url('assets/image/qr-code.svg')}}" class="w-100 h-100 object-fit-cover" />
                                </div>
                            </div>
                            <h6 class="text-end mb-3 patient_unique_id @if (isset($smart_patient_cards) && $smart_patient_cards->show_patient_unique_id != 1) d-none @endif" id="card_show_patient_unique_id">{{__('messages.id').':'}}1001
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
