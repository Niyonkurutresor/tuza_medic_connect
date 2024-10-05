@extends('layouts.app')
@section('title')
    {{__('messages.dashboard')}}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">

                    <div class="col-xl-4 ">
                      <livewire:doctor-dashboard-table  />
                    </div>
                    <div class="col-xl-8">
                        <div class="row">
                          <div class="col">
                              <div class="row">
                                 <livewire:doctor-dashboard-sidebar-table />
                              </div>
                           </div>
                        </div>
                        <!--begin::Charts Widget 8-->
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column mb-3">
                                    <span
                                        class="card-label fw-bolder fs-3 mb-1">{{__('messages.monthly_appointments')}}
                                    </span>
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body appointmentDoctorChart">
                                {{Form::hidden('admin_chart_data',json_encode($doctorAllAppointment,true) ,['id' => 'doctorChartData'])}}
                                <!--begin::Chart-->
                                <div id="appointmentDoctorChartId" style="height: 350px" class="card-rounded-bottom"></div>
                                <!--end::Chart-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Charts Widget 8-->
                    </div>


                <div class="col-xxl-12">
                    <div class="d-flex border-0 pt-5">
                        <h3 class="align-items-start flex-column">
                            <span class="fw-bolder fs-3 mb-1">{{__('messages.doctor_dashboard.recent_appointments')}}</span>
                        </h3>
                        <div class="ms-auto d-sm-block d-none">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active text-primary btn-active-light-primary fw-bolder px-4 active"
                                       data-bs-toggle="tab"
                                       id="doctorDayData">{{__('messages.admin_dashboard.day')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1"
                                       data-bs-toggle="tab"
                                       id="doctorWeekData">{{__('messages.admin_dashboard.week')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 "
                                       data-bs-toggle="tab"
                                       id="doctorMonthData">{{__('messages.admin_dashboard.month')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="ms-auto d-flex d-sm-none d-block mt-2 mb-2 justify-content-end">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active text-primary btn-active-light-primary fw-bolder px-4 active"
                                   data-bs-toggle="tab"
                                   id="doctorDayData">{{__('messages.admin_dashboard.day')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1"
                                   data-bs-toggle="tab"
                                   id="doctorWeekData">{{__('messages.admin_dashboard.week')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light-primary fw-bolder px-4 me-1 "
                                   data-bs-toggle="tab"
                                   id="doctorMonthData">{{__('messages.admin_dashboard.month')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                     <livewire:doctor-dashboard-data-table  />
            </div>
        </div>
    </div>
    @include('doctor_dashboard.templates.templates')
@endsection
