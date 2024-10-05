@php
    $colors = [
        'warning',
        'danger',
        'success'
    ]
@endphp
<div class="d-flex align-items-center justify-content-center">
@if( auth()->user()->hasAnyRole('doctor', 'admin') )
@if($row->status == 0)

        <span class="slot-color-dot badge bg-{{ $colors[$row->status] }} badge-circle me-2"></span>
        <select class="io-select2 form-select consultation-change-status"
                data-id="{{ $row->id }}" data-control="select2">
            <option value="0" {{ $row->status == 0 ? 'selected' : '' }} {{ $row->status == 1 || $row->status == 2 ? 'disabled' : '' }}>
                {{ __('messages.filter.awaited') }}
            </option>
            <option value="1" {{ $row->status == 1 ? 'selected' : '' }} {{ $row->status == 2 ? 'disabled' : '' }}>
                {{ __('messages.filter.cancelled') }}
            </option>
            <option value="2" {{ $row->status == 2 ? 'selected' : '' }} {{ $row->status == 1 ? 'disabled' : '' }}>
                {{ __('messages.filter.finished') }}
            </option>
        </select>
    @elseif($row->status == 1)
    <span class="badge bg-danger">{{ __('messages.filter.cancelled') }}</span>
    @else
    <span class="badge bg-success">{{ __('messages.filter.finished') }}</span>
@endif

@else
    @if( $row->status == 1 )
        <span class="badge bg-danger">{{ __('messages.filter.cancelled') }}</span>
    @elseif( $row->status == 0 )
        <span class="badge bg-warning">{{ __('messages.filter.awaited') }}</span>
    @else
        <span class="badge bg-success">{{ __('messages.filter.finished') }}</span>
    @endif
@endif
</div>
