<div class="d-flex justify-content-center">

    @if (isRole('doctor'))
    <a href="{{ route('doctors.smart-patient-cards.edit', $row->id)  }}" title="{{__('messages.common.edit') }}"
        class="btn px-1 text-primary fs-3 ps-0">
         <i class="fa-solid fa-pen-to-square"></i>
     </a>
    @endif
    @if (isRole('clinic_admin'))
    <a href="{{ route('smart-patient-cards.edit', $row->id)  }}" title="{{__('messages.common.edit') }}"
        class="btn px-1 text-primary fs-3 ps-0">
         <i class="fa-solid fa-pen-to-square"></i>
     </a>
    @endif

    <a href="javascript:void(0)" title="{{__('messages.common.delete')}}" data-id="{{ $row->id }}" data-name="{{ $row->template_name }}" wire:key="{{$row->id}}"
       class="smart-patient-card-delete-btn btn px-1 text-danger fs-3 ps-0">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>

