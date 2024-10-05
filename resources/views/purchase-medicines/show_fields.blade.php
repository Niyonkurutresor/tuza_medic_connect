{{--  <div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.purchase_number')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800"><span class="badge bg-light-primary ">#{{$medicinePurchase->purchase_no}}</span></span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.total')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{{number_format($medicinePurchase->total)}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.tax_amount')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{{number_format($medicinePurchase->tax)}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.discount')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{{ number_format($medicinePurchase->discount)}}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.net_amount')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{{ number_format($medicinePurchase->net_amount) }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.created_mode')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{{ App\Models\PurchaseMedicine::created_METHOD[$medicinePurchase->created_type] }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.common.created_on')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800"data-toggle="tooltip" data-placement="right" title="{{ \Carbon\Carbon::parse($medicinePurchase->created_at)->translatedFormat('jS M, Y') }}">{{ \Carbon\Carbon::parse($medicinePurchase->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.created_note')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{!! !empty($medicinePurchase->created_note)?nl2br(e($medicinePurchase->created_note)):'N/A' !!}</span>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.note')  }}</label>
                                <span class="fw-bold fs-6 text-gray-800">{!! !empty($medicinePurchase->note)?nl2br(e($medicinePurchase->note)):'N/A' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  --}}





<div>
    <div class="d-flex overflow-auto h-55px">
        <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap">
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link active p-0" id="overview-tab" data-bs-toggle="tab"
                        data-bs-target="#overview"
                        type="button" role="tab" aria-controls="overview" aria-selected="true">
                    {{ __('messages.purchase_medicine.purchase_medicine_overview') }}
                </button>
            </li>
        </ul>
    </div>
    {{--    @endif--}}
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <div class="">
                <div class="d-flex flex-column">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xxl-9">
                                    <div class="row">
                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.purchase_number')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800"><span class="badge bg-light-primary ">#{{$medicinePurchase->purchase_no}}</span></span>
                                        </div>
                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.total')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800">{{number_format($medicinePurchase->total,2)}}</span>
                                        </div>
                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.tax_amount')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800">{{number_format($medicinePurchase->tax,2)}}</span>
                                        </div>
                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.discount')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800">{{ number_format($medicinePurchase->discount,2)}}</span>
                                        </div>
                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.net_amount')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800">{{ number_format($medicinePurchase->net_amount,2) }}</span>
                                        </div>

                                        <div class="col-lg-4 d-flex flex-column">
                                            <label class="fw-bold text-muted py-3">{{ __('messages.purchase_medicine.note')  }}</label>
                                            <span class="fw-bold fs-6 text-gray-800">{!! !empty($medicinePurchase->note)?nl2br(e($medicinePurchase->note)):'N/A' !!}</span>
                                        </div>
                                        <div class="col-12 overflow-auto">
                                            <table class="table table-striped box-shadow-none mt-4">
                                                <thead>
                                                <tr>
                                                    <th scope="col">{{ __('messages.medicines') }}</th>
                                                    <th scope="col">{{ __('messages.purchase_medicine.expiry_date') }}</th>
                                                    <th scope="col">{{ __('messages.purchase_medicine.lot_no') }}</th>
                                                    <th scope="col">{{ __('messages.medicine.buying_price') }}</th>
                                                    <th scope="col">{{ __('messages.medicine.selling_price') }}</th>
                                                    <th scope="col">{{ __('messages.purchase_medicine.tax' ) }}</th>
                                                    <th scope="col">{{ __('messages.purchase_medicine.quantity') }}</th>
                                                     <th scope="col" class="text-end ">{{ __('messages.purchase_medicine.amount') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach($medicinePurchase->purchasedMedcines as $purchasedMedcine)
                                                    <tr>
                                                        <td class="py-4">{{ isset($purchasedMedcine->medicines->name) == true ? $purchasedMedcine->medicines->name : __('messages.common.n/a')  }}
                                                        </td>

                                                        <td class="py-4">{{ $purchasedMedcine->expiry_date ==null ? __('messages.common.n/a') : \Carbon\Carbon::parse($purchasedMedcine->expiry_date)->isoFormat('Do MMM, Y')}}

                                                        </td>
                                                        <td class="py-4">{{ $purchasedMedcine->lot_no }}

                                                        </td>
                                                        <td class="py-4">{{ isset($purchasedMedcine->medicines->buying_price) == true ? $purchasedMedcine->medicines->buying_price : __('messages.common.n/a')  }}
                                                        </td>
                                                        <td class="py-4">{{ isset($purchasedMedcine->medicines->selling_price) == true ? $purchasedMedcine->medicines->selling_price : __('messages.common.n/a') }}

                                                        </td>
                                                        <td class="py-4">{{ $purchasedMedcine->tax }}%

                                                        </td>
                                                        <td class="py-4">{{ $purchasedMedcine->quantity }}

                                                        </td>
                                                        <td class="py-4 text-end ">{{ number_format($purchasedMedcine->amount,2) }}

                                                        </td>

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-lg-6 ms-lg-auto mt-4">
                                            <div class="border-top">
                                                <table class="table table-borderless  box-shadow-none mb-0 mt-5 text-end">
                                                    <tbody>
                                                    <tr>
                                                        <td class="ps-0">{{ __('messages.purchase_medicine.total').(':') }}</td>
                                                        <td class="text-gray-900 text-end pe-0">
                                                           {{ number_format($medicinePurchase->total,2) }}                                                                                         </td>
                                                        </tr>
                                                    <tr>
                                                        <td class="ps-0">{{ __('messages.purchase_medicine.tax').(':') }}</td>
                                                        <td class="text-gray-900 text-end pe-0">
                                                       {{ number_format($medicinePurchase->tax,2)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">{{ __('messages.purchase_medicine.discount').(':') }}</td>
                                                        <td class="text-gray-900 text-end pe-0">
                                                       {{ number_format($medicinePurchase->discount,2)}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">{{ __('messages.purchase_medicine.net_amount').(':') }}</td>
                                                        <td class="text-gray-900 text-end pe-0">
                                                       {{ number_format($medicinePurchase->net_amount,2)}}
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3">
                                    <div class="bg-gray-100 rounded-15 p-md-7 p-5 h-100 mt-xxl-0 mt-5 col-xxl-9 ms-xxl-auto w-100">
                                        <h3 class="mb-5">{{ __('messages.purchase_medicine.other_details') }}</h3>
                                        <div class="row">
                                            <div class="col-xxl-12 col-lg-4 col-sm-6 d-flex flex-column mb-xxl-7 mb-lg-0 mb-4">

                                                <label class="pb-2 fs-4 text-gray-600">{{ __('messages.purchase_medicine.payment_note')  }}</label>
                                                <span class="fw-bold fs-6 text-gray-800">{!! !empty($medicinePurchase->payment_note)?nl2br(e($medicinePurchase->payment_note)):'N/A' !!}</span>


                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-12 col-lg-4 col-sm-6 d-flex flex-column mb-xxl-7 mb-lg-0 mb-4">
                                                <label for="name"
                                                       class="pb-2 fs-4 text-gray-600">{{ __('messages.purchase_medicine.note') }}</label>
                                                <span class="fw-bold fs-6 text-gray-800">{!! !empty($medicinePurchase->note)?nl2br(e($medicinePurchase->note)):'N/A' !!}</span>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-12 col-lg-4 col-sm-6 d-flex flex-column mb-xxl-7 mb-lg-0 mb-4">
                                                <label for="name"
                                                       class="pb-2 fs-4 text-gray-600">{{ __('messages.purchase_medicine.payment_mode') }}</label>
                                                {{
                                                    App\Models\PurchaseMedicine::PAYMENT_METHOD[$medicinePurchase->payment_type]  }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-12 col-lg-4 col-sm-6 d-flex flex-column mb-xxl-7 mb-lg-0 mb-4">
                                                <label for="name"
                                                       class="pb-2 fs-4 text-gray-600">{{ __('messages.web.created_at') }}</label>
                                                {{ \Carbon\Carbon::parse($medicinePurchase->created_at)->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
