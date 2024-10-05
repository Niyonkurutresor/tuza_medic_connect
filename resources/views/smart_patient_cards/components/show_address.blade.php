<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_address" class="form-check-input h-20px w-30px card_address_status" id="card_address_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_address == 1 ? 'checked' : '' }}>
</div>
