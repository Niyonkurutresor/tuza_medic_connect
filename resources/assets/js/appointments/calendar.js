document.addEventListener('turbo:load', loadAppointmentCalendar)

let popover
let popoverState = false
let appointmentStatusId = null
let calendar
let data = {
    id: '',
    uId: '',
    eventName: '',
    patientName: '',
    eventDescription: '',
    eventStatus: '',
    startDate: '',
    endDate: '',
    amount: 0,
    service: '',
    doctorName: '',
}

// View event variables
let viewEventName, viewEventDescription, viewEventStatus, viewStartDate,
    viewPatientName,
    viewEndDate,
    viewModal,
    viewEditButton,
    viewDeleteButton,
    viewService,
    viewUId,
    viewAmount

function loadAppointmentCalendar () {
    initCalendarApp()
    init()
}

const initCalendarApp = function () {
    if (!$('#adminAppointmentCalendar').length) {
        return;
    }
    if (usersRole == 'patient') {
        return;
    }
    let calendarEl = document.getElementById('adminAppointmentCalendar');
    let lang = $('.currentLanguage').val()

    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: lang,
        themeSystem: 'bootstrap5',
        height: 750,
        buttonText: {
            today: Lang.get('js.today'),
            day: Lang.get('js.day'),
            month: Lang.get('js.month'),
        },
        headerToolbar: {
            left: 'title',
            center: 'prev,next today',
            right: 'dayGridDay,dayGridMonth',
        },

        initialDate: new Date(),
        timeZone: 'UTC',
        dayMaxEvents: true,
        events: function (info, successCallback, failureCallback) {
            $.ajax({
                url: route('appointments.calendar'),
                type: 'GET',
                data: info,
                success: function (result) {
                    if (result.success) {
                        successCallback(result.data)
                    }
                },
                error: function (result) {
                    displayErrorMessage(result.responseJSON.message)
                    failureCallback()
                },
            })
        },
        // MouseEnter event --- more info: https://fullcalendar.io/docs/eventMouseEnter
        eventMouseEnter: function (arg) {
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                patient: arg.event.extendedProps.patient,
                status: arg.event.extendedProps.status,
                amount: arg.event.extendedProps.amount,
                uId: arg.event.extendedProps.uId,
                service: arg.event.extendedProps.service,
                doctorName: arg.event.extendedProps.doctorName,
            })

            // Show popover preview
            initPopovers(arg.el)
        },
        eventMouseLeave: function () {
            hidePopovers()
        },
        // Click event --- more info: https://fullcalendar.io/docs/eventClick
        eventClick: function (arg) {
            hidePopovers()
            appointmentStatusId = arg.event.id
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                patient: arg.event.extendedProps.patient,
                status: arg.event.extendedProps.status,
                amount: arg.event.extendedProps.amount,
                uId: arg.event.extendedProps.uId,
                service: arg.event.extendedProps.service,
                doctorName: arg.event.extendedProps.doctorName,
            })
            handleViewEvent()
        },
    })


    calendar.render()
}

const init = () => {
    if (!$('#eventModal').length) {
        return
    }
    const viewElement = document.getElementById('eventModal')
    viewModal = new bootstrap.Modal(viewElement)
    viewEventName = viewElement.querySelector(
        '[data-calendar="event_name"]')
    viewPatientName = viewElement.querySelector(
        '[data-calendar="event_patient_name"]')
    viewEventDescription = viewElement.querySelector(
        '[data-calendar="event_description"]')
    viewEventStatus = viewElement.querySelector(
        '[data-calendar="event_status"]')
    viewAmount = viewElement.querySelector('[data-calendar="event_amount"]')
    viewUId = viewElement.querySelector('[data-calendar="event_uId"]')
    viewService = viewElement.querySelector(
        '[data-calendar="event_service"]')
    viewStartDate = viewElement.querySelector(
        '[data-calendar="event_start_date"]')
    viewEndDate = viewElement.querySelector(
        '[data-calendar="event_end_date"]')
}

