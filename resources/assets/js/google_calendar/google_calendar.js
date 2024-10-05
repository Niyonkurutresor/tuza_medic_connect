listenClick('#syncGoogleCalendar', function () {
    let btnSubmitEle = $(this)
    setAdminBtnLoader(btnSubmitEle)
    $.ajax({
        url: route('syncGoogleCalendarList'),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                setTimeout(function () {
                    location.reload()
                }, 1200)
            }
        },
        complete: function () {
            setAdminBtnLoader(btnSubmitEle)
        },
    })
})

listenSubmit('#googleCalendarForm', function (e) {
    e.preventDefault();
    if (!$('.google-calendar').is(':checked')) {
        displayErrorMessage(Lang.get('js.select_calendar'))
        return
    }
    let url = ''
    if (!isEmpty($('#googleCalendarDoctorRole').val())) {
        url = route('doctors.appointmentGoogleCalendar.store')
    } else if (!isEmpty($('#googleCalendarPatientRole').val())) {
        url = route('patients.appointmentGoogleCalendar.store')
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                setTimeout(function () {
                    location.reload()
                }, 1200)
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
    })
})
