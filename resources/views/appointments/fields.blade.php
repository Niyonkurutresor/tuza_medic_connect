<div class="row">
    @role('doctor')
    {{Form::hidden('doctorRole',getLogInUser()->hasRole('doctor'),['id' => 'doctorRole'])}}
        {{ Form::hidden('doctor_id', getLogInUser()->doctor->id ,['id' => 'adminAppointmentDoctorId']) }}
        {{ Form::hidden('status',\App\Models\Appointment::BOOKED) }}
        @else
        <div class="col-sm-12 col-lg-6 mb-5">
            {{ Form::label('Doctor',__('messages.doctor.doctor').':' ,['class' => 'form-label required']) }}
            {{ Form::select('doctor_id', $data['doctors'], null,['class' => 'io-select2 form-select', 'id' => 'adminAppointmentDoctorId', 'data-control'=>"select2", 'required','placeholder' => __('messages.doctor.doctor')]) }}
        </div>
    @endrole

    <div class="col-lg-6 mb-5 col-sm-12">
        {{ Form::label('Date',__('messages.appointment.date').':' ,['class' => 'form-label required']) }}
        {{ Form::text('date', null,['class' => 'form-control date','placeholder' => __('messages.appointment.date'), 'id'=>'appointmentDate', 'required','autocomplete'=>'off']) }}
    </div>

    @role('patient')
    {{Form::hidden('patient_id',getLogInUser()->patient->id,['id' => 'patientRole'])}}
    {{ Form::hidden('status',\App\Models\Appointment::BOOKED) }}
    @else
        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Service',__('messages.appointment.service').':' ,['class' => 'form-label required']) }}
            {{ Form::select('service_id', $data['services'], null,['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'appointmentServiceId','placeholder' => __('messages.appointment.service'),'required']) }}
        </div>
            {{ Form::hidden('status',\App\Models\Appointment::BOOKED) }}
        <div class="col-sm-12 col-lg-6 mb-5">
            {{ Form::label('Patient',__('messages.appointment.patient').':' ,['class' => 'form-label required']) }}
            {{ Form::select('patient_id', $data['patients'], null,['class' => 'io-select2 form-select', 'data-control'=>"select2",'placeholder' => __('messages.appointment.patient')]) }}
        </div>
        @endrole
        @php
            $styleCss = 'style';
        @endphp
        <div class="col-12 form-group">
            {{ Form::label('Available Slots',__('messages.appointment.available_slot').':' ,['class' => 'form-label required']) }}
            <div class="mb-0 d-inline-flex align-items-center ms-2">
                <span class="badge bg-danger badge-circle slot-color-dot"></span>
                <span class="ms-2">{{__('messages.appointment.booked')}}</span>
                <span class="badge bg-success ms-2 badge-circle slot-color-dot"></span>
                <span class="ms-2">{{__('messages.appointment.available')}}</span>
        </div>
<div class="fc-timegrid-slot ps-5 pe-5 form-control form-control-solid h-300px overflow-auto">
    {{ Form::hidden('from_time', null,['id'=>'timeSlot',]) }}
    {{ Form::hidden('to_time', null,['id'=>'toTime',]) }}
    <div class="text-center d-flex flex-wrap justify-content-center px-3 appointment-slot-data" id="slotData">
    </div>
    <span class="justify-content-center d-flex p-20 text-primary no-time-slot">{{__('messages.appointment.no_slot_found')}}</span>
    <span class="justify-content-center d-flex p-20 text-primary d-none doctor-time-over">{{__('messages.doctors_scheduled_time_ended_for_today__')}}</span>
</div>
</div>
<div class="col-12 mb-5 mt-5">
    {{ Form::label('Description',__('messages.appointment.description').':' ,['class' => 'form-label']) }}
    {{  Form::textarea('description', null, ['class'=> 'form-control','rows'=> 10,'placeholder'=>__('messages.appointment.description') ])}}
</div>
@role('patient')
<div class="col-lg-6 col-sm-12 mb-5">
    {{ Form::label('Service',__('messages.appointment.service').':' ,['class' => 'form-label required']) }}
    {{ Form::select('service_id', [], null,['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id'=> 'appointmentServiceId','placeholder' => __('messages.common.select_service'),'required']) }}
</div>
@endrole
<div class="col-lg-6 col-sm-12 mb-5">
    {{ Form::label('Payment Type',__('messages.appointment.payment_method').':' ,['class' => 'form-label required']) }}
    {{ Form::select('payment_type', getAllPaymentStatus(), null,['class' => 'io-select2 form-select', 'data-control'=>"select2",'placeholder' => __('messages.appointment.payment_method')]) }}
</div>
<div class="col-lg-6 col-sm-12 mb-5">
    {{ Form::label('Charge',__('messages.appointment.charge').':' ,['class' => 'form-label required']) }}
    <div class="input-group">
        {{ Form::text('charge', null,['class' => 'form-control','placeholder' => __('messages.doctor.select_date'), 'id'=>'chargeId', 'required', 'placeholder' => __('messages.appointment.charge'),'readonly']) }}
        <div class="input-group-text">
            <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
        </div>
    </div>
</div>
@if(!getLogInUser()->hasRole('patient'))
        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Add Fees',__('messages.appointment.extra_fees').':' ,['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::text('add_fees',null,['class' => 'form-control', 'id' => 'addFees', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")',
                        'placeholder' => __('messages.appointment.extra_fees'),'step'=>'any']) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-5">
            {{ Form::label('Total Payable Amount',__('messages.appointment.total_payable_amount').':' ,['class' => 'form-label required']) }}
            <div class="input-group">
                {{ Form::text('payable_amount', null,['class' => 'form-control','placeholder' => __('messages.appointment.total_payable_amount'), 'id'=>'payableAmount', 'required', 'placeholder' => __('messages.appointment.total_payable_amount'), 'readonly']) }}
                <div class="input-group-text">
                    <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
                </div>
            </div>
        </div>
@endif
@if(getLogInUser()->hasRole('patient'))
    <div class="col-lg-6 col-sm-12 mb-5">
        {{ Form::label('Total Payable Amount',__('messages.appointment.total_payable_amount').':' ,['class' => 'form-label required']) }}
        <div class="input-group">
            {{ Form::text('payable_amount', null,['class' => 'form-control','placeholder' => __('messages.appointment.total_payable_amount'), 'id'=>'payableAmount', 'required', 'placeholder' => __('messages.appointment.total_payable_amount'), 'readonly']) }}
            <div class="input-group-text">
                <a class="fw-bolder text-gray-500 text-decoration-none">{{ getCurrencyIcon() }}</a>
            </div>
        </div>
    </div>
@endif
<div class="d-flex">
    {{ Form::button(__('messages.common.save'),['type' => 'submit','class' => 'btn btn-primary me-2 submitAppointmentBtn' ]) }}
    &nbsp;
    <a href="{{ url()->previous() }}" type="reset"
       class="btn btn-secondary">{{__('messages.common.discard')}}</a>
</div>
</div>
