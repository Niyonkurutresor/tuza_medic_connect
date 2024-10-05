<div class="badge bg-primary">
    <div class="mb-2">{{$row->from_time}} {{ $row->from_time_type }}
        - {{$row->to_time}} {{ $row->to_time_type}}</div>
    <div class="">{{ \Carbon\Carbon::parse($row->date)->isoFormat('DD MMM YYYY') }}
    </div>
</div>
