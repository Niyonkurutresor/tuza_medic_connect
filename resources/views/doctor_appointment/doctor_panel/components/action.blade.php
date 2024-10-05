<div class="d-flex justify-content-center">
    <a href="{{ route('doctors.appointmentPdf', $row->id) }}" target="_blank"
        class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('download') }}">
        <i class="fa fa-download" aria-hidden="true"></i>
     </a>
    <a href="{{ route('doctors.appointment.detail', $row->id) }}" class="btn px-1 text-primary fs-3" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.show') }}">
        <i class="fas fa-eye"></i>
    </a>

</div>
