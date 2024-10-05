<div class="ms-auto" wire:ignore>
    <div class="dropdown d-flex align-items-center me-4 me-md-5">
        <button class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0" type="button"
                id="enquiryFilterBtn" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
            <p class="text-center">
                <i class='fas fa-filter'></i>
            </p>
        </button>
        <div class="dropdown-menu py-0" aria-labelledby="enquiryFilterBtn">
            <div class="text-start border-bottom py-4 px-7">
                <h3 class="text-gray-900 mb-0">{{__('messages.common.filter_option')}}</h3>
            </div>
            <div class="p-5">
                <div class="mb-5">
                    <label for="exampleInputSelect2" class="form-label">{{__('messages.web.status')}}:</label>
                    {{ Form::select('status', collect($filterHeads[0])->sortBy('key')->toArray(),null, ['class' => 'io-select2 form-select', 'data-control'=>"select2", 'id' => 'enquiriesStatus']) }}
                </div>
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary"
                            id="enquiryResetFilter">{{__('messages.common.reset')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
