<div class="d-flex justify-content-center">
    <a href="{{ route('patients.patient.visits.show', $row->id) }}" title="{{ __('messages.common.show') }}" class="btn px-1 text-primary fs-3 user-edit-btn" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.show') }}">
        <i class="fas fa-eye"></i>
    </a>
</div>
