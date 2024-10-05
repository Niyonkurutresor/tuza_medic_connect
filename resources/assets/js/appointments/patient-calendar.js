document.addEventListener('turbo:load', loadPatientAppointmentCalendar)

let popover
let popoverState = false
let calendar
let data = {
    id: '',
    uId: '',
    eventName: '',
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
    viewEndDate,
    viewModal,
    viewEditButton,
    viewDeleteButton,
    viewService,
    viewUId,
    viewAmount

function loadPatientAppointmentCalendar () {
    if (!$('#appointmentCalendar').length) {
        return
    }
    initCalendarApp()
    init()
}

const initCalendarApp = function () {

    if (usersRole != 'patient') {
        return;
    }
    let lang = $('.currentLanguage').val()
    let calendarEl = document.getElementById('appointmentCalendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: lang,
        themeSystem: 'bootstrap5',
        height: 750,
        buttonText: {
            today: Lang.get('js.datepicker.today'),
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
                url: route('patients.appointments.calendar'),
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
                description: arg.event.extendedProps.description,
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
            formatArgs({
                id: arg.event.id,
                title: arg.event.title,
                startStr: arg.event.startStr,
                endStr: arg.event.endStr,
                description: arg.event.extendedProps.description,
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
    if (!$('#patientEventModal').length) {

        return
    }

    const viewElement = document.getElementById('patientEventModal')
    viewModal = new bootstrap.Modal(viewElement)
    viewEventName = viewElement.querySelector(
        '[data-calendar="event_name"]')
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

    eventNameMod = ''
    startDateMod = moment(data.startDate).utc().format('Do MMM, YYYY - h:mm A')
    endDateMod = moment(data.endDate).utc().format('Do MMM, YYYY - h:mm A')
    viewEndDate.innerText = ': ' + endDateMod
    viewStartDate.innerText = ': ' + startDateMod

    // Populate view data
    viewEventName.innerText = 'Doctor: ' + data.doctorName
    $(viewEventStatus).val(data.eventStatus)
    viewAmount.innerText = addCommas(data.amount)
    viewUId.innerText = data.uId
    viewService.innerText = data.service
}
