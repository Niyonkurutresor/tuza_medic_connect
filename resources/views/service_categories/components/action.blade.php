<div class="d-flex justify-content-center">
    <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}"
       class="btn px-2 text-primary fs-2 service-category-edit-btn" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.edit') }}" data-id="{{$row->id}}" data-turbolinks="false">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
       data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-2 text-danger fs-2 service-category-delete-btn" data-turbolinks="false">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
