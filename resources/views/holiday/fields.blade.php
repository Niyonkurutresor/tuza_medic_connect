<div>
    <div class="row">
        {{Form::hidden('doctor_id',$doctorId,['class'=>'adminAppointmentDoctorId'])}}
        <div class="mb-5 col-6">
            {{ Form::label('date',__('messages.appointment.date').':' ,['class' => 'form-label required']) }}
            {{ Form::text('date', null,['class' => 'form-control','placeholder' => __('messages.appointment.date') ,'id' =>'doctorHolidayDate']) }}
        </div>
        <div class="mb-5 col-6">
            {{ Form::label('name',__('messages.web.reason').':' ,['class' => 'form-label']) }}
            {{ Form::text('name', null,['class' => 'form-control','placeholder' => __('messages.web.reason')]) }}
        </div>
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary" id="btnSubmit">{{ __('messages.common.save') }}</button>&nbsp;&nbsp;&nbsp;
        @role('doctor')
        <a href="{{  route('doctors.holiday') }}" type="reset"
           class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
        @else
            <a href="{{  route('holidays.index') }}" type="reset"
               class="btn btn-secondary">{{ __('messages.common.discard') }}</a>
            @endrole
    </div>
</div>


