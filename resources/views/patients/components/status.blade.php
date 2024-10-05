<div class="w-150px d-flex align-items-center m-auto">
    <span class="slot-color-dot badge bg-{{getBadgeStatusColor($row->status)}} badge-circle me-2"></span>
    <select class="patient-show-apptment-status-change"
            data-control="select2"
            data-id="{{$row->id}}">
        <option class="booked" disabled value="{{ $book}}" {{$row->status ==
                    $book ? 'selected' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[1]))}}
        </option>
        <option value="{{ $checkIn}}" {{$row->status ==
                    $checkIn ? 'selected' : ''}} {{$row->status == $checkIn
            ? 'selected'
            : ''}} {{( $row->status == $cancel || $row->status == $checkOut)
            ? 'disabled'
            : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[2]))}}
        </option>
        <option value="{{ $checkOut}}" {{$row->status ==
                    $checkOut ? 'selected' : ''}} {{($row->status == $cancel ||
            $row->status == $book) ? 'disabled' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[3]))}}
        </option>
        <option value="{{$cancel}}" {{$row->status ==
                    $cancel ? 'selected' : ''}} {{$row->status == $checkIn
            ? 'disabled'
            : ''}} {{$row->status == $checkOut ? 'disabled' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[4]))}}
        </option>
    </select>
</div>
