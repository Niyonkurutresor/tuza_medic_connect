@if(!empty($row->user->full_name))
    {{ $row->user->full_name }}
@else
    N/A
@endif
