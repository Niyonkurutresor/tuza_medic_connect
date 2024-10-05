@php
    $patientUrl = getLogInUser()->hasRole('doctor') ? route('doctors.patient.detail', $row->patient->id) 
                                                    : 'javascript:void(0)';
    $appointmentUrl  = getLogInUser()->hasRole('doctor') ? route('doctors.appointment.detail', $row->id) 
                                                         : route('patients.appointment.detail', $row->id);
@endphp
<div class="d-flex justify-content-center">
    @if(getLogInUser()->hasRole('clinic_admin'))
        <a href="{{ route('appointments.show', $row->id) }}" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.show') }}"
           class="btn px-2 text-primary fs-2 user-edit-btn" data-id="{{$row->id}}">
            <i class="fas fa-eye"></i>
        </a>
    @else
        <a href="{{ $appointmentUrl }}" title="{{ __('messages.common.show') }}" data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.show') }}"
           class="btn px-2 text-primary fs-2 user-edit-btn" data-id="{{$row->id}}">
            <i class="fas fa-eye"></i>
        </a>
    @endif
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}" data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}"
       class="btn px-2 text-danger fs-2 doctor-show-apptment-delete-btn">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
