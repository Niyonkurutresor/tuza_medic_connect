<div class="d-flex align-items-center justify-content-center">
    <a href="{{ route('medicine-bills.show', [$row->id]) }}"
        class='btn px-2 text-primary fs-3 ps-0'> <i class="fas fa-eye text-success"></i></a>
    {{--  @if(isset($row->payment_status) && $row->payment_status == false)  --}}
        <a
        href="{{ route('medicine-bills.edit', [$row->id]) }}"
        title="<?php echo __('messages.common.edit') ?>" class="btn px-2 edit-btn text-primary fs-3 py-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    {{--  @endif  --}}
    {{--  @if(isset($row->payment_status) && $row->payment_status == true)  --}}
        <a title="<?php echo __('messages.common.delete'); ?>" data-id="{{ $row->id }}"
            class="btn medicine-bill-delete-btn px-2 text-danger pe-0 py-2">
            <i class="fa-solid fa-trash"></i>
        </a>
    {{--  @endif  --}}
</div>
