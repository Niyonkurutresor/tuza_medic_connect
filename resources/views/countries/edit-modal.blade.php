<div class="modal fade" id="editCountryModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.common.edit').' '. __('messages.common.country')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editCountryForm']) }}
            <div class="modal-body">
                {{ Form::hidden('countryId',null,['id'=>'editCountryId']) }}
                <div class="mb-5">
                    {{ Form::label('name', __('messages.common.name').':', ['class' => 'form-label required']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' =>  __('messages.common.name'), 'required','id' => 'editCountryName']) }}
                </div>
                <div>
                    {{ Form::label('short_code', __('messages.country.short_code').':', ['class' => 'form-label']) }}
                    {{ Form::text('short_code', null, ['class' => 'form-control', 'placeholder' => __('messages.country.short_code'), 'tabindex' => 1,'id' => 'editShortCodeName']) }}
                </div>
            </div>
                <div class="modal-footer pt-0">
                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary m-0']) }}
                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss'=>'modal']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
