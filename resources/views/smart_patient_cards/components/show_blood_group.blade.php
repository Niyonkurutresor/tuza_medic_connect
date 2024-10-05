<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_blood_group" class="form-check-input h-20px w-30px card_blood_group_status" id="card_blood_group_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_blood_group == 1 ? 'checked' : '' }}>
</div>
