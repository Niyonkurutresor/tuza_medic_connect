<div class="d-flex justify-content-center">
    <a href="{{ route('admin.appointmentPdf', $row->id) }}" target="_blank"
       class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.download') }}">
       <i class="fa fa-download" aria-hidden="true"></i>
    </a>
    <a href="{{ route('appointments.show', $row->id) }}"
       class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.view') }}">
        <i class="fas fa-eye"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-1 text-danger fs-3 appointment-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
