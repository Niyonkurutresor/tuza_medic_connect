<div class="d-flex justify-content-center">
    @if(!empty($row->appointment->status))
    <div class="badge bg-{{getBadgeStatusColor($row->appointment->status)}}">
        {{ \App\Models\Appointment::ALL_STATUS[$row->appointment->status] }}
    </div>
    @else
    <div class="badge bg-danger">
        {{ __('messages.common.n/a') }}
    </div>
    @endif
</div>
