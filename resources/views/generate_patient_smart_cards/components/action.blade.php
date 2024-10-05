<div class="d-flex justify-content-center">

    @if (isRole('doctor'))
        <a href="{{ route('doctors.doctors.smartCardPdf', $row->id) }}" target="_blank"
            class="btn px-1 text-primary fs-3" data-id='{{$row->id}}' data-bs-toggle="tooltip"
            data-bs-original-title="{{ __('messages.common.download') }}">
            <i class="fa fa-download" aria-hidden="true"></i>
        </a>
    @endif
    {{-- @if (isRole('patient'))
        <a href="{{ route('patients.patients.smartCardPdf', $row->id) }}" target="_blank"
            class="btn px-1 text-primary fs-3" data-id='{{$row->id}}' data-bs-toggle="tooltip"
            data-bs-original-title="{{ __('messages.common.download') }}">
            <i class="fa fa-download" aria-hidden="true"></i>
        </a>
    @endif --}}
    @if (isRole('clinic_admin'))
        <a href="{{ route('admin.smartCardPdf', $row->id) }}" target="_blank"
            class="btn px-1 text-primary fs-3" data-id='{{$row->id}}' data-bs-toggle="tooltip"
            data-bs-original-title="{{ __('messages.common.download') }}">
            <i class="fa fa-download" aria-hidden="true"></i>
        </a>
    @endif

    <a href="javascript:void(0)" class="btn px-1 text-primary fs-3 show_patient_card" data-id="{{$row->id}}" data-toggle="modal" data-target="#show_card_modal" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('messages.common.view') }}"> <i class="fas fa-eye"></i></a>

    @if (!isRole('patient'))
        <a href="javascript:void(0)" data-id="{{ $row->id }}" data-name="{{ $row->user->first_name }}" data-bs-toggle="tooltip"
        data-bs-original-title="{{ __('messages.common.delete') }}"
        class="btn px-1 text-danger fs-3 generate-patient-card-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    @endif
</div>
