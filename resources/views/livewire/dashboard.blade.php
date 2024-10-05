<div>
      <div class="row">
          <div class="col-xl-12 col-md-6">
              <div class="admin-dashbord-user-card  widget mb-5">
                  <div class="admin-dashbord-user-card-header">
                      <h3>{{ __('messages.welcome_back') }}</h3>
                      <span>{{ __('messages.dashboard') }}</span>
                  </div>
                  <div class="admin-dashbord-user-card-body d-flex flex-xl-nowrap flex-wrap justify-content-between">
                      <div class="d-flex  flex-xl-column flex-row align-items-left p-4 py-3 py-sm-1">
                          <div class="image image-circle image-mini">
                              @if(getLogInUser()->hasRole('patient'))
                                  <img class="img-fluid admin-user-card-img" alt="img-fluid"
                                       src="{{ getLogInUser()->patient->profile }}"/>
                              @elseif(getLogInUser()->hasRole('doctor'))
                                  <img class="img-fluid admin-user-card-img" alt="img-fluid"
                                       src="{{ getLogInUser()->profile_image }}"/>
                              @else
                                  <img class="img-fluid admin-user-card-img" alt="img-fluid"
                                       src="{{ getLogInUser()->profile_image }}"/>
                              @endif
                          </div>
                          <div class="admin-user-data pt-xl-0 pt-3">
                              <h3 class="text-gray-900">{{ getLogInUser()->full_name }}</h3>
                              <h4 class="mb-0 fw-400 fs-6">{{ getLogInUser()->email }}</h4>
                          </div>
                      </div>
                      <div class="">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="text-start ms-4 mb-4">
                                      <h2 class="fs-6 fw-bolder">{{ $totalDoctorCount }}</h2>
                                      <h3 class="mb-0 fw-light text-dark fs-6">
                                          {{ __('messages.purchase_medicine.total') . ' ' . __('messages.common.active') . ' ' . __('messages.doctors') }}
                                      </h3>
                                  </div>
                                  <div class="text-start ms-4 mb-4">
                                      <h2 class="fs-6 fw-bolder">{{ $totalPatientCount }}</h2>
                                      <h3 class="mb-0 fw-light text-dark fs-6">{{ __('messages.admin_dashboard.total_patients') }}
                                      </h3>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="text-start ms-4 mb-5">
                                      <h2 class="fs-6 fw-bolder">{{ $todayAppointmentCount }}</h2>
                                      <h3 class="mb-0 fw-light text-dark fs-6">
                                          {{ __('messages.admin_dashboard.today_appointments') }}
                                      </h3>
                                  </div>
                                  <div class="text-start ms-4">
                                      <h2 class="fs-6 fw-bolder">{{ $totalRegisteredPatientCount }}</h2>
                                      <h3 class="mb-0 fw-light text-dark fs-6">
                                          {{ __('messages.admin_dashboard.today_registered_patients') }}</h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xl-12 col-md-6" wire:ignore>
              <div class="admin-dashbord-earning-card widget mb-5">
                  <div class="admin-dashbord-earning-card-header">
                      <h3>{{ __('messages.monthly_earning') }}</h3>
                      <span class="mt-4 fw-light">{{ __('messages.datepicker.this_month') }}</span>
                  </div>
                  <div class="admin-dashbord-earning-card-body d-flex align-items-center justify-content-between">
                 <div class="total-amount fs-1 my-2">0</div>
                    <div>
                           <span class="text-success admin-dashbord-earning-card-body-amont me-3">100.00% ^</span>
                           <div> {{ __('messages.from_previous_month') }}</div>
                          </div>
                  </div>
              </div>
          </div>
      </div>
</div>
