<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_dob" class="form-check-input h-20px w-30px card_dob_status" id="card_dob_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_dob == 1 ? 'checked' : '' }}>
</div>
