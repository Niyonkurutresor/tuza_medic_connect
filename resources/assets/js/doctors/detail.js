document.addEventListener('turbo:load', loadDoctorShowApptmentFilterDate)

let doctorShowApptmentFilterDate = $('#doctorShowAppointmentDateFilter')

function loadDoctorShowApptmentFilterDate () {
    if (!$('#doctorShowAppointmentDateFilter').length) {
        return
    }

    let doctorShowApptmentStart = moment().startOf('week')
    let doctorShowApptmentEnd = moment().endOf('week')

    function cb (start, end) {
        $('#doctorShowAppointmentDateFilter').html(
            start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'))
    }

    $('#doctorShowAppointmentDateFilter').daterangepicker({
        startDate: doctorShowApptmentStart,
        endDate: doctorShowApptmentEnd,
        opens: 'left',
        showDropdowns: true,
        locale: {
            customRangeLabel: Lang.get('js.custom'),
            applyLabel:Lang.get('js.apply'),
            cancelLabel: Lang.get('js.cancel'),
            fromLabel:Lang.get('js.from'),
            toLabel: Lang.get('js.to'),
            monthNames: [
                Lang.get('js.jan'),
                Lang.get('js.feb'),
                Lang.get('js.mar'),
                Lang.get('js.apr'),
                Lang.get('js.may'),
                Lang.get('js.jun'),
                Lang.get('js.jul'),
                Lang.get('js.aug'),
                Lang.get('js.sep'),
                Lang.get('js.oct'),
                Lang.get('js.nov'),
                Lang.get('js.dec')
            ],

            daysOfWeek: [
                Lang.get('js.sun'),
                Lang.get('js.mon'),
                Lang.get('js.tue'),
                Lang.get('js.wed'),
                Lang.get('js.thu'),
                Lang.get('js.fri'),
                Lang.get('js.sat')],
        },
        ranges: {
            [Lang.get('js.today')]: [moment(), moment()],
            [Lang.get('js.yesterday')]: [
                moment().subtract(1, 'days'),
                moment().subtract(1, 'days')],
            [Lang.get('js.this_week')]: [moment().startOf('week'), moment().endOf('week')],
            [Lang.get('js.last_30_days')]: [moment().subtract(29, 'days'), moment()],
            [Lang.get('js.this_month')]: [moment().startOf('month'), moment().endOf('month')],
            [Lang.get('js.last_month')]: [
                moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')],
        },
    }, cb)

    cb(doctorShowApptmentStart, doctorShowApptmentEnd)
}

listenClick('.doctor-show-apptment-delete-btn', function (event) {
    let doctorShowApptmentRecordId = $(event.currentTarget).attr('data-id')
    let doctorShowApptmentUrl = !isEmpty($('#patientRoleDoctorDetail').val()) ? route(
        'patients.appointments.destroy',
        doctorShowApptmentRecordId) : route('appointments.destroy',
        doctorShowApptmentRecordId)
    deleteItem(doctorShowApptmentUrl, 'Appointment')
})

listenChange('.doctor-show-apptment-status', function () {
    let doctorShowAppointmentStatus = $(this).val()
    let doctorShowAppointmentId = $(this).attr('data-id')
    let currentData = $(this)

    $.ajax({
        url: route('change-status', doctorShowAppointmentId),
        type: 'POST',
        data: {
            appointmentId: doctorShowAppointmentId,
            appointmentStatus: doctorShowAppointmentStatus,
        },
        success: function (result) {
            $(currentData).children('option.booked').addClass('hide')
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    });
});

listenChange('#doctorShowAppointmentDateFilter', function () {
    Livewire.dispatch('changeDateFilter', $(this).val())
})

listenChange('#doctorShowAppointmentStatus', function () {
    Livewire.dispatch('changeDateFilter', $('#doctorShowAppointmentDateFilter').val())
    Livewire.dispatch('changeStatusFilter', $(this).val())
})

listenClick('#doctorShowApptmentResetFilter', function () {
    $('#doctorShowAppointmentStatus').val(1).trigger('change')
    $('#doctorShowAppointmentDateFilter').
        val(moment().startOf('week').format('MM/DD/YYYY') + ' - ' +
            moment().endOf('week').format('MM/DD/YYYY')).
        trigger('change')
        Livewire.dispatch('refresh')
})

document.addEventListener('livewire:load', function () {
    window.livewire.hook('message.processed', () => {
        if ($('#doctorShowAppointmentStatus').length) {
            $('#doctorShowAppointmentStatus').select2()
        }
        if ($('.doctor-show-apptment-status').length) {
            $('.doctor-show-apptment-status').select2()
        }
    })
})
