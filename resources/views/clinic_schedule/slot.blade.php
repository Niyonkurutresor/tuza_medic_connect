@php
    /** @var \App\Models\ClinicSchedule $clinicSchedule */
@endphp
<div class="d-flex flex-xs-column align-items-center my-4 add-slot">
    <div class="d-inline-block">
      {{ Form::select('clinicStartTimes['.$day.']', $slots, isset($clinicSchedule) ? $clinicSchedule->start_time : $slots[array_key_first($slots)] ,['class' => 'form-select io-select2', 'data-control'=>'select2']) }}    </div>
    <span class="px-3">To</span>
    <div class="d-inline-block">
    {{ Form::select('clinicEndTimes['.$day.']', $slots, isset($clinicSchedule) ? $clinicSchedule->end_time :  $slots[array_key_last($slots)],['class' => 'form-select io-select2', 'data-control'=>'select2']) }}
    </div>
</div>
