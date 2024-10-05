listenClick('#doctorMonthData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { month: 'month' },
        success: function (result) {
            if (result.success) {
                $('#doctorMonthlyReport').empty()
                $(document).find('#week').removeClass('show active')
                $(document).find('#day').removeClass('show active')
                $(document).find('#month').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }]
                        $(document).
                            find('#doctorMonthlyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data))
                    })
                } else {
                    $(document).find('#doctorMonthlyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">${noData}</td>
                                                </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#doctorWeekData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { week: 'week' },
        success: function (result) {
            if (result.success) {
                $('#doctorWeeklyReport').empty()
                $(document).find('#month').removeClass('show active')
                $(document).find('#day').removeClass('show active')
                $(document).find('#week').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }]
                        $(document).
                            find('#doctorWeeklyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data))
                    })
                } else {
                    $(document).find('#doctorWeeklyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">${noData}</td>
                                                </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#doctorDayData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('doctors.appointment.dashboard'),
        type: 'GET',
        data: { day: 'day' },
        success: function (result) {
            if (result.success) {
                $('#doctorDailyReport').empty()
                $(document).find('#month').removeClass('show active')
                $(document).find('#week').removeClass('show active')
                $(document).find('#day').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.patient.profile,
                                'name': value.patient.user.full_name,
                                'email': value.patient.user.email,
                                'patientId': value.patient.patient_unique_id,
                                'date': moment(value.date).format('Do MMM, Y'),
                                'from_time': value.from_time,
                                'from_time_type': value.from_time_type,
                                'to_time': value.to_time,
                                'to_time_type': value.to_time_type,
                                'route': route('doctors.patient.detail',
                                    value.patient_id),
                            }]
                        $(document).
                            find('#doctorDailyReport').
                            append(prepareTemplateRender(
                                '#doctorDashboardTemplate',
                                data))
                    })
                } else {
                    $(document).find('#doctorDailyReport').append(`
                                                <tr>
                                                    <td colspan="4" class="text-center fw-bold text-muted">${noData}</td>
                                                </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#doctorDayData',function(){
    $(this).addClass('text-primary');
    $('#doctorWeekData ,#doctorMonthData').removeClass('text-primary');
})
listenClick('#doctorWeekData',function(){
    $(this).addClass('text-primary');
    $('#doctorDayData ,#doctorMonthData').removeClass('text-primary');
})
listenClick('#doctorMonthData',function(){
    $(this).addClass('text-primary');
    $('#doctorWeekData ,#doctorDayData').removeClass('text-primary');
})

