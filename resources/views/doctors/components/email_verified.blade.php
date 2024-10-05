<div class="form-check form-switch form-check-custom form-check-solid justify-content-center">
    <input class="form-check-input h-20px w-30px doctor-email-verified" data-id="{{ $row->user->id }}"
           type="checkbox" value=""
            {{!empty($row->user->email_verified_at) ? 'checked disabled' : ''}} />
</div>
