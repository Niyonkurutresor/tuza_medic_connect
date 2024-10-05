<div class="d-flex justify-content-center">
    @if($row->status !== $cancel && $row->status !== $checkOut)
    <a href="{{ route('patients.appointmentPdf', $row->id) }}" target="_blank"
        class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('download') }}">
        <i class="fa fa-download" aria-hidden="true"></i>
    </a>

        <a href="javascript:void(0)" data-id="{{$row->id}}"
           class="btn px-1 text-danger fs-3 edit-btn patient-cancel-appointment" data-bs-toggle="tooltip"
           data-bs-original-title="Cancel Appointment"
           data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="{{__('messages.appointment.cancel_appointment')}}">
            <i class="fas fa-calendar-times"></i>
        </a>
    @endif

    <a href="{{ route('patients.appointment.detail', $row->id) }}" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.show') }}"
       class="btn px-1 text-primary fs-3 user-edit-btn" data-id="{{$row->id}}">
        <i class="fa-solid fa-eye"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-1 text-danger fs-3 doctor-panel-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
