<select class="io-select2 form-select doctor-apptment-change-payment-status payment-status" style="min-width: 150px; max-width:150px;"
        data-id="{{$row->id}}">
    <option value="{{ $paid }}" {{( $row->payment_type ==
                $paid) ? 'selected' : ''}}>{{__('messages.transaction.paid')}}
    </option>
    <option value="{{$pending}}" {{( $row->payment_type ==
                $paid) ? 'disabled' : 'selected'}}>{{ __('messages.transaction.pending')}}
    </option>
</select>
