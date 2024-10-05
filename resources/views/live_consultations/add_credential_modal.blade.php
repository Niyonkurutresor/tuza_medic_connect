<div id="addCredential" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.live_consultation.add_credential') }}</h3>
                <button type="button" aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            {{ Form::open(['id'=>'addZoomForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="credentialValidationErrorsBox"></div>
                {{ Form::hidden('user_id',getLogInUserId(),['id'=>'zoomUserId']) }}
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_key', __('messages.live_consultation.zoom_api_key').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('zoom_api_key', '', ['class' => 'form-control','required','placeholder'=>__('messages.live_consultation.zoom_api_key'),'id' => 'zoomApiKey', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('zoom_api_secret', __('messages.live_consultation.zoom_api_secret').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('zoom_api_secret', '', ['class' => 'form-control','required','placeholder'=>__('messages.live_consultation.zoom_api_secret'), 'id' => 'zoomApiSecret', 'autocomplete' => 'off']) }}
                    </div>
                </div>
                <div class="row">
                    <a href="https://developers.zoom.us/docs/integrations/create/" class="text-start text-decoration-none pt-1 pb-1" target="_blank">{{ __('messages.live_consultation.generate_oauth') }}</a>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary','id' => 'btnZoomSave','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
