<div class="mt-7">
    <div class="d-flex justify-content-between align-items-center pb-4">
        <ul class="nav nav-tabs pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link active p-0" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                    type="button" role="tab" aria-controls="overview" aria-selected="true">
                    {{ __("messages.common.overview") }}
                </button>
            </li>
            <li class="nav-item position-relative me-7 mb-3" role="presentation">
                <button class="nav-link p-0" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button"
                    role="tab" aria-controls="user" aria-selected="true">
                    {{ __("messages.prescription.prescriptions") }}
                </button>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.appointment_unique_id') }}:</label>
                            <span class="fs-4 text-gray-800">
                                <span class="badge bg-warning">{{$appointment['data']->appointment_unique_id}}</span>
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.appointment_at') }}:</label>
                            <span class="fs-4 text-gray-800">
                                <span class="badge bg-info">
                                                        {{ \Carbon\Carbon::parse($appointment['data']->date)->isoFormat('DD MMM YYYY')}} {{$appointment['data']->from_time}} {{$appointment['data']->from_time_type}} - {{$appointment['data']->to_time}} {{$appointment['data']->to_time_type}}
                                                    </span>
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.status') }}:</label>
                            <span class="fs-4 text-gray-800">
                                <span class="badge bg-{{ getStatusBadgeColor($appointment['data']->status)}}">
                                    {{\App\Models\Appointment::STATUS[$appointment['data']->status]}}
                                </span>
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.doctor') }}:</label>
                            <span class="fs-4 text-gray-800">
                                <a class="text-decoration-none text-gray-800">
                                    {{$appointment['data']->doctor->user->full_name}}
                                </a>
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.service') }}:</label>
                            <span class="fs-4 text-gray-800">{{$appointment['data']->services->name}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor_appointment.amount') }}:</label>

                            <span class="fs-4 text-gray-800">{{ getCurrencyFormat(getCurrencyCode(),$appointment['data']->payable_amount)}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.status') }}:</label>
                            <span class="fs-4 text-gray-800">
                                <span class="badge bg-{{($appointment['data']->payment_type === \App\Models\Appointment::PAID)?'success':'danger'}}">
                                    {{($appointment['data']->payment_type === \App\Models\Appointment::PAID)?'PAID':'PENDING'}}
                                </span>

                            </span>
                        </div>
                        @if($appointment['data']->payment_type === \App\Models\Appointment::PAID)
                            <div class="col-md-6 d-flex flex-column">
                                <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.payment_method') }}:</label>
                                <span class="fs-4 text-gray-800">
                                            {{ !empty($appointment['data']->payment_method) ? \App\Models\Appointment::PAYMENT_METHOD[$appointment['data']->payment_method] : __('messages.common.n/a') }}
                                        </span>
                            </div>
                        @endif
                        <div class="col-md-6 d-flex flex-column">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.patient.registered_on') }}:</label>
                            <span class="fs-4 text-gray-800">
                                {{$appointment['data']->created_at->diffForHumans()}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                    <div class="row">
                        <div>
                            <livewire:prescription-table :id="$appointment['data']->id"/>
                            @include('prescriptions.templates.templates')
                            {{Form::hidden('prescriptionUrl',url('prescriptions'),['id'=>'indexPrescriptionUrl'])}}
                            {{Form::hidden('doctorUrl',url('doctors'),['id'=>'indexPrescriptionDoctorUrl'])}}
                            {{Form::hidden('patientUrl',route('patients.index'),['id'=>'indexPrescriptionPatientUrl'])}}
                            {{ Form::hidden('prescriptionLang',__('messages.prescription.prescription'), ['id' => 'prescriptionLang']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
