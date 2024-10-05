<div class="modal fade event-modal" id="doctorAppointmentCalendarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{__('messages.appointment.appointment_details')}}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="mb-1">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user fs-3 me-4 btn-outline-secondary"></i>
                            <span class="fs-4  me-3" data-calendar="event_name"></span>
                        </div>
                        <br>
                        <span class="ms-8 text-muted" data-calendar="event_description"></span>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-7 mb-2">
                    <i class="fa-solid fa-circle me-3 text-success"></i>
                    <div class="fs-6">
                        <span class="">{{__('messages.appointment.starts')}}</span>
                        <span data-calendar="event_start_date"></span>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-7 mb-9">
                    <i class="fa-solid fa-circle me-3 text-danger"></i>
                    <div class="fs-6">
                        <span class="">{{__('messages.appointment.ends')}}</span>
                        <span data-calendar="event_end_date"></span>
                    </div>
                </div>
                @php
                    $styleCss = 'style';
                @endphp
                <div class="d-flex align-items-center">
                    <label {{ $styleCss }}="width: 125px">{{__('messages.appointment.appointment_unique_id')}}:</label>
                    <div class="fs-6 fw-bold ms-3"><span class="ms-1" data-calendar="event_uId"></span></div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <label {{ $styleCss }}="width: 125px">{{__('messages.appointment.service')}}:</label>
                    <div class="fs-6 fw-bold ms-3"><span class="ms-1" data-calendar="event_service"></span></div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <label {{ $styleCss }}="width: 125px">{{__('messages.appointment.payable_amount')}}:</label>
                    <div class="fs-6 fw-bold ms-3"><span>$</span><span class="ms-1" data-calendar="event_amount"></span></div>
                </div>
                <div class="d-flex align-items-center mt-4">
                    <label for="" {{ $styleCss }}="width: 170px">{{__('messages.appointment.status')}}:</label>
                    <select class="form-select-sm form-select-solid form-select doctor-apptnt-calendar-status-change"
                            data-control="select2" data-calendar="event_status"
                            data-minimum-results-for-search="Infinity">
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
