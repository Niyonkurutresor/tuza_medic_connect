<a data-turbo="false" title="Impersonate {{$row->user->full_name}}" class="btn btn-primary btn-sm me-5"
   style="width: fit-content;" href="{{route(
                        'impersonate', $row->user->id)}}">
    {{__('messages.common.impersonate')}}
</a>
