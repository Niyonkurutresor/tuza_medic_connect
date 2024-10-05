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
                            <label for="name" class="pb-4 fs-4 text-gray-600">{{ __('messages.appointment.status') }}:</label>
                            <div class="w-50 d-flex align-items-center">
                                <span class="slot-color-dot badge bg-{{getBadgeStatusColor($appointment['data']->status)}} badge-circle me-2"></span>
                                <select class="io-select2 form-select appointment-status-change appointment-status"
                                        data-control="select2"
                                        data-id="{{$appointment['data']->id}}">
                                    <option class="booked" disabled value="{{ $book}}" {{$appointment['data']->status ==
                                                $book ? 'selected' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[1]))}}
                                    </option>
                                    <option value="{{ $checkIn}}" {{$appointment['data']->status ==
                                                $checkIn ? 'selected' : ''}} {{$appointment['data']->status == $checkIn
                                        ? 'selected'
                                        : ''}} {{( $appointment['data']->status == $cancel || $appointment['data']->status == $checkOut)
                                        ? 'disabled'
                                        : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[2]))}}
                                    </option>
                                    <option value="{{ $checkOut}}" {{$appointment['data']->status ==
                                                $checkOut ? 'selected' : ''}} {{($appointment['data']->status == $cancel ||
                                        $appointment['data']->status == $book) ? 'disabled' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[3]))}}
                                    </option>
                                    <option value="{{$cancel}}" {{$appointment['data']->status ==
                                                $cancel ? 'selected' : ''}} {{$appointment['data']->status == $checkIn
                                        ? 'disabled'
                                        : ''}} {{$appointment['data']->status == $checkOut ? 'disabled' : ''}}>{{__('messages.common.'.strtolower(\App\Models\Appointment::STATUS[4]))}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.patient') }}:</label>
                            <span class="fs-4 text-gray-800">
                                @if(getLogInUser()->hasRole('doctor'))
                                    <span class="text-decoration-none">
                                        {{$appointment['data']->patient->user->full_name}}
                                    </span>
                                @else
                                    <a href="{{route('patients.show',$appointment['data']->patient->id)}}" class="text-decoration-none">
                                        {{$appointment['data']->patient->user->full_name}}
                                    </a>
                                @endif
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.doctor') }}:</label>
                            <span class="fs-4 text-gray-800">
                                @if(Auth::user()->hasRole('doctor'))
                                    <a href="{{route('doctors.doctors.detail',$appointment['data']->doctor->id)}}" class="text-decoration-none">
                                        {{$appointment['data']->doctor->user->full_name}}
                                    </a>
                                @else
                                    <a href="{{route('doctors.show',$appointment['data']->doctor->id)}}" class="text-decoration-none">
                                        {{$appointment['data']->doctor->user->full_name}}
                                    </a>
                                @endif
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.service') }}:</label>
                            <span class="fs-4 text-gray-800">{{$appointment['data']->services->name}}</span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor_appointment.amount') }}:</label>
                            <span class="fs-4 text-gray-800">  {{ getCurrencyFormat(getCurrencyCode(),$appointment['data']->payable_amount) }}  </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column mb-md-1 mb-5">
                            <label for="name" class="pb-4 fs-4 text-gray-600">{{ __('messages.appointment.payment') }}:</label>
                            <div class="w-50">
                                @if ($appointment['data']->payment_type != $paid)
                                    <select class="io-select2 form-select appointment-change-payment-status payment-status"
                                        style="min-width: 150px; max-width:150px;" data-control="select2" data-id="{{ $appointment['data']->id }}">
                                        <option value="{{ $paid }}"
                                            {{ $appointment['data']->payment_type == $paid ? 'selected' : '' }}>
                                            {{ __('messages.transaction.paid') }}
                                        </option>
                                        <option value="{{ $pending }}"
                                            {{ $appointment['data']->payment_type == $paid ? 'disabled' : 'selected' }}>
                                            {{ __('messages.transaction.pending') }}
                                        </option>
                                    </select>
                                @else
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-light-success">{{ __('messages.transaction.paid') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($appointment['data']->payment_type === \App\Models\Appointment::PAID)
                            <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                                <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.appointment.payment_method') }}:</label>
                                <span class="fs-4 text-gray-800">
                                    {{ !empty($appointment['data']->payment_method) ? \App\Models\Appointment::PAYMENT_METHOD[$appointment['data']->payment_method] : __('messages.common.n/a') }}
                                </span>
                            </div>
                        @endif
                        <div class="col-md-6 d-flex flex-column">
                            <label for="name" class="pb-2 fs-4 text-gray-600">{{ __('messages.doctor.created_at') }}:</label>
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
