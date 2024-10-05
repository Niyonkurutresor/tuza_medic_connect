<div class="d-flex flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.doctor_session.doctor')}}</label>
                    <span class="fs-4 text-gray-800"> 
                       {{ $visit->visitDoctor->user->full_name }}
                    </span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.user.email')}}</label>
                    <span class="fs-4 text-gray-800">{{ $visit->visitDoctor->user->email }}</span>
                </div>
                <div class="col-md-6 d-flex flex-column mb-md-10 mb-5">
                    <label class="pb-2 fs-4 text-gray-600">{{__('messages.patient.profile')}}</label>
                    <img src="{{ $visit->visitDoctor->user->profile_image }}" class="object-cover image image-circle" alt="user" style="height: 50px; width: 50px">
                </div>
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
                <div class="col-md-12 d-flex flex-column mb-md-10 mb-5">
                        <label class="pb-2 fs-4 text-gray-600">{{__('messages.visit.description')}}</label>
                        <div class="fs-4 text-gray-800" style="max-height: 200px; overflow:auto;">   
                             {!! nl2br(!empty($visit->description) ? $visit->description : 'N/A') !!}
                        </div>
                    </div>
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
                    <div class="p-0 visit-detail-card">
                        <div class="px-2">
                            <div class="col-md-12">
                                <ul class="list-group list-group-flush problem-list" id="problemLists">
                                    @if(!empty($visit))
                                        @forelse($visit->problems as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->problem_name }}
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
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
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="observationLists">
                                    @if(!empty($visit))
                                        @forelse($visit->observations as $val)
                                            <li class="list-group-item d-flex text-wrap text-break justify-content-between align-items-center py-5">{{ $val->observation_name }}
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
            <!--end::Card-->
        </div>
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
                        <div class="p-0 visit-detail-card">
                            <div class="px-2">
                                <ul class="list-group list-group-flush problem-list" id="noteLists">
                                    @if(!empty($visit))
                                        @forelse($visit->notes as $val)
                                            <li class="list-group-item text-wrap text-break d-flex justify-content-between align-items-center py-5">{{ $val->note_name }}
                                            </li>
                                        @empty
                                            <p class="text-center fw-bold mt-3 text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</p>
                                        @endforelse
                                    @endif
                                </ul>
                            </div>
                        </div>
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
                </div>
                <table class="table table-striped align-middle table-row-dashed fs-6 gy-5 mt-5">
                    <thead>
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th scope="col">{{ __('messages.prescription.name') }}</th>
                        <th scope="col">{{ __('messages.frequency') }}</th>
                        <th scope="col">{{ __('messages.prescription.duration') }}</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold visit-prescriptions">
                    @if(!empty($visit))
                        @forelse($visit->prescriptions as $prescription)
                            <tr id="prescriptionLists">
                                <td class="text-break text-wrap">{{$prescription->prescription_name}}</td>
                                <td class="text-break text-wrap">{{$prescription->frequency}}</td>
                                <td class="text-break text-wrap">{{$prescription->duration}}</td>
                            </tr>
                        @empty
                            <tr id="noPrescriptionLists">
                                <td colspan="5"
                                    class="text-center  text-muted text-gray-600">{{ __('messages.common.no_records_found') }}</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
                <!--begin::Card-->

            </div>
            <!--end::Card-->
        </div>
        <!--end:::Tab pane-->
    </div>
    <!--end:::Tab content-->
</div>


