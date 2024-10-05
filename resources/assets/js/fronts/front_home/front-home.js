document.addEventListener('turbo:load', loadFrontHomeData)

function loadFrontHomeData () {
    let frontAppointmentDate = '#frontAppointmentDate'

    if (!$(frontAppointmentDate).length) {
        return
    }

    $(frontAppointmentDate).datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(),
        todayHighlight: true,
    })
}
