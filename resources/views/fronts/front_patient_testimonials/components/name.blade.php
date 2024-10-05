<div class="d-flex align-items-center">
    <a href="javascript:void(0)">
        <div class="image image-circle image-mini me-3">
            <img src="{{ $row->front_patient_profile }}" alt="" class="user-img" loading="lazy">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="javascript:void(0)" class="mb-1 text-decoration-none fs-6">
            {{ $row->name }}
        </a>
        <span class="fs-6">{{ $row->designation}}</span>
    </div>
</div>
