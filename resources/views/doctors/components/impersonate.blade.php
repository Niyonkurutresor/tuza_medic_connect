@if($row->user->status)
    <a data-turbo="false" title="Impersonate {{$row->user->full_name}}" class="btn btn-sm btn-primary me-5"
       style="width: fit-content;" href="{{route('impersonate', $row->user->id)}}">
        {{__('messages.common.impersonate')}}
    </a>
@else
    <a data-turbo="false" title="Impersonate {{$row->user->full_name}}" class="btn btn-sm btn-secondary me-5"
       style="pointer-events: none; cursor: default;" href="{{route('impersonate', $row->user->id)}}">
        {{__('messages.common.impersonate')}}
    </a>
@endif
