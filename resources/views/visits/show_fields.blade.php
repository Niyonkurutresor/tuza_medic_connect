@php $styleCss = 'style' @endphp
<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.web.patient_name')}}</label>
                    <span class="fs-4 text-gray-800">
                        <a href="{{ getLogInUser()->hasRole('doctor') ?  url('doctors/patients/'.$visit->visitPatient->id) :  route('patients.show', $visit->visitPatient->id) }}"
                                                         class="fs-3 text-gray-800 text-hover-primary mb-3 text-decoration-none">{{ $visit->visitPatient->user->full_name }}</a></span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.user.email')}}</label>
                    <span class="fs-4 text-gray-800">{{ $visit->visitPatient->user->email }}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.patient.profile')}}</label>
                    <img src="{{ $visit->visitPatient->profile }}" alt="user" class="object-cover image image-circle" style="height: 50px; width: 50px">
                </div>
                @if(!getLogInUser()->hasRole('doctor'))
                    <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                        <label class="pb-2 fs-4 text-gray-600">{{__('messages.visit.doctor')}}</label>
                        <span class="fs-4 text-gray-800"> {{$visit->visitDoctor->user->full_name }}</span>
                    </div>
                @endif
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.visit.visit_date')}}</label>
                    <span class="fs-4 text-gray-800">{{\Carbon\Carbon::parse($visit->visit_date)->isoFormat('DD MMM YYYY')}}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.doctor.created_at')}}</label>
                    <span class="fs-4 text-gray-800" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="{{\Carbon\Carbon::parse($visit->created_at)->isoFormat('DD MMM YYYY')}}">{{$visit->updated_at->diffForHumans()}}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.doctor.updated_at')}}</label>
                    <span class="fs-4 text-gray-800" data-bs-toggle="tooltip" data-bs-placement="top"
                          title="{{\Carbon\Carbon::parse($visit->updated_at)->isoFormat('DD MMM YYYY')}}">{{$visit->updated_at->diffForHumans()}}</span>
                </div>
                @if(getLogInUser()->hasRole('doctor'))
                    <div class="col-md-12 d-flex flex-column mb-md-10 mb-5">
                        <label class="pb-2 fs-4 text-gray-600">{{__('messages.visit.description')}}</label>
                        <span class="fs-4 text-gray-800" style="max-height: 200px; overflow:auto;">{{!empty($visit->description) ? $visit->description : 'N/A'}}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="flex-lg-row-fluid">
    <!--begin:::Tabs-->
    <ul class="nav nav-tabs mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="subAnalytics" role="tablist">
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
               href="#problesTab">{{ __('messages.visit.problems') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
               href="#observationsTab">{{ __('messages.visit.observations') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
               href="#notesTab">{{ __('messages.visit.notes') }}</a>
        </li>
        <li class="nav-item position-relative me-7 mb-3" role="presentation">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
               href="#prescriptionsTab">{{ __('messages.visit.prescriptions') }}</a>
        </li>
    </ul>
    <!--end:::Tabs-->
    <!--begin:::Tab content-->
    <div class="tab-content" id="myTabContent">
        <!--begin:::Tab pane-->
        <div class="tab-pane fade active show" id="problesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-header align-items-center">
                    <h3 class="align-left m-0">{{ __('messages.visit.problems') }}</h3>
                </div>
                <div class="card-body pt-4">
                    @php $problemRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.problem' : 'add.problem'  @endphp
                    {{ Form::open(['route' => $problemRoute, 'id' => 'addVisitProblem']) }}
                    <div class="p-0 visit-detail-card">
                        <div class="px-2">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if(!empty($visit))
                                        @forelse($visit->problems as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->problem_name }}
                                                <span class="remove-problem" data-id="{{ $val->id }}" title="Delete">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="card-footer p-0 pt-10">
                            <div class="d-flex">
                                {{ Form::hidden('visit_id',$visit->id) }}
                                <div class="w-100">
                                    <div class="form-group mb-0">
                                        <label for="title"
                                               class="sr-only">{{ __('messages.common.title') }}</label>
                                        {{ Form::text('problem_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.visit.enter_problem'),'id' => 'problemName','required']) }}
                                    </div>
                                </div>
                                <div class="text-center mx-5 problem-btn">
                                    {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'problemSubmitBtn']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="observationsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="observationsTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.visit.observations') }}</h3>
                    </div>
                    <div class="card-body p-9 pt-4">
                        @php $observationRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.observation' : 'add.observation' @endphp
                        {{  Form::open(['route' => $observationRoute, 'id' => 'addVisitObservation']) }}
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="observationLists">
                                    @if(!empty($visit))
                                        @forelse($visit->observations as $val)
                                            <li class="list-group-item d-flex text-wrap text-break justify-content-between align-items-center py-5">{{ $val->observation_name }}
                                                <span class="remove-observation" data-id="{{ $val->id }}"
                                                      title="Delete">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                            </div>
                            <div class="card-footer p-0 pt-10">
                                <div class="d-flex">
                                    {{ Form::hidden('visit_id',$visit->id) }}
                                    <div class="w-100">
                                        <div class="form-group mb-0">
                                            <label for="title"
                                                   class="sr-only">{{ __('messages.visit.title') }}</label>
                                            {{ Form::text('observation_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.visit.enter_observation'), 'id' => 'observationName', 'required']) }}
                                        </div>
                                    </div>
                                    <div class=" text-center mx-5">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'observationSubmitBtn']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="notesTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="notesTab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <div class="card-header align-items-center">
                        <h3 class="align-left m-0">{{ __('messages.visit.notes') }}</h3>
                    </div>
                    <div class="card-body p-9 pt-4">
                        @php $noteRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.note' : 'add.note' @endphp
                        {{ Form::open(['route' => $noteRoute, 'id' => 'addVisitNote']) }}
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="noteLists">
                                    @if(!empty($visit))
                                        @forelse($visit->notes as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->note_name }}
                                                <span class="remove-note" data-id="{{ $val->id }}">
                                                    <a href="javascript:void(0)"><i
                                                                class="fas fa-trash text-danger"></i></a>
                                                        </span>
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                            <div class="card-footer p-0 pt-10">
                                <div class="d-flex">
                                    {{ Form::hidden('visit_id',$visit->id) }}
                                    <div class="w-100">
                                        <div class="form-group mb-0">
                                            <label for="title"
                                                   class="sr-only">{{ __('messages.visit.title') }}</label>
                                            {{ Form::text('note_name', null, ['class' => 'form-control form-control-solid', 'placeholder' => __('messages.visit.enter_note'),'id' => 'noteName','required']) }}
                                        </div>
                                    </div>
                                    <div class=" text-center mx-5">
                                        {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary','id'=> 'noteSubmitBtn']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
        <!--begin:::Tab pane-->
        <div class="tab-pane fade" id="prescriptionsTab" role="tabpanel">
            <!--begin::Card-->
            <div class="tab-pane fade active show" id="prescriptionsTab" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="align-left m-0">{{ __('messages.visit.prescriptions') }}</h3>
                    <div class="ml-auto d-flex align-items-center">
                        <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                             href="#addVisitPrescription"
                             role="button" aria-expanded="false"
                             aria-controls="addVisitPrescription">
                            <a href="javascript:void(0)" class="btn btn-primary text-right">{{ __('messages.common.add') }}</a>
                        </div>
                    </div>
                </div>
                @php $prescriptionRoute = getLogInUser()->hasRole('doctor') ? 'doctors.visits.add.prescription' : 'add.prescription' @endphp
                {{ Form::open(['route' => $prescriptionRoute, 'id' => 'addPrescription', 'class' => 'mt-4']) }}
                <div id="addVisitPrescription" class="collapse card p-7">
                    {{ Form::hidden('visit_id',$visit->id) }}
                    <div class="row">
                        {{ Form::hidden('prescription_id',null,['id' => 'prescriptionId']) }}
                        <div class="col-md-3 mb-5">
                            {{ Form::label('prescription_name',  __('messages.prescription.name').' :', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('prescription_name', null,['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.prescription.name'), 'required', 'id' => 'prescriptionNameId','maxlength'=>121]) }}
                        </div>
                        <div class="col-md-3 mb-5">
                            {{ Form::label('frequency',  __('messages.frequency').' :', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('frequency', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.frequency'), 'required', 'id' => 'frequencyId']) }}
                        </div>
                        <div class="col-md-3 mb-5">
                            {{ Form::label('duration',  __('messages.prescription.duration').' :', ['class' => 'form-label required fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::text('duration', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.prescription.duration'),'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'required', 'id' => 'durationId']) }}
                        </div>
                        <div class="col-md-3 mb-5">
                            {{ Form::label('description',  __('messages.visit.description').' :', ['class' => 'form-label fs-6 fw-bolder text-gray-700 mb-3']) }}
                            {{ Form::textarea('description', null, ['class' => 'form-control form-control-solid mb-3 mb-lg-0', 'placeholder' => __('messages.visit.description'),'id' => 'descriptionId', 'rows'=> 5]) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5 mt-5">
                            <div class="w-100 d-flex justify-content-end">
                                {{ Form::submit(__('messages.common.save'),['class' => 'btn btn-primary me-3','id'=> 'prescriptionSubmitBtn']) }}
                                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse"
                                     href="#addVisitPrescription" role="button"
                                     aria-expanded="false" aria-controls="addVisitPrescription">
                                    {{ Form::button(__('messages.common.discard'),['class' => 'btn btn-light btn-active-light-primary reset-form']) }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="overflow-auto">
                    <table class="table table-striped align-middle overflow-auto table-row-dashed fs-6 gy-5 mt-5 whitespace-nowrap">
                        <thead>
                        <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                            <th scope="col">{{ __('messages.prescription.name') }}</th>
                            <th scope="col">{{ __('messages.frequency') }}</th>
                            <th scope="col">{{ __('messages.prescription.duration') }}</th>
                            <th class="text-center" width="20%">{{ __('messages.common.action') }}</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold visit-prescriptions">
                        @if(!empty($visit))
                            @forelse($visit->prescriptions as $prescription)
                                <tr id="prescriptionLists">
                                    <td class="text-break text-wrap">{{$prescription->prescription_name}}</td>
                                    <td class="text-break text-wrap">{{$prescription->frequency}}</td>
                                    <td class="text-break text-wrap">{{$prescription->duration}}</td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)"
                                           data-id="{{$prescription->id}}"
                                           class="btn px-1 text-primary fs-3 edit-prescription-btn"
                                           title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="javascript:void(0)" data-id="{{$prescription->id}}"
                                           class="delete-visit-prescription-btn btn px-1 text-danger fs-3 "
                                           title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr id="noPrescriptionLists">
                                    <td colspan="5" class="text-center font-text-muted text-gray-600" {{$styleCss}}=
                                    'font-size: 13px'>{{ __('messages.common.no_data_available_in_table') }}</td>
                                </tr>
                            @endforelse
                        @endif
                        </tbody>
                    </table>
                </div>
                <!--begin::Card-->
            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
    </div>
    <!--end:::Tab content-->
</div>
