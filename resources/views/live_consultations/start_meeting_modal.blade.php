<div id="startModal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="start-modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 mb-3">
                {{ Form::hidden('live_consultation_id',null,['id'=>'startLiveConsultationId']) }}
                <div class="row">
                    <div class="form-group col-sm-4 mb-5">
                        {{ Form::label('host', __('messages.live_consultation.host_video').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 host-name"></span>
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('date', __('messages.live_consultation.consultation_date').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 date"></span>
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('duration', __('messages.live_consultation.duration').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 minutes"></span>
                    </div>
                </div>
                <hr style="border: 1px solid #e0e4e8;">
                <div class="row">
                    <div class="text-left col-sm-8">
                        {{ Form::label('status', __('messages.web.status').(':'), ['class' => 'fw-bold text-muted mb-1']) }}
                        <br>
                        <span class="fw-bolder fs-6 text-gray-800 status"></span>
                    </div>
                    <div class="text-right col-sm-4 mt-4">
                        <a class="btn btn-sm btn-flex btn-light btn-primary fw-bolder start" href="" target="_blank">
                            <i class="fas fa-video"></i> {{ getLogInUser()->hasRole('doctor|Admin') ? __('messages.live_consultation.start_now') : __('messages.live_consultation.join_now') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
