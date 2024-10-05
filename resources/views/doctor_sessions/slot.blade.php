@php
    /** @var \App\Models\WeekDay $weekDaySlot */
@endphp
<div class="align-items-center justify-content-between mt-md-0 mt-10 timeSlot">
    <div class="flex-xs-column d-flex align-items-center mb-3 add-slot">
        <div class="d-inline-block me-3">
            {{ Form::select('startTimes['.$day.'][]', $slots, isset($weekDaySlot) ? $weekDaySlot->full_start_time :  $slots[array_key_first($slots)] ,['class' => 'form-control form-control-solid form-select startTimeSlot', 'data-control'=>'select2','disabled'=>false]) }}
        </div>
        <span class="small-border me-3">-</span>
        <div class="d-inline-block">
            {{ Form::select('endTimes['.$day.'][]', $slots, isset($weekDaySlot) ? $weekDaySlot->full_end_time :  end($slots),['class' => 'form-control form-control-solid form-select endTimeSlot', 'data-control'=>'select2','disabled'=>false]) }}
        </div>
        <a href="javascript:void(0)" class="deleteBtn mt-5">
            <i class="fa-solid fa-trash ms-5 fs-3 text-danger"></i>
        </a>
    </div>
    <span class="error-msg text-danger"></span>
</div>
