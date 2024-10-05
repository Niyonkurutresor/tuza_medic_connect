<div id="showMedicine" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ __('messages.medicine.medicine_details') }}</h3>
                <button type="button" aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineName"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.medicine').(':') }}</label><br>
                        <span id="showMedicineName"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineBrand"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.brand').(':') }}</label><br>
                        <span id="showMedicineBrand"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineCategory"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.category').(':') }}</label><br>
                        <span id="showMedicineCategory"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineQuanity"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.item_stock.quantity').(':') }}</label><br>
                        <span id="showMedicineQuanity"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineAvailableQuanity"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.issued_item.available_quantity').(':') }}</label><br>
                        <span id="showMedicineAvailableQuanity"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineSaltComposition"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.salt_composition').(':') }}</label><br>
                        <span id="showMedicineSaltComposition"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineSellingPrice"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.selling_price').(':') }}</label><br>
                        <span id="showMedicineSellingPrice"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineBuyingPrice"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.buying_price').(':') }}</label><br>
                        <span id="showMedicineBuyingPrice"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineSideEffects"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.side_effects').(':') }}</label><br>
                        <span id="showMedicineSideEffects"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineCreatedOn"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.created_on').(':') }}</label><br>
                        <span id="showMedicineCreatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-lg-6 mb-5">
                        <label for="showMedicineUpdatedOn"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.common.last_updated').(':') }}</label><br>
                        <span id="showMedicineUpdatedOn"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                    <div class="form-group col-sm-12 mb-5">
                        <label for="showMedicineDescription"
                               class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine.description').(':') }}</label><br>
                        <span id="showMedicineDescription"
                              class="fs-5 text-gray-800 showSpan"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
