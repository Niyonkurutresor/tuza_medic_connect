<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.web.patient_name') }}</label>
    <span class="fs-6 text-secondary">
        {{ $visit[0]->visitPatient->user->full_name }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.user.email') }}</label>
    <span class="fs-6 text-secondary">{{ $visit[0]->visitPatient->user->email }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.patient.profile') }}</label>
    <img src="{{ $visit[0]->visitPatient->profile }}" alt="user" class="object-cover image image-circle"
        style="height: 50px; width: 50px" loading="lazy">
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.visit.visit_date') }}</label>
    <span
        class="fs-6 text-secondary">{{ \Carbon\Carbon::parse($visit[0]->visit_date)->isoFormat('DD MMM YYYY') }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.doctor.created_at') }}</label>
    <span class="fs-6 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
        title="{{ \Carbon\Carbon::parse($visit[0]->created_at)->isoFormat('DD MMM YYYY') }}">{{ $visit[0]->updated_at->diffForHumans() }}</span>
</div>
<div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
    <label class="pb-2 fs-6 text-secondary">{{ __('messages.doctor.updated_at') }}</label>
    <span class="fs-6 text-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
        title="{{ \Carbon\Carbon::parse($visit[0]->updated_at)->isoFormat('DD MMM YYYY') }}">{{ $visit[0]->updated_at->diffForHumans() }}</span>
</div>
@if (getLogInUser()->hasRole('doctor'))
    <div class="col-md-12 d-flex flex-column mb-md-10 mb-5">
        <label class="pb-2 fs-6 text-secondary">{{ __('messages.visit.description') }}</label>
        <span class="fs-6 text-secondary"
            style="max-height: 200px; overflow:auto;">{{ !empty($visit[0]->description) ? $visit->description : 'N/A' }}</span>
    </div>
@endif
