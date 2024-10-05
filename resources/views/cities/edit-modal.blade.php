<div class="modal fade" id="editCityModal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.city.edit_city')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editCityForm']) }}
            <div class="modal-body">
                {{ Form::hidden('id',null,['id' => 'cityID']) }}
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').':', ['class' => 'required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' =>  __('messages.web.name'),'required','id'=>'editCityName']) }}
                </div>
                <div>
                    {{ Form::label('state_id', __('messages.city.state').':', ['class' => 'required']) }}
                    {{ Form::select('state_id', $states, null, ['id' => 'editCityStateId','required','data-control'=>"select2"]) }}
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
