@if ($row->payment_type === 2)

    <span class="badge bg-success">{{__('messages.transaction.'.strtolower( \App\Models\Appointment::PAYMENT_TYPE[$paid]))}}</span>
@else
    <span class="badge bg-danger">{{__('messages.transaction.'.strtolower( \App\Models\Appointment::PAYMENT_TYPE[$pending]))}}</span>
    <a href="javascript:void(0)" data-id="{{$row->id}}"
       class="btn btn-icon payment-btn fs-3 py-1 mt-1"
       title="Appointment Payment">
        <i class="far fa-credit-card"></i>
    </a>
@endif
