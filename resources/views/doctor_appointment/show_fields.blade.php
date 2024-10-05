<div class="col-12">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="poverview" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_unique_id') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="badge badge-light-success">{{$appointment['data']->appointment_unique_id}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.appointment_at') }}</label>
                            <div class="col-lg-8 fv-row ps-2">
                                <span class="badge badge-light-info">
                                    {{ \Carbon\Carbon::parse($appointment['data']->date)->isoFormat('DD MMM YYYY')}} {{$appointment['data']->from_time}} {{$appointment['data']->from_time_type}} - {{$appointment['data']->to_time}} {{$appointment['data']->to_time_type}}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor.status') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="badge badge-light-{{ getStatusBadgeColor($appointment['data']->status)}}">{{\App\Models\Appointment::STATUS[$appointment['data']->status]}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.patient') }}</label>
                            <div class="col-lg-8 fv-row">
                                <a href="#"
                                   class="col-lg-8 fv-row">
                                    <span class="fw-bolder fs-6 text-gray-800 text-hover-primary">{{$appointment['data']->patient->user->full_name}}</span>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.service') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 text-gray-800">{{$appointment['data']->services->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.doctor_appointment.amount') }}</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bolder fs-6 bold"><i class="fas fa-dollar-sign text-dark"></i> {{$appointment['data']->payable_amount}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.patient.registered_on') }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800 me-2 " data-bs-toggle="tooltip"
                                      data-bs-placement="right"
                                      title="{{\Carbon\Carbon::parse($appointment['data']->created_at)->isoFormat('DD MMM YYYY')}}">{{$appointment['data']->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pappointments" role="tabpanel">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ __('messages.appointments') }}</h3>
                    </div>
                </div>
                <div>
                    <div class="card-body  border-top p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.appointment.patient')  }}</label>
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
