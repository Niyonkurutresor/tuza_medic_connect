<div class="w-150px d-flex align-items-center m-auto">
    @if ($row->status == $book)
    <span class="badge text-dark" style="background-color: #6571FF"> {{ $row->status == $book ? 'book' : '' }}</span>
    @endif
    @if ($row->status == $checkIn)
    <span class="badge text-dark" style="background-color: #0AC074"> {{ $row->status == $checkIn ? 'chech In' : '' }}</span>
    @endif
    @if ($row->status == $checkOut)
    <span class="badge text-dark" style="background-color: #FFB821"> {{ $row->status == $checkOut ? 'check Out' : '' }}</span>
    @endif
    @if ($row->status == $cancel)
    <span class="badge text-dark" style="background-color: #F62947"> {{ $row->status == $cancel ? 'cancel' : '' }}</span>
    @endif
</div>
