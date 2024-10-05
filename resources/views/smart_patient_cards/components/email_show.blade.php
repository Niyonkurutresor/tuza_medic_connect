<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_email" class="form-check-input h-20px w-30px card_email_status" id="card_email_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_email == 1 ? 'checked' : '' }}>
</div>
