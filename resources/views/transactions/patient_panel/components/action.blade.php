@if($row->status == \App\Models\Transaction::PENDING)
    <div class="d-flex justify-content-center">
        <div class="badge bg-warning">{{\App\Models\Transaction::PAYMENT_STATUS[$row->status]}}</div>
    </div>
@else
    <div class="d-flex justify-content-center">
        <a href="{{ route('patients.transactions.show',$row->id) }}" class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip" data-bs-original-title="{{ __('messages.common.show') }}" title="{{ __('messages.common.show') }}">
            <i class="fas fa-eye"></i>
        </a>
    </div>
@endif
