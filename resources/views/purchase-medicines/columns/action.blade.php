<div class="d-flex justify-content-center align-items-center pb-md-2">
    <a href="{{ route('medicine-purchase.show', [$row->id]) }}" class='btn px-2 text-primary fs-3 ps-0'>
        <i class="fas fa-eye text-success"></i>
    </a>
    <a title="<?php echo __('messages.common.delete'); ?>" data-id="{{ $row->id }}" class="purchaseMedicineDelete btn px-2 text-danger fs-3 ps-0">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
