<table>
    <thead>
    <tr>
        <th>{{ __('messages.common.no') }}</th>
        <th>{{ __('messages.purchase_medicine.purchase_number') }}</th>
        <th>{{ __('messages.purchase_medicine.total') }}</th>
        <th>{{ __('messages.purchase_medicine.tax')}}</th>
        <th>{{ __('messages.purchase_medicine.discount')}}</th>
        <th>{{ __('messages.purchase_medicine.net_amount')}}</th>
        <th>{{ __('messages.purchase_medicine.payment_mode') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($purchaseMedicines as $purchaseMedicine)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ '#'.$purchaseMedicine->purchase_no }}</td>
            <td>{{ $purchaseMedicine->total }}</td>
            <td>{{ !empty($purchaseMedicine->tax) ? $purchaseMedicine->tax : __('messages.common.n/a') }}</td>
            <td>{{ $purchaseMedicine->discount ?? __('messages.common.n/a') }}</td>
            <td>{{ $purchaseMedicine->net_amount ?? __('messages.common.n/a') }}</td>
            <td>{{ App\Models\PurchaseMedicine::PAYMENT_METHOD[$purchaseMedicine->payment_type ]}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