// Format FullCalendar responses
const formatArgs = (res) => {
    data.id = res.id
    data.eventName = res.title
    data.patientName = res.patient
    data.eventDescription = res.description
    data.eventStatus = res.status
    data.startDate = res.startStr
    data.endDate = res.endStr
    data.amount = res.amount
    data.uId = res.uId
    data.service = res.service
    data.doctorName = res.doctorName
}

// Initialize popovers --- more info: https://getbootstrap.com/docs/4.0/components/popovers/
const initPopovers = (element) => {
    hidePopovers()

    // Generate popover content
    const startDate = data.allDay ? moment(data.startDate).
        format('Do MMM, YYYY') : moment(data.startDate).
        format('Do MMM, YYYY - h:mm a')
    const endDate = data.allDay
        ? moment(data.endDate).format('Do MMM, YYYY')
        : moment(data.endDate).format('Do MMM, YYYY - h:mm a')
    const popoverHtml = '<div class="fw-bolder mb-2"><b>Doctor</b>: ' +
        data.doctorName +
        '<div class="fw-bolder mb-2"><b>Patient</b>: ' + data.patientName +
        '</div><div class="fs-7"><span class="fw-bold">Start:</span> ' +
        startDate +
        '</div><div class="fs-7 mb-4"><span class="fw-bold">End:</span> ' +
        endDate + '</div>'

    // Popover options
    let options = {
        container: 'body',
        trigger: 'manual',
        boundary: 'window',
        placement: 'auto',
        dismiss: true,
        html: true,
        title: 'Appointment Details',
        content: popoverHtml,
    }
}

// Hide active popovers
const hidePopovers = () => {
    if (popoverState) {
        popover.dispose()
        popoverState = false
    }
}

// Handle view event
const handleViewEvent = () => {
    $('.fc-popover').addClass('hide')
    viewModal.show()

    // Detect all day event
    let eventNameMod
    let startDateMod
    let endDateMod
    let book = $('#bookCalenderConst').val();
    let checkIn = $('#checkInCalenderConst').val();
    let checkOut = $('#checkOutCalenderConst').val();
    let cancel = $('#cancelCalenderConst').val();

    eventNameMod = ''

    startDateMod = moment(data.startDate).utc().format("DD MMM, YYYY - h:mm A")
    endDateMod = moment(data.endDate).utc().format('DD MMM, YYYY - h:mm A')
    viewEndDate.innerText = ': ' + endDateMod
    viewStartDate.innerText = ': ' + startDateMod

    // Populate view data
    viewEventName.innerText = Lang.get('js.doctor') + data.doctorName
    viewPatientName.innerText = Lang.get('js.patient') + data.patientName
    $(viewEventStatus).empty()
    $(viewEventStatus).append(`
<option class="booked" disabled value="${book}" ${data.eventStatus == book
        ? 'selected'
        : ''}>${Lang.get('js.booked')}</option>
<option value="${checkIn}" ${data.eventStatus == checkIn
        ? 'selected'
        : ''} ${data.eventStatus == checkIn ? 'selected' : ''}
    ${(data.eventStatus == cancel || data.eventStatus == checkOut)
        ? 'disabled'
        : ''}>${Lang.get('js.check_in')}</option>
<option value="${checkOut}" ${data.eventStatus == checkOut ? 'selected' : ''}
    ${(data.eventStatus == cancel || data.eventStatus == book)
        ? 'disabled'
        : ''}>${Lang.get('js.check_out')}</option>
<option value="${cancel}" ${data.eventStatus == cancel
        ? 'selected'
        : ''} ${data.eventStatus == checkIn ? 'disabled' : ''}
   ${data.eventStatus == checkOut ? 'disabled' : ''}>${Lang.get('js.cancelled')}</option>
`)
    $(viewEventStatus).val(data.eventStatus).trigger('change')
    viewAmount.innerText = addCommas(data.amount)
    viewUId.innerText = data.uId
    viewService.innerText = data.service
}

listenChange('#changeAppointmentStatus', function () {
    if (!$(this).val()) {
        return false
    }
    let appointmentStatus = $(this).val()
    let appointmentId = appointmentStatusId
    if (parseInt(appointmentStatus) === data.eventStatus) {
        return false
    }
    $.ajax({
        url: route('change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#eventModal').modal('hide')
            calendar.refetchEvents()
        },
    })
})
