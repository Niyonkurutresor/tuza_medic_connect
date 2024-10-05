<div id="editModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.live_consultation.edit_live_consultation') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="editValidationErrorsBox"></div>
                {{ Form::hidden('live_consultation_id',null,['id'=>'liveConsultationId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('consultation_title', __('messages.live_consultation.consultation_title').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_title', null, ['class' => 'form-control edit-consultation-title','required','placeholder'=>__('messages.live_consultation.consultation_title')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultationDate', __('messages.live_consultation.consultation_date').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_date', null, ['class' => 'form-control edit-consultation-date','required', 'autocomplete' => 'off','placeholder'=>__('messages.live_consultation.consultation_date')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('consultation_duration_minutes', __('messages.live_consultation.consultation_duration_minutes').(':'), ['class' => 'form-label required']) }}
                        {{ Form::text('consultation_duration_minutes', '', ['class' => 'form-control edit-consultation-duration-minutes','onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','required', 'min' => '0', 'max' => '720','placeholder'=>__('messages.live_consultation.consultation_duration_minutes')]) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('patient_id', __('messages.web.patient_name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::select('patient_id', $patients, null, ['class' => 'form-select edit-patient-name', 'placeholder' => __('messages.live_consultation.select_patient'), 'id' => 'editPatientName', 'required', 'data-control'=>'select2', 'data-dropdown-parent'=>'#editModal']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('doctor_id', __('messages.doctor.doctor').(' ').__('messages.common.name').(':'), ['class' => 'form-label required']) }}
                        {{ Form::select('doctor_id', $doctors, null, ['class' => 'form-select edit-doctor-name', 'aria-label' => 'Select Doctor Name', 'required', 'id' => 'editDoctorName','data-control'=>'select2', 'data-dropdown-parent'=>'#editModal']) }}
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('host_video',__('messages.live_consultation.host_video').':', ['class' => 'form-label required']) }}
                        <br>
                        <span class="is-valid">
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_ENABLE, false, ['class' => 'form-check-input host-enable']) }} &nbsp;
                            <label class="form-label">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('host_video', \App\Models\LiveConsultation::HOST_DISABLED, true, ['class' => 'form-check-input host-disabled']) }}
                            <label class="form-label">{{ __('messages.live_consultation.disabled') }}</label>
                        </span>
                    </div>
                    <div class="form-group col-sm-6 mb-5">
                        {{ Form::label('participant_video',__('messages.live_consultation.client_video').':', ['class' => 'form-label required']) }}
                        <br>
                        <span class="is-valid">
                            {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_ENABLE, false, ['class' => 'form-check-input client-enable']) }} &nbsp;
                            <label class="form-label">{{ __('messages.live_consultation.enable') }}</label>&nbsp;&nbsp;
                            {{ Form::radio('participant_video', \App\Models\LiveConsultation::CLIENT_DISABLED, true, ['class' => 'form-check-input client-disabled']) }}
                            <label class="form-label">{{ __('messages.live_consultation.disabled') }}</label>
                        </span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('description', __('messages.appointment.description').(':'), ['class' => 'form-label']) }}
                        {{ Form::textarea('description', '', ['class' => 'form-control edit-description', 'rows' => 3,'placeholder'=>__('messages.appointment.description')]) }}
                    </div>
                    <div class="modal-footer p-0">
                        {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'btnEditSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                        <button type="button" class="btn btn-secondary my-0 ms-5 me-0"
                                data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
