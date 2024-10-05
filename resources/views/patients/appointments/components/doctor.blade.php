<div class="d-flex align-items-center">
    <a href="javascript:void(0)">
        <div class="image image-circle image-mini me-3">
            <img src="{{ $row->doctor->user->profile_image}}" alt="user" class="user-img">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="javascript:void(0)" class="mb-1 text-decoration-none fs-6">
            {{$row->doctor->user->full_name}}
        </a>
        <span class="fs-6">{{$row->doctor->user->email}}</span>
    </div>
</div>
