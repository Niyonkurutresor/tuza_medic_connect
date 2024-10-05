@if( $row->consultation_date == null )
    N/A
@endif
<div class="badge bg-primary">
    <div class="">
        {{ \Carbon\Carbon::parse($row->consultation_date)->isoFormat('DD MMM YYYY hh:mm A') }}
    </div>
</div>
