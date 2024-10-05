<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_phone" class="form-check-input h-20px w-30px  card_phone_status" id="card_phone_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_phone == 1 ? 'checked' : '' }}>
</div>
