<div class="d-flex justify-content-center">
    <a href="{{ route('enquiries.show', $row->id) }}"
       class="btn px-1 text-primary fs-3" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.show') }}">
        <i class="fas fa-eye"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"  data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-1 text-danger fs-3 enquiry-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
