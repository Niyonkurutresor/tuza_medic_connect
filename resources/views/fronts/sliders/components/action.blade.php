<div class="d-flex justify-content-center">
    <a href="{{ route('banner.edit', $row->id) }}" title="{{ __('messages.common.edit') }}"  data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.edit') }}"
       class="btn px-1 text-primary fs-3" data-id="{{$row->id}}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
</div>
