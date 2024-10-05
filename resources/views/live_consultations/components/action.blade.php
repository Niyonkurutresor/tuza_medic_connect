<div class="d-flex justify-content-center">
    @if( $row->status == 0 )
        <a href="javascript:void(0)" title="{{ getLogInUser()->hasRole('patient') ? 'Join Meeting' : 'Start Meeting' }}"
           class="btn px-2 text-primary fs-2 start-btn" data-id="{{$row->id}}">
            <i class="fa-solid fa-video"></i>
        </a>
    @endif
    @if(getLogInUser()->hasRole('doctor') )
        @if( $row->status == 0 )
            <a href="javascript:void(0)" title="{{ __('messages.common.edit') }}" class="btn px-2 text-primary fs-2 live-consultation-edit-btn" data-bs-toggle="tooltip"
               data-bs-original-title="{{ __('messages.common.edit') }}" data-id="{{$row->id}}">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
        @endif
        <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"  data-bs-toggle="tooltip"
           data-bs-original-title="{{ __('messages.common.delete') }}"
           class="btn px-2 text-danger fs-2 live-consultation-delete-btn">
            <i class="fa-solid fa-trash"></i>
        </a>
    @endif
</div>
