<div class="form-check form-switch d-flex justify-content-center">
    <input class="form-check-input patient-email-verified" data-id="{{ $row->user->id }}"
           type="checkbox" value=""
            {{!empty($row->user->email_verified_at) ? 'checked disabled' : ''}} />
</div>
