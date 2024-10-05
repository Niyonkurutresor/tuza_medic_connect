<div class="d-flex justify-content-between flex-xxl-row flex-column  mt-md-0 mt-sm-3">
    <div class="custom-margin-filter ">
        <input type="text" class="form-control form-control-solid custom-width px-3 flatpickr-input"
        placeholder="{{ __('messages.common.pick_date_range') }}" id="transactionDateFilter" />
    </div>
    <div class="d-flex justify-content-end flex-wrap custom-margin-transaction-filter">
            <div class="dropdown d-flex align-items-center" wire:ignore>
                <button class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
                    type="button" id="transactionFilterBtn" data-bs-auto-close="outside" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <p class="text-center">
                        <i class='fas fa-filter'></i>
                    </p>
                </button>
                <div class="dropdown-menu py-0" aria-labelledby="transactionFilterBtn">
                    <div class="text-start border-bottom py-4 px-7">
                        <h3 class="text-gray-900 mb-0">{{ __('messages.common.filter_option') }}</h3>
                    </div>
                    <div class="p-5">
                        <div class="mb-5">
                            <label for="filterBtn" class="form-label">{{ __('messages.appointment.payment') }}:</label>
                            {{ Form::select(
                                'payment_type',
                                collect($filterHeads[0])->toArray(),
                                \App\Models\Appointment::PAYMENT_TYPE_ALL,
                                ['class' => 'form-control form-control-solid form-select','placeholder'=>__('messages.doctor_session.all'), 'data-control' => 'select2', 'id' => 'trPaymentMehtod'],
                            ) }}
                        </div>
                        <div class="mb-5">
                            <label for="filterBtn" class="form-label">{{ __('messages.appointment.status') }}:</label>
                            {{ Form::select('status', collect($filterHeads[1])->toArray(), null , [
                                'class' => 'form-control form-control-solid form-select',
                                'data-control' => 'select2',
                                'id' => 'transactionStatus',
                                'placeholder'=>__('messages.doctor_session.all'),
                            ]) }}
                        </div>
                        @php
                            $servicesArr = App\Models\Service::get()->pluck('name', 'id')->toArray();
                        @endphp
                        <div class="mb-5">
                            <label for="exampleInputSelect2"
                                class="form-label">{{ __('messages.common.service') }}</label>
                            {{ Form::select('services_id', $servicesArr, null, ['class' => 'form-select io-select2', 'placeholder' => __('messages.common.select_service'), 'id' => 'transactionServices', 'data-control' => 'select2']) }}
                        </div>
                        @if(!Illuminate\Support\Facades\Auth::user()->hasRole('doctor'))
                        <div class="mb-5">
                            <label for="exampleInputSelect2"
                                class="form-label">{{ __('messages.doctors') }}</label>
                            {{ Form::select('doctor_id', [], null, ['class' => 'form-select io-select2', 'placeholder' => __('messages.common.select_doctor'), 'id' => 'transactionDoctor', 'data-control' => 'select2']) }}
                        </div>
                        @endif
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-secondary"
                                id="transactionResetFilter">{{ __('messages.common.reset') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
