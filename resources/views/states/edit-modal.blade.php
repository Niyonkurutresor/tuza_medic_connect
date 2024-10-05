<div class="modal fade" id="editStateModal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.state.edit_state') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editStateForm']) }}
            <div class="modal-body">
                {{ Form::hidden('stateId',null,['id'=>'editStateId']) }}
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name'), 'tabindex' => 1, 'required','id' => 'editStateName']) }}
                </div>
                <div>
                    {{ Form::label('country_id', __('messages.state.country').':', ['class' => 'form-label required']) }}
                    {{ Form::select('country_id', $countries, null, ['class' => 'form-select','id' => 'selectCountry','required','data-control'=>'select2']) }}
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary m-0','data-turbo' => 'false']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss'=>'modal']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
