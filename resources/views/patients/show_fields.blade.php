<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.blood_group')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($patient->user->blood_group) ? \App\Models\Patient::BLOOD_GROUP_ARRAY[$patient->user->blood_group] : __('messages.common.n/a') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.user.gender')  }}</label>
    <span class="fs-4 text-gray-800">{{ ($patient->user->gender == 1) ? __('messages.doctor.male') : __('messages.doctor.female') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.dob')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($patient->user->dob) ? \Carbon\Carbon::parse($patient->user->dob)->isoFormat('DD MMM YYYY') : __('messages.common.n/a') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.setting.address')  }}</label>
    <span class="fs-4 text-gray-800">{{ !empty($patient->address->address1) ? $patient->address->address1 : __('messages.common.n/a') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.registered_on')  }}</label>
    <span class="fs-4 text-gray-800">{{$patient->user->created_at->diffForHumans()}}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.last_updated')  }}</label>
    <span class="fs-4 text-gray-800">{{$patient->user->updated_at->diffForHumans()}}</span>
</div>
