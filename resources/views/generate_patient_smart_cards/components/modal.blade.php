<div id="add_templates_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h2>{{ __('messages.smart_patient_card.generate_patient_card') }}</h2>
                <button type="button" class="btn-close generate_patient_smart_card_close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'addtemplateForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="medicineCategoryErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-sm-12 mb-5">
                        {{ Form::label('template_id', __('messages.smart_patient_card.template').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('template_id', $template, null, ['class' => 'form-select io-select2 select_template', 'data-control' => 'select2', 'placeholder' => __('messages.smart_patient_card.select_template'),'required']) }}
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label required">
                                {{__('messages.smart_patient_card.type')}}:
                            </label>
                            <span class="is-valid">
                                <div class="mt-2">
                                    <input class="form-check-input type_tem generate_smart_patientcard_status1" type="radio" checked name="status"
                                        value="1">
                                    <label class="form-label me-5">{{__('messages.smart_patient_card.for_all_patient')}}</label>
                                    <input class="form-check-input type_tem generate_smart_patientcard_status3" type="radio" name="status"
                                        value="3">
                                    <label class="form-label me-3">{{__('messages.smart_patient_card.remaning_patients')}}</label> <br>
                                    <input class="form-check-input type_tem generate_smart_patientcard_status2 mt-5" type="radio" name="status"
                                        value="2">
                                    <label class="form-label mt-5">{{__('messages.smart_patient_card.only_one_patient')}}</label>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 patient_select mb-5">
                        {{ Form::label('patient_id', __('messages.smart_patient_card.patient').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('patient_id', $patient, null, ['class' => 'form-select generate_smart_patientcard_patient_select', 'id' => 'prescriptionPatientId', 'placeholder' => __('messages.smart_patient_card.select_patient')]) }}
                    </div>
                </div>
                <div class="modal-footer p-0">
                    {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary m-0', 'id' => 'medicineCategorySave', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" aria-label="Close" class="btn btn-secondary"
                        data-bs-dismiss="modal" value="Reset">{!! __('messages.common.cancel') !!}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
