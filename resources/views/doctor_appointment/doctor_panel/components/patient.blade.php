<div class="d-flex align-items-center">
    <a href="{{ getLogInUser()->hasRole('doctor') ? url('doctors/patients-detail/'.$row->patient->id) : route('patients.show', $row->patient->id)}}">
        <div class="image image-circle image-mini me-3">
            <img src="{{$row->patient->profile}}" alt="" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="{{ getLogInUser()->hasRole('doctor') ? url('doctors/patients-detail/'.$row->patient->id) : route('patients.show', $row->patient->id)}}" class="mb-1 text-decoration-none fs-6">
            {{$row->patient->user->full_name}}
        </a>
        <span class="fs-6">{{$row->patient->user->email}}</span>
    </div>
</div>
