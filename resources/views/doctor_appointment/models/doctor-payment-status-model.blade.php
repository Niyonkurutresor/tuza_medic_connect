

<div class="modal show fade" tabindex="-1" id="doctorAppointmentPaymentStatusModal"  aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">{{__('messages.appointment.Select_payment_method')}}</h2>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                {{ Form::open(['id' => 'doctorAppointmentPaymentStatusForm'])}}
                {{ Form::hidden('payment_status',null,['id'=>'doctorAppointmentPaymentStatus']) }}
                {{ Form::hidden('appointmentId',null,['id'=>'doctorAppointmentId']) }}
                <div class="alert alert-danger d-none" id="editPasswordValidationErrorsBox"></div>
                <div class="d-flex align-items-center">
                    {{ Form::select('payment_status', $paymentStatus, null, ['id' => 'doctorPaymentType',
                         'class' => 'form-select','data-dropdown-parent'=>'#doctorAppointmentPaymentStatusModal',
                         'required','data-control'=>"select2", 'placeholder' => __('messages.appointment.Select_payment_method')]) }}
                </div>
                <div class="pt-5">
                    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-2 me-0','data-bs-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
