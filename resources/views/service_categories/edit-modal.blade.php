<div class="modal fade" id="editServiceCategoryModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fw-bolder">{{__('messages.service_category.edit_category')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editServiceCategoryForm']) }}
            <div class="modal-body">
                {{ Form::hidden('categoryId',null,['id' => 'serviceCategoryID']) }}
                <div class="alert alert-danger d-none" id="editServiceCategoryValidationErrorsBox"></div>
                <div>
                    {{ Form::label('name', __('messages.common.name').':', ['class' => 'required form-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' =>  __('messages.common.name'),'required','id'=>'editServiceCategoryName']) }}
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
