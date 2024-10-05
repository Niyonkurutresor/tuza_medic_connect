@if($row->session_meeting_time >= 60)
    <span class="badge bg-primary">{{ intdiv($row->session_meeting_time, 60).':'. ($row->session_meeting_time % 60)." ".__('messages.common.hour') }}</span>
@else
    <span class="badge bg-primary">{{ $row->session_meeting_time." ".__('messages.common.minutes') }}</span>
@endif
