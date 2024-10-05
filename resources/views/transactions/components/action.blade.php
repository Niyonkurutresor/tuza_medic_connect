@if(isset($row->appointment->status) && $row->appointment->status == \App\Models\Appointment::CANCELLED)
    <div class="d-flex justify-content-center">
        <a href="{{ route('transactions.show', $row->id) }}"
           class="btn px-1 text-primary fs-3" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.show') }}">
           <i class="fas fa-eye"></i>
        </a>
    </div>
@elseif($row->status == \App\Models\Transaction::PENDING)
    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
        <input class="form-check-input h-20px w-30px transaction-statusbar" data-id="{{$row->id}}" type="checkbox"
               value=""
                {{$row->status === 1?'checked':''}} />
    </div>
@else
    <div class="d-flex justify-content-center">
        <a href="{{ route('transactions.show', $row->id) }}"
           class="btn px-1 text-primary fs-3" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye"></i>
        </a>
    </div>
@endif
