<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.staff.role')  }}</label>
    <span class="fs-4 text-gray-800">{{ $staff->role_name }}</span>
</div>
<div class="col-md-6 mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.role.permissions')  }}</label>
    <br>
    @foreach($staff->getAllPermissions() as $permission)
        <span class="badge my-1 me-1 bg-{{ getBadgeColor($loop->index) }}">{{ $permission->display_name }}</span>
    @endforeach
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.user.gender')  }}</label>
    <span
        class="fs-4 text-gray-800">{{ ($staff->gender == 1) ? __('messages.doctor.male') : __('messages.doctor.female') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.registered_on') }}</label>
    <span class="fs-4 text-gray-800">{{$staff->created_at->diffForHumans()}}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.last_updated') }}</label>
    <span class="fs-4 text-gray-800">{{$staff->updated_at->diffForHumans()}}</span>
</div>
