<div class="d-flex align-items-center">
    <div class="image image-mini me-3">
        <a href="{{route('patients.show',$row->patient->id)}}">
            <div>
                <img src="{{$row->patient->profile}}" alt=""
                     class="user-img image rounded-circle object-contain">
            </div>
        </a>
    </div>
    <div class="d-flex flex-column">
        <a href="{{route('patients.show',$row->patient->id)}}"
           class="mb-1 text-decoration-none">{{$row->patient->patientUser->full_name}}</a>
        <span>{{$row->patient->patientUser->email}}</span>
    </div>
</div>
