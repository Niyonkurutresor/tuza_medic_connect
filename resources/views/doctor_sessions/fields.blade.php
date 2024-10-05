@php($weekDays = App\Models\ClinicSchedule::WEEKDAY_FULL_NAME)
@php($gaps = App\Models\DoctorSession::GAPS)
@php($sessionMeetingTime = App\Models\DoctorSession::SESSION_MEETING_TIME)
@php($clinicSchedule = App\Models\ClinicSchedule::all())
<div class="row">
    <div class="col-12">
        <div class="maincard-section ps-0 pb-4">
            <div class="row">
                @if(isset($doctorSession))
                    <div class="d-flex justify-content-between">
                        <div class="pb-2 d-flex align-items-center justify-content-lg-between">
                            <div class="me-3">
                                <div class="symbol-label image image-circle image-circle image-mini">
                                    <img src="{{$doctorSession->doctor->user->profile_image}}" class="object-cover"
                                         alt=""/>
                                </div>
                            </div>
                            <span class="fs-3 fw-bolder me-3">{{$doctorSession->doctor->user->full_name}}</span>
                        </div>
                    </div>
                @endif
                @if(Auth::user()->hasRole('doctor'))
                    <input type="hidden" name="doctor_id" value="{{ Auth::user()->doctor->id }}"/>
                @elseif(!isset($sessionWeekDays))
                    <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6 p-0">
                        <div class="my-4 ms-3">
                            {{ Form::label('doctor_id',__('messages.doctor.doctor').':' ,['class' => 'form-label required']) }}
                            {{ Form::select('doctor_id', $doctorsList, null,['class' => 'form-control', 'data-control'=>'select2','placeholder' => __('messages.common.select_doctor'),'required']) }}
                        </div>
                    </div>
                @endif
                <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6 ps-0">
                    <div class="my-4 ms-3">
                        {{ Form::label('session_gap',__('messages.doctor_session.session_gap').':' ,['class' => 'form-label required']) }}
                        {{ Form::select('session_gap', $gaps,isset($sessionWeekDays)  ? null : $gaps[array_key_first($gaps)],
['class' => 'form-control','data-width' => '100%', 'data-control'=>'select2','id' => 'selGap', 'placeholder' => __('messages.doctor_session.select_session_gap'),'required']) }}
                    </div>
                </div>
                <div class="{{ isset($doctorSession) ? 'col-xl-6' : 'col-xl-4' }} col-sm-6">
                    <div class="my-4 ms-3">
                        {{ Form::label('session_meeting_time',__('messages.doctor_session.session_meeting_time').':' ,['class' => 'form-label required']) }}
                        {{ Form::select('session_meeting_time', $sessionMeetingTime, isset($sessionWeekDays)  ? null : $sessionMeetingTime[array_key_first($sessionMeetingTime)],
['class' => 'form-control','data-width' => '100%', 'data-control'=>'select2' ,'placeholder' => __('messages.doctor_session.select_meeting_time'),'required']) }}
                    </div>
                </div>
            </div>
            @foreach(App\Models\ClinicSchedule::WEEKDAY as $day => $shortWeekDay)
                @php($isValid = isset($sessionWeekDays) && $sessionWeekDays->where('day_of_week',$day)->count() != 0)
                @php($clinicScheduleDay = $clinicSchedule->where('day_of_week',$day)->first())
                <div class="weekly-content " data-day="{{$day}}">
                    <div class="d-flex w-100 align-items-center position-relative border-bottom">
                        <div class="d-flex w-100 weekly-row my-3 ">
                            <div
                                class="form-check form-check-custom form-check-solid mb-0 checkbox-content d-flex align-items-center p-5 w-auto">
                                <input id="chkShortWeekDay_{{$shortWeekDay}}" class="form-check-input timechackbox mt-sm-5 mt-md-0 me-2  min-w-input"
                                       type="checkbox"
                                       value="{{$day}}" name="checked_week_days[]"
                                       @if(isset($sessionWeekDays))
                                       @if($isValid)
                                       checked="checked"
                                       @else
                                       disabled
                                       @endif
                                       @elseif(!$loop->last && $clinicScheduleDay)
                                       checked="checked"
                                       @else
                                       disabled
                                    @endif>
                                <label class="form-check-label" for="chkShortWeekDay_{{$shortWeekDay}}">
                                    <span class="fs-5 fw-bold d-md-block d-none">{{ __('messages.weekdays.'.strtolower($shortWeekDay)) }}</span>
                                </label>
                            </div>
                            @if(isset($sessionWeekDays))
                                @if(!$isValid)
                                    <div class="unavailable-time">{{ __('messages.doctor_session.unavailable') }}</div>
                                @endif
                            @elseif($loop->last || !$clinicScheduleDay)
                                <div class="unavailable-time">{{ __('messages.doctor_session.unavailable') }}</div>
                            @endif
                            <div class="session-times">
                                @if($clinicScheduleDay)
                                    @php($slots = getSlotByGap($clinicScheduleDay->start_time,$clinicScheduleDay->end_time))
                                    @if(isset($sessionWeekDays) && $sessionWeekDays->count())
                                        @foreach($sessionWeekDays->where('day_of_week',$day) as $weekDaySlot)
                                            @include('doctor_sessions.slot',['slot' => $slots,'day' => $day,'weekDaySlot' => $weekDaySlot])
                                        @endforeach
                                    @else
                                        @if(!$loop->last)
                                            @if(!isset($sessionWeekDays) || $isValid)
                                                @include('doctor_sessions.slot',['slot' => $slots,'day' => $day])
                                            @endif
                                        @else
                                            <div class="session-time"></div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                        @if($clinicScheduleDay)
                            <div class="weekly-icon position-absolute end-0 d-flex mt-5">
                                <button type="button" title="plus" class="btn px-2 text-gray-600 fs-2 add-session-time">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <div class="dropdown d-flex align-items-center py-4">
                                    <button class="btn dropdown-toggle ps-2 pe-0 hide-arrow copy-dropdown" type="button"
                                            id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown" aria-expanded="false"
                                            data-bs-auto-close="outside">
                                        <i class="fa-solid fa-copy text-gray-600 fs-2"></i>
                                    </button>
                                    <div class="copy-card dropdown-menu py-0 rounded-10 min-width-220"
                                         aria-labelledby="dropdownMenuButton1">
                                        <div class="p-5">
                                            <div class="menu-item">
                                                <div class="menu-content">
                                                    @foreach($weekDays as $weekDayKey => $weekDay)
                                                        @if($day != $weekDayKey && $clinicSchedule->where('day_of_week',$weekDayKey)->count())
                                                            <div
                                                                class="form-check form-check-custom form-check-solid copy-label my-3">
                                                                <label class="form-check-label w-100 ms-0 cursor-pointer"
                                                                       for="chkCopyDay_{{$shortWeekDay}}_{{ __('messages.doctor_session.'.strtolower($weekDay)) }}">
                                                                    {{ __('messages.doctor_session.'.strtolower($weekDay)) }}
                                                                </label>
                                                                <input class="form-check-input copy-check-input cursor-pointer"
                                                                       id="chkCopyDay_{{$shortWeekDay}}_{{$weekDay}}"
                                                                       type="checkbox" value="{{$weekDayKey}}"/>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    <button type="button" class="btn btn-primary w-100 copy-btn"
                                                            data-copy-day="{{$day}}">
                                                        {{ __('messages.doctor_session.copy') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="mt-5">
    @if($clinicSchedule->count() == 0)
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2','disabled']) }}
    @else
        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-2']) }}
    @endif
    @if(!getLogInUser()->hasRole('doctor'))
        <a href="{{url()->previous()}}" type="reset"
           class="btn btn-light btn-active-light-primary">{{__('messages.common.discard')}}</a>
    @endif
</div>
