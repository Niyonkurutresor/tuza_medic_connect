@extends('layouts.app')
@section('title')
{{ __('messages.dashboard') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column">
        <div class="row">
            <div class="col-xl-4">
                <livewire:dashboard />
            </div>
            <div class="col-xxl-8 col-xl-8">
                <!--begin::Charts Widget 8-->
                <div class="row">
                    <livewire:AdminDashboardSidebarTable />
                </div>

                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header card-header-dashbord border-0 p-3 ps-5">

                        <h3 class="card-title align-items-start flex-column mb-3">
                            <span
                                class="card-label fw-bolder fs-3 mb-1">{{ __('messages.admin_dashboard.earnings_from_appointments') }}
                                ({{ getCurrencyIcon() }} <span
                                    class="card-label fw-bolder fs-3 mb-1 me-0 totalEarning"></span>)
                            </span>
                        </h3>

                        <!--begin::Toolbar-->
                        <div class="ms-0 ms-md-2 mb-3">
                            <div class="dropdown d-flex align-items-center me-4 me-md-5">
                                <button
                                    class="btn btn btn-icon btn-primary text-white dropdown-toggle hide-arrow ps-2 pe-0"
                                    type="button" id="dashboardFilterBtn" data-bs-auto-close="outside"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='fas fa-filter'></i>
                                </button>
                                <div class="dropdown-menu py-0" aria-labelledby="dashboardFilterBtn">
                                    <div class="text-start border-bottom py-4 px-7">
                                        <h3 class="text-gray-900 mb-0">
                                            {{ __('messages.admin_dashboard.filter_options') }}</h3>
                                    </div>
                                    <div class="p-5">
                                        <div class="mb-5">
                                            <label for="exampleInputSelect2"
                                                class="form-label">{{ __('messages.services') }}</label>
                                            {{ Form::select('service', $data['servicesArr'], null, ['class' => 'form-select io-select2 dashboardFilter', 'placeholder' => __('messages.common.select_service'), 'id' => 'serviceId', 'data-control' => 'select2']) }}
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleInputSelect2"
                                                class="form-label">{{ __('messages.service_categories') }}</label>

                                            {{ Form::select('service', $data['serviceCategoriesArr'], null, ['class' => 'form-select io-select2 dashboardFilter', 'placeholder' => __('messages.common.select_category'), 'id' => 'serviceCategoryId', 'data-control' => 'select2']) }}
                                        </div>
                                        <div class="mb-5">
                                            <label for="exampleInputSelect2"
                                                class="form-label">{{ __('messages.doctors') }}</label>
                                            {{ Form::select('doctor_id', $data['doctorArr'], null, ['class' => 'form-select io-select2 dashboardFilter', 'placeholder' => __('messages.common.select_doctor'), 'id' => 'dashboardDoctorId', 'data-control' => 'select2']) }}
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            {{--                                                <button type="submit" class="btn btn-primary me-5">{{__('messages.common.apply')}}</button>
                                            --}}
                                            <button type="reset" class="btn btn-secondary"
                                                id="dashboardResetBtn">{{ __('messages.common.reset') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body appointmentChart">
                        {{ Form::hidden('admin_chart_data', json_encode($appointmentChartData, true), ['id' => 'adminChartData']) }}
                        <!--begin::Chart-->
                        <div id="appointmentChartId" style="height: 350px" class="card-rounded-bottom"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Charts Widget 8-->
            </div>


            <div class="col-xxl-12">    
                 <livewire:admin-dashBoard-table />
            </div>
        </div>
    </div>
</div>
@include('dashboard.templates.templates')
@endsection