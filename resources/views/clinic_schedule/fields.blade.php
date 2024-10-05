@php($weekDays = App\Models\ClinicSchedule::WEEKDAY_FULL_NAME)
@php($slots = getSchedulesTimingSlot())
<div class="row gx-10 mb-9">
    <div class="col-12">
        <div class="maincard-section p-0">
            @foreach (App\Models\ClinicSchedule::WEEKDAY as $day => $shortWeekDay)
                @php($isValid = $clinicSchedules->where('day_of_week', $day)->count() != 0)
                <div class="weekly-content" data-day="{{ $day }}">
                    <div class="d-flex w-100 align-items-center position-relative">
                        <div class="d-flex flex-wrap w-100">
                            <div class="form-check mb-0 checkbox-content d-flex align-items-center">
                                <input id="chkShortWeekDay_{{ $shortWeekDay }}" class="form-check-input min-w-input"
                                    type="checkbox" value="{{ $day }}" name="checked_week_days[]"
                                    @if ($isValid) checked="checked" @endif>
                                <label class="form-check-label ms-2 me-5" for="chkShortWeekDay_{{ $shortWeekDay }}">
                                    <span class="fs-5 fw-bold d-md-block">{{ $shortWeekDay }}</span>
                                </label>
                            </div>
                            <div class="session-times">
                                @if ($clinicSchedule = $clinicSchedules->where('day_of_week', $day)->first())
                                    @include('clinic_schedule.slot', [
                                        'slot' => $slots,
                                        'day' => $day,
                                        'clinicSchedule' => $clinicSchedule,
                                    ])
                                @else
                                    @include('clinic_schedule.slot', ['slot' => $slots, 'day' => $day])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div>
    {{ Form::submit(__('messages.common.save'), ['class' => 'btn btn-primary me-2']) }}
</div>
