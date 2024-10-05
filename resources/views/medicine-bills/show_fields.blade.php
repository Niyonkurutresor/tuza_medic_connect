


<div class="d-flex align-items-center pb-10">
    <img alt="Logo" src="{{ asset(getAppLogo()) }}" height="100px" width="100px">
    <a target="_blank"
     href="{{ route('medicine.bill.pdf',[$medicineBill->id]) }}"
       class="btn btn-success ms-auto text-white">{{ __('messages.medicine_bills.print_bill') }}</a>
</div>
<div class="m-0">
    <div class="fs-3 text-gray-800 mb-8"> #{{ $medicineBill->bill_number }}</div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.patient').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $medicineBill->patient->patientUser->full_name }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine_bills.bill_date').':' }}</div>
            <div class="fs-5 text-gray-800">{{ Carbon\Carbon::parse($medicineBill->bill_date)->format('jS M, Y g:i A') }}</div>
        </div>
        {{--  <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.bill.admission_id').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $medicineBill->patientAdmission->patient_admission_id }}</div>
        </div>  --}}
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.patient').' '.__('auth.email').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $medicineBill->patient->patientUser->email }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.medicine_bills.payment_status').':' }}</div>
            <div class="fs-5 text-gray-800">{{ App\Models\MedicineBill::PAYMENT_STATUS_ARRAY[$medicineBill->payment_status] }}</div>
        </div>
    </div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.patient').' '.__('messages.medicine_bills.cell_no').':' }}</div>
            <div class="fs-5 text-gray-800">{{ !empty($medicineBill->patient->patientUser->phone) ? $medicineBill->patient->patientUser->phone : __('messages.common.n/a') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.patient').' '.__('messages.user.gender').':' }}</div>
            <div class="fs-5 text-gray-800">{{ (!$medicineBill->patient->patientUser->gender) ? __('messages.staff.male') : __('messages.staff.female') }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.appointment.patient').' '.__('messages.doctor.dob').':' }}</div>
            <div class="fs-5 text-gray-800">{{ (!empty($medicineBill->patient->patientUser->dob)) ? \Carbon\Carbon::parse($medicineBill->patient->patientUser->dob)->translatedFormat('jS M, Y') : __('messages.common.n/a') }}</div>
        </div>
    </div>
    <div class="row g-5 mb-11">
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.web.created_at').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $medicineBill->created_at->diffForHumans() }}</div>
        </div>
        <div class="col-sm-3">
            <div class="pb-2 fs-5 text-gray-600">{{ __('messages.patient.last_updated').':' }}</div>
            <div class="fs-5 text-gray-800">{{ $medicineBill->created_at->diffForHumans() }}</div>
        </div>
    </div>
    <div class="flex-grow-1 table-responsive">
        <table class="table border-bottom-2 ">
            <thead>
            <tr class="border-bottom fs-6 fw-bolder text-muted">
                <th class="min-w-175px pb-2">{{ __('messages.medicine_bills.item_name') }}</th>
                <th class="min-w-70px text-end pb-2">{{ __('messages.medicine.quantity') }}</th>
                <th class="min-w-70px text-end pb-2">{{ __('messages.medicine_bills.price') }}</th>
                <th class="min-w-80px text-end pb-2">{{ __('messages.purchase_medicine.tax') }}</th>
                <th class="min-w-80px text-end pb-2">{{ __('messages.purchase_medicine.amount') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($medicineBill->saleMedicine as $index => $saleMedicine)
                <tr class="text-gray-700 fs-5 text-end">
                    <td class="d-flex align-items-center pt-6 text-gray-700">{{ $saleMedicine->medicine->name }}</td>
                    <td class="pt-6 text-gray-700">{{ $saleMedicine->sale_quantity }}</td>
                    <td class="pt-6 text-gray-700">
                        {{ getCurrencyFormat(getCurrencyCode(),$saleMedicine->sale_price ) }}</td>
                        <td class="pt-6 text-dark fw-boldest">
                            {{ $saleMedicine->tax.'%' }}</td>
                    <td class="pt-6 text-dark fw-boldest">
                        {{ getCurrencyFormat(getCurrencyCode(),$saleMedicine->sale_price * $saleMedicine->sale_quantity) }}</td>
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
                       {{ number_format($medicineBill->total,2) }}                                                                                         </td>
                    </tr>
                <tr>
                    <td class="ps-0">{{ __('messages.purchase_medicine.tax').(':') }}</td>
                    <td class="text-gray-900 text-end pe-0">
                   {{ number_format($medicineBill->tax_amount,2)}}
                    </td>
                </tr>
                <tr>
                    <td class="ps-0">{{ __('messages.purchase_medicine.discount').(':') }}</td>
                    <td class="text-gray-900 text-end pe-0">
                   {{ number_format($medicineBill->discount,2)}}
                    </td>
                </tr>
                <tr>
                    <td class="ps-0">{{ __('messages.purchase_medicine.net_amount').(':') }}</td>
                    <td class="text-gray-900 text-end pe-0">
                   {{ number_format($medicineBill->net_amount,2)}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
