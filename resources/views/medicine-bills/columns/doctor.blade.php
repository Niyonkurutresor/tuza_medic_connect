
@if(isset($row->doctor_id) && $row->doctor)
    <div class="d-flex align-items-center">
        <div class="image image-mini me-3">
            <a href="{{ url('admin/doctors/'.$row->doctor->id) }}">
                <div>
                    <img src="{{ $row->doctor->doctorUser->profile_image }}" alt=""
                         class="user-img image image-circle object-contain" >
                </div>
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="{{ url('admin/doctors/'.$row->doctor->id) }}"
               class="text-decoration-none mb-1">{{ $row->doctor->doctorUser->full_name }}</a>
            <span>{{ $row->doctor->doctorUser->email }}</span>
        </div>
    </div>
@else
    NA
@endif
