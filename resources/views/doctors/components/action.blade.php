<div class="d-flex justify-content-center">
    @if(empty($row->user->email_verified_at))
        <a href="javascript:void(0)" data-id="{{ $row->user->id }}"
           class="btn px-2 text-primary fs-2 doctor-email-verification"
           data-bs-toggle="tooltip" data-bs-original-title="{{__('messages.resend_email_verification')}}">
            <span class="svg-icon svg-icon-3">
                    <i class="fas fa-envelope"></i>
                </span>
        </a>
    @endif

    <a data-id="{{ $row->user->id }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.doctor.add_qualification') }}"
       class="btn px-2 fs-2 add-qualification">
        <i class="fa-solid fa-plus"></i>
    </a>
    <a href="{{ route('doctors.edit', $row->id) }}" title="{{ __('messages.common.edit') }}" class="btn px-2 text-primary fs-2 doctor-edit-btn" data-bs-toggle="tooltip"
       data-bs-original-title="Edit" data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}" class="btn px-2 text-danger fs-2 doctor-delete-btn" data-bs-toggle="tooltip"
       data-bs-original-title="Delete">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
