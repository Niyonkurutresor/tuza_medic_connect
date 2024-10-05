<div class="modal show fade" id="paymentGatewayModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.appointment.Select_payment_method')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'patientPaymentForm'])}}
            <div class="modal-body">
                {{ Form::hidden('patientAppointmentId',null,['id'=>'patientAppointmentId']) }}
                <div class="alert alert-danger d-none" id="editPasswordValidationErrorsBox"></div>
                        <div class="mb-5">
                            {{ Form::select('payment_gateway', paymentMethodLangChange($paymentStatus), null, ['id' => 'paymentGatewayType',
                            'class' => 'form-select','data-dropdown-parent'=>'#paymentGatewayModal',
                            'required','data-control'=>"select2", 'placeholder' => __('messages.appointment.Select_payment_method')]) }}
                        </div>
            </div>
            <div class="modal-footer pt-0">
                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2','id'=>'submitBtn']) }}
                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary','data-bs-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
