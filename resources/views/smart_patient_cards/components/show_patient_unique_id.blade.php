<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input name="show_patient_unique_id" class="form-check-input h-20px w-30px card_patient_unique_id_status" id="card_patient_unique_id_status" data-id="{{ $row->id }}" type="checkbox"
        {{ $row->show_patient_unique_id == 1 ? 'checked' : '' }}>
</div>
