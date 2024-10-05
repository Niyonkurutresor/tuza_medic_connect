document.addEventListener('turbo:load', loadDoctorPanelApptmentFilteDate)

let doctorPanelApptmentFilterDate = $('#doctorAppointmentDateFilter')

function loadDoctorPanelApptmentFilteDate () {
    if (!doctorPanelApptmentFilterDate.length) {
        return
    }

    let doctorPanelApptmentStart = moment().startOf('week')
    let doctorPanelApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        doctorPanelApptmentFilterDate.html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    doctorPanelApptmentFilterDate.daterangepicker({

        startDate: doctorPanelApptmentStart,
        endDate: doctorPanelApptmentEnd,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb)
    cb(doctorPanelApptmentStart, doctorPanelApptmentEnd)
}

listenClick('.doctor-panel-delete-btn', function (event) {
    let doctorPanelApptmentRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(
        route('patients.appointments.destroy', doctorPanelApptmentRecordId),
        'Appointment')
})

listenChange('.doctor-panel-status-change', function () {
    let appointmentStatus = $(this).val()
    let appointmentId = $(this).attr('data-id')
    let currentData = $(this)

    $.ajax({
        url: route('doctors.change-status', appointmentId),
        type: 'POST',
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('#doctorPanelResetFilter', function () {
    $('#appointmentStatus').val(book).trigger('change')
    $('#doctorAppointmentDateFilter').
        val(moment().format('MM/DD/YYYY') + ' - ' +
            moment().format('MM/DD/YYYY')).
        trigger('change')
})
