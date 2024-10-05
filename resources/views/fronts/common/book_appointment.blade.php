<div class="row">
            <div class="book-appointment-message"></div>
            <div class="container">
                @include('flash::message')
            </div>
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap mb-md-5 mb-3">
                <h4>{{ __('messages.web.book_appointment') }}</h4>
                <div class="form-check d-flex align-items-center mb-2 mt-2 mt-md-0 ms-auto">
                    <input class="form-check-input form-lg-check me-2" type="checkbox" value="1"
                           id="isPatientAccount" name="is_patient_account">
                    <label class="form-check-label text-gray-200 fw-light" for="isPatientAccount">
                        {{__('messages.web.already_have_patient_account')}}
                    </label>
                </div>
            </div>
            <div class="col-lg-6 name-details">
                <div class="form-group">
                    <label class="form-label" for="template-medical-first_name">{{ __('messages.patient.first_name') }}:<span
                                class="required"></span></label>
                    <input type="text" class="form-control" id="template-medical-first_name"
                           placeholder="{{ __('messages.doctor.first_name') }}" name="first_name" value="{{ isset(session()->get('data')['first_name']) ? session()->get('data')['first_name'] : '' }}">
                </div>
            </div>
            <div class="col-lg-6 name-details">
                <div class="form-group">
                    <label class="form-label" for="template-medical-last_name">{{ __('messages.patient.last_name') }}:<span
                            class="required"></span></label>
                    <input type="text" id="template-medical-last_name" name="last_name"
                           class="form-control" value="{{ isset(session()->get('data')['last_name']) ? session()->get('data')['last_name'] : '' }}" placeholder="{{ __('messages.doctor.last_name') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="template-medical-email">{{ __('messages.patient.email') }}:<span
                            class="required"></span></label>
                    <input type="email" id="template-medical-email" name="email"
                           class="form-control" value="{{ isset(session()->get('data')['email']) ? session()->get('data')['email'] : '' }}" placeholder="{{ __('messages.web.email') }}">
                </div>
            </div>
            <div class="col-lg-6 d-none registered-patient">
                <div class="form-group">
                    <label class="form-label" for="template-medical-first_name">{{ __('messages.web.patient_name') }}:</label>
                    <input type="text" id="patientName" readonly
                           class="form-control" value="" placeholder="{{ __('messages.web.patient_name') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="Doctor">{{ __('messages.doctor.doctor')}}: <span
                                class="required"></span></label>
                    {{ Form::select('doctor_id', $appointmentDoctors, isset(session()->get('data')['doctor_id']) ? session()->get('data')['doctor_id'] : '',['class' => 'form-select', 'id' => 'appointmentDoctorId', 'data-control'=>"select2",'placeholder' =>  __('messages.common.select_doctor')]) }}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="Service">{{ __('messages.appointment.service')}}: <span
                                class="required"></span></label>
                    {{ Form::select('service_id', isset(session()->get('data')['service']) ? session()->get('data')['service'] : [] , isset(session()->get('data')['service_id']) ? session()->get('data')['service_id'] : '',['class' => 'form-select', 'data-control'=>"select2", 'id'=> 'FrontAppointmentServiceId','placeholder' => __('messages.common.select_service') ]) }}
                </div>
            </div>
            <div class="col-md-6 mb-5">
                {{ Form::label('contact', __('messages.patient.contact_no').':', ['class' => 'form-label']) }}
                {{ Form::tel( 'contact',null,['class' => 'form-control',
                'placeholder' => __('messages.patient.contact_no'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber']) }}
                {{ Form::hidden('region_code',null,['id'=>'prefix_code'])  }}
                <span id="valid-msg" class="text-success d-none fw-400 fs-small mt-2">{{ __('messages.valid_number') }}</span>
                <span id="error-msg" class="text-danger d-none fw-400 fs-small mt-2">{{ __('messages.invalid_number') }}</span>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="templateAppointmentDate">{{ __('messages.appointment.appointment_date')}}: <span
                                class="required"></span></label>
                    <div class="position-relative">
                        <input type="text" id="templateAppointmentDate" name="date" class="form-control bg-white"
                               data-uk-datepicker-locale="fr"
                               value="{{  isset(session()->get('data')['date']) ? session()->get('data')['date'] : '' }}"
                               placeholder="{{ __('messages.doctor.select_date') }}" autocomplete="true" disabled
                               readonly>
                        <span class="position-absolute d-flex align-items-center top-0 bottom-0 end-0 me-4">
                             <i class="fa-solid fa-calendar-days text-gray-200"></i>
                        </span>
                    </div>
                </div>
            </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label class="form-label" for="Payment Type">{{ __('messages.appointment.payment_method')}}: <span
                    class="required"></span></label>
            {{ Form::select('payment_type', getAllPaymentStatus(), null,['class' => 'form-select', 'id'=>'paymentMethod', 'data-control'=>"select2",'placeholder' => __('messages.appointment.Select_payment_method') ]) }}
        </div>
    </div>
    @php
        $styleCss = 'style';
    @endphp
    <div class="col-12">
        <div class="form-group">
            <div class="d-flex align-items-center">
                        {{ Form::label('Available Slots',__('messages.appointment.available_slot').':' ,['class' => 'form-label me-3 required']) }}
                        <div class="d-flex align-items-center">
                            <div class="form-check d-flex align-items-center mb-2">
                                <input class="form-check-input form-check-danger me-2 mt-0"
                                       type="checkbox" value="" style="pointer-events: none;">
                                <label class="form-check-label fw-light fs-small"
                                       for="defaultCheck1">
                                    {{__('messages.appointment.booked')}}
                                </label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-2 ms-3">
                                <input class="form-check-input form-check-success me-2 mt-0"
                                       type="checkbox" value="" style="pointer-events: none;">
                                <label class="form-check-label fw-light fs-small"
                                       for="defaultCheck1">
                                    {{__('messages.appointment.available')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="slots-box">
                        {{ Form::hidden('from_time', null,['id'=>'timeSlot',]) }}
                        {{ Form::hidden('to_time', null,['id'=>'toTime',]) }}
                        <div class=" flex-wrap align-items-center front-slot-data appointment-slot-data"
                             id="slotData">
                            <p class="mb-0 text-center  no-time-slot">{{__('messages.appointment.no_slot_found')}}</p>
                        </div>
                        <p class="mb-0 text-center d-none no-time-slot">{{__('messages.appointment.no_slot_found')}}</p>
                    </div>
                </div>
            </div>
            <div class="text-center col-12">
                <p class="text-uppercase mb-sm-4 mb-0 d-none"
                   id="payableAmountText">{{__('messages.appointment.payable_amount')}} : <span class="fw-bold" id="payableAmount">{{__('messages.common.n/a')}}</span>
                </p>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-primary" type="submit" id="saveBtn"
                        value="submit">{{__('messages.web.confirm_booking')}}
                </button>
            </div>
</div>
