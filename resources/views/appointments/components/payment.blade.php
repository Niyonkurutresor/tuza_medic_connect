@if($row->payment_type != $paid)
    <select class="io-select2 form-select appointment-change-payment-status payment-status" style="min-width: 150px; max-width:150px;"
    data-control="select2" data-id="{{$row->id}}">
        <option value="{{ $paid }}" {{( $row->payment_type ==
                    $paid) ? 'selected' : ''}}>{{__('messages.transaction.paid')}}
        </option>
        <option value="{{$pending}}" {{( $row->payment_type ==
                    $paid) ? 'disabled' : 'selected'}}>{{ __('messages.transaction.pending')}}
        </option>
    </select>
@else
    <div class="d-flex align-items-center justify-content-center">
        <span class="badge bg-light-success">{{ __('messages.transaction.paid') }}</span>
    </div>
@endif
