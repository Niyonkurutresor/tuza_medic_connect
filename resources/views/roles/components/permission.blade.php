@forelse($row->permissions as $key => $permission)
    <span class="badge bg-{{ getBadgeColor($key) }} fs-7 m-1">{{$permission->display_name}}</span>
@empty
    {{__('messages.common.n/a')}}
@endforelse
