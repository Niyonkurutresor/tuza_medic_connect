<div id="show_card_modal" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg d-flex justify-content-center">
        <!-- Modal content-->
        <div class="modal-content patient-modal-content w-75">
            <div class="modal-body p-0">
                <div class="alert alert-danger d-none hide" id="medicineCategoryErrorsBox"></div>
                <div class="card patient-smart-card-card" id="card">
                    <div class="card-header patient-card-header smart-card-header d-flex align-items-center">
                        <div class="flex-1 d-flex align-items-center me-3">
                            <div class="logo me-4">
                                <img src="{{ url($logo[0]) }}" alt="logo" class="h-100 img-fluid" />
                            </div>
                            <h4 class="mb-0 fw-bold clinic_name">Royal Hospital</h4>
                        </div>
                        <div class="flex-1 text-end">
                            <address class="fs-12 mb-0 clinic_address">
                                <p class="mb-0">
                                    Nr Loyala Ashram,A 69,Shahpura Rd, Manisha Market,Sector Bhopal
                                </p>
                            </address>
                        </div>
                    </div>
                    <div class="card-body patient-smart-card-body header_color">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <div class="d-flex mb-3">
                                    <div class="card-img me-3">
                                        <img src="{{ !empty($smart_patient_cards->profile_image) ? $smart_patient_cards->profile_image : asset('web/media/avatars/male.png') }}"
                                            alt="profile-img" class="object-fit-cover" id="card_profilePicture"
                                            width="110px" />
                                    </div>

                                    <div class="patient-smart-card-user-detail">
                                        <table class="table table-borderless patient-desc mb-0">
                                            <tr>
                                                <td class="">{{ __('messages.web.name') . ':' }}</td>
                                                <td class="card_name">James Bond</td>
                                            </tr>
                                            <tr id="card_show_email">
                                                <td class="pe-3">{{ __('messages.web.email') . ':' }}</td>
                                                <td class="patient_email">Marie     </td>
                                            </tr>
                                            <tr id="patient_card_show_phone">
                                                <td class="pe-3">{{ __('messages.web.contact') . ':' }}</td>
                                                <td class="patient_contact"></td>
                                            </tr>
                                            <tr id="patient_card_show_dob">
                                                <td class="pe-3">{{ __('messages.patient.dob') . ':' }}</td>
                                                <td class="patient_dob"></td>
                                            </tr>
                                            <tr id="patient_card_show_blood_group">
                                                <td class="blood_group">{{ __('messages.patient.blood_group') . ':' }}</td>
                                                <td class="patient_blood_group"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div id="patient_card_show_address">
                                    <div class="d-flex address-text me-5">
                                        <div class="mb-0 me-3">{{ __('messages.setting.address') . ':' }}</div>
                                        <div>
                                            <address class="mb-0 card_address">
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-25 float-end">
                                <div class="text-end mb-5 ms-3">
                                    <div class="svgContainer bg-white p-1 ms-5" style="width: 98px" id="svgContainer"></div>
                                </div>
                                <div class="text-end pe-2">
                                    <span class="patient_unique_id_span" id="card_show_patient_unique_id">
                                        {{__('messages.id').':'}}
                                    </span>
                                    <h6 class="text-end mb-3 patient_unique_id d-inline">
                                    </h6>
                                </div>
                                @if (isRole('patient'))
                                <div class="ms-auto">
                                    <a href="{{ route('patients.patients.smartCardPdf', getLogInUser()->patient->id) }}" target="_blank"
                                        class="btn px-1 fs-1 patient-model-download float-end" data-bs-toggle="tooltip"
                                        data-bs-original-title="{{ __('messages.common.download') }}">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
