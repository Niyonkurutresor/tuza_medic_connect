<div class="modal fade" id="serviceCreateServiceCategoryModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{__('messages.service_category.add_category')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'serviceCreateServiceCategoryForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="createServiceCategoryValidationErrorsBox"></div>
                <div>
                    {{ Form::label('category_name', __('messages.common.name').':', ['class' => 'required form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                    {{ Form::text('name', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' =>__('messages.common.name'),                                     'required']) }}
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary m-0','id'=>'btnSave']) }}
                {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-secondary my-0 ms-5 me-0','data-bs-dismiss'=>'modal']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
