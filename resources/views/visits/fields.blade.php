<div class="row">
    <div class="col-lg-6">
        <div class="mb-5">
            {{ Form::label('visit_date', __('messages.visit.visit_date').':', ['class' => 'form-label required']) }}
            {{ Form::text('visit_date', isset($visit) ? $visit['visit_date'] : null, ['class' => 'form-control visit-date', 'id' => isset($visit) ? 'editDate' : 'date','placeholder' => __('messages.visit.visit_date')]) }}
        </div>
    </div>
    @role('doctor')
    {{ Form::hidden('doctor_id',getLoginUser()->doctor->id) }}
    @else
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('Doctor',__('messages.doctor.doctor').':' ,['class' => 'form-label required']) }}
                {{ Form::select('doctor_id', $data['doctors'], isset($visit['doctor_id']) ? $visit['doctor_id'] : null,['class' => 'form-select io-select2', 'data-control'=>'select2', 'id'=>'doctorId','placeholder' => __('messages.doctor.doctor')]) }}
            </div>
        </div>
        @endrole
        <div class="col-lg-6">
            <div class="mb-5">
                {{ Form::label('Patient',__('messages.appointment.patient').':' ,['class' => 'form-label required']) }}
                {{ Form::select('patient_id', $data['patients'], isset($data['patientUniqueId']) ? $data['patientUniqueId'] : null,['class' => 'form-select io-select2', 'data-control'=>'select2','placeholder' => __('messages.appointment.patient')]) }}
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            {{ Form::label('Description',__('messages.appointment.description').':' ,['class' => 'form-label']) }}
            {{  Form::textarea('description', null, ['class'=> 'form-control','rows'=> 5,'placeholder'=>__('messages.appointment.description') ])}}
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary" id="btnSubmit">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
            <a href="{{ getLogInUser()->hasRole('doctor') ? route('doctors.visits.index') : route('visits.index') }}"
                type="reset"
               class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
        </div>
</div>

