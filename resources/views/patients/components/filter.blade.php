{{-- <div class="dropdown d-flex align-items-center" wire:ignore>
    <button class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
        type="button" id="apptmentFilterBtn" data-bs-auto-close="outside" data-bs-toggle="dropdown"
        aria-expanded="false">
        <p class="text-center">
            <i class='fas fa-filter'></i>
        </p>
    </button>
    <div class="dropdown-menu py-0" aria-labelledby="apptmentFilterBtn">
        <div class="text-start border-bottom py-4 px-7">
            <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter_option') }}</h3>
        </div>
        <div class="p-5">
            <div class="mb-5">
                <label for="filterBtn" class="form-label">{{ __('messages.patient.filter') }}</label>
                {{ Form::select(
                    'payment_type',
                    collect($filterHeads[0])->toArray(),
                    \App\Models\Patient::PATIENT_FILTER,
                    ['class' => 'form-control form-control-solid form-select', 'data-control' => 'select2', 'id' => 'patientSelectFilter'],
                ) }}
            </div>
            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-secondary"
                    id="patientResetFilter">{{ __('messages.common.reset') }}</button>
            </div>
        </div>
    </div>
</div> --}}
<div class="d-flex float-start">
    <div class="ms-3">
        <input type="text" class="form-control form-control-solid custom-width px-3 flatpickr-input"
        placeholder="{{ __('messages.common.pick_date_range') }}" id="patientDateFilter" />
    </div>
</div>
