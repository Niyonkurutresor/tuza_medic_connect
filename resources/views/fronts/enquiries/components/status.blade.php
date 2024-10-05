@if($row->view)
    <div class="badge bg-success">{{ __('messages.common.read') }}</div>
@else
    <div class="badge bg-danger">{{ __('messages.common.unread') }}</div>
@endif
