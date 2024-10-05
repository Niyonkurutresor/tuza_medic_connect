@php
    $patientUrl = getLogInUser()->hasRole('doctor') ? route('doctors.patient.detail', $row->patient->id) 
                                                    : 'javascript:void(0)';
    $appointmentUrl  = getLogInUser()->hasRole('doctor') ? route('doctors.appointment.detail', $row->id) 
                                                         : route('patients.appointment.detail', $row->id);
@endphp
<div class="d-flex align-items-center">
    <a href="javascript:void(0)">
        <div class="image image-circle image-mini me-3">
            <img src="{{ $row->patient->profile}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        @if(getLogInUser()->hasRole('clinic_admin'))
            <a href="{{route('patients.show', $row->patient->id)}}" class="mb-1 text-decoration-none fs-6">
                {{$row->patient->user->full_name}}
            </a>
        @else
            <a href="{{$patientUrl}}" class="mb-1 text-decoration-none fs-6">
                {{$row->patient->user->full_name}}
            </a>
        @endif
        <span class="fs-6"> {{$row->patient->user->email}}</span>
    </div>
</div>
