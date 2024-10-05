<div class="modal fade" tabindex="-1" id="showModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.live_consultation.live_consultation_details') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                {{ Form::hidden('live_consultation_id',null,['id'=>'startLiveConsultationId']) }}
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.live_consultation.consultation_title').(':')  }}</label>
                    <span id="consultationTitle"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.live_consultation.consultation_date').(':')  }}</label>
                    <span id="consultationDates"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.live_consultation.consultation_duration_minutes').(':')  }}</label>
                    <span id="consultationDurationMinutes"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.appointment.patient').(' ').__('messages.common.name').(':')  }}</label>
                    <span id="consultationPatient"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.doctor.doctor').(' ').__('messages.common.name').(':')  }}</label>
                    <span id="consultationDoctor"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.live_consultation.host_video').(':')  }}</label>
                    <span id="consultationHostVideo"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.live_consultation.client_video').(':')  }}</label>
                    <span id="consultationParticipantVideo"></span>
                </div>
                <div class="mb-5 col-6">
                    <label class="fw-bolder col-sm-12 mb-2">{{ __('messages.appointment.description').(':')  }}</label>
                    <span id="consultationDescription"></span>
                </div>
            </div>
        </div>
    </div>
</div>
