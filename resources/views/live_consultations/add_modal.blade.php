<div id="addModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.live_consultation.new_live_consultation') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addNewForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('consultation_title', __('messages.live_consultation.consultation_title').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_title', '', ['class' => 'form-control consultation-title','required','placeholder' => __('messages.live_consultation.consultation_title')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultationDate', __('messages.live_consultation.consultation_date').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_date', '', ['class' => 'form-control consultation-date','required', 'autocomplete' => 'off','id'=>'consultationDate','placeholder' => __('messages.live_consultation.select_consultation_date')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_duration_minutes', __('messages.live_consultation.consultation_duration_minutes').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_duration_minutes', '', ['class' => 'form-control consultation-duration-minutes','required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','min' => '0', 'max' => '720','placeholder' =>  __('messages.live_consultation.consultation_minutes')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.web.patient_name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select io-select2 patient-name', 'placeholder' =>  __('messages.live_consultation.select_patient_name'), 'id' => 'patientName', 'required', 'data-control'=>'select2','data-dropdown-parent'=>'#addModal']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_id', __('messages.doctor.doctor').(' ').__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select io-select2 doctor-name', 'placeholder' => __('messages.live_consultation.select_doctor_name'), 'required','data-control'=>'select2', 'id' => 'addDoctorID','data-dropdown-parent'=>'#addModal']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('host_video',__('messages.live_consultation.host_video').':', ['class' => 'form-label required']) }}
                        <br>
                        <span class="is-valid">
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_ENABLE, false, ['class' => 'form-check-input']) }}
                            <label class="form-label">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                             &nbsp;
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_DISABLED, true, ['class' => 'form-check-input']) }}
                            <label class="form-label">{{ __('messages.live_consultation.disabled') }}</label>
                        </span>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('participant_video',__('messages.live_consultation.client_video').':', ['class' => 'form-label required']) }}
                        <br>
                        <span class="is-valid">
                              {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_ENABLE, false, ['class' => 'form-check-input']) }} &nbsp;
                            <label class="form-label">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_DISABLED, true, ['class' => 'form-check-input']) }}
                            <label class="form-label">{{ __('messages.live_consultation.disabled') }}</label>
                        </span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.appointment.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control description', 'rows' => 3,'placeholder' =>  __('messages.live_consultation.description')]) }}
                    </div>
                    <div class="modal-footer p-0">
                        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'btnSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
