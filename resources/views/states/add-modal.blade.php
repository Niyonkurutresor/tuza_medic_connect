<div class="modal fade" id="addStateModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.state.add_state') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'addStateForm'])}}
            <div class="modal-body">
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('messages.common.name'),'required']) }}
                </div>
                <div>
                    {{ Form::label('country_id', __('messages.state.country').':', ['class' => 'form-label required']) }}
                    {{ Form::select('country_id', $countries, null, ['id' => 'countryState','class' => 'form-select','required','data-turbo' => 'false','data-control'=>'select2', 'placeholder' => __('messages.state.country')]) }}
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
