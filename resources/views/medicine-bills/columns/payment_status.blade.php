<div class="d-flex align-items-center justify-content-center">
    @if($row->payment_status == App\Models\MedicineBill::UNPAID)
    <span class="badge bg-light-danger">{{ App\Models\MedicineBill::PAYMENT_STATUS_ARRAY[$row->payment_status] }}</span>
    @else
    <span class="badge bg-light-success">{{ App\Models\MedicineBill::PAYMENT_STATUS_ARRAY[$row->payment_status] }}</span>
    @endif
</div>
