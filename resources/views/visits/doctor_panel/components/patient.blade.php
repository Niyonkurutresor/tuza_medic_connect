<div class="d-flex align-items-center">
    <a href="{{ getLogInUser()->hasRole('doctor') ? url('doctors/patients-detail/'.$row->patient_id) : route('patients.show', $row->patient_id)}}" class="mb-1 text-decoration-none fs-6">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->visitPatient->profile}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{ getLogInUser()->hasRole('doctor') ? url('doctors/patients-detail/'.$row->patient_id) : route('patients.show', $row->patient_id)}}" class="mb-1 text-decoration-none fs-6">
            {{$row->visitPatient->user->full_name}}
        </a>
        <span class="fs-6">{{$row->visitPatient->user->email}}</span>
    </div>
</div>
