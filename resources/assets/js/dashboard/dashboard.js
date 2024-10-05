// document.addEventListener('turbo:load', loadDashboardData)
// document.addEventListener('turbo:load', loadPatientDashboardData)
// document.addEventListener('turbo:load', loadDoctorDashboardData)

let amount = []
let month = []
let totalAmount = 0
let chartType = 'area'
let adminDashboardAppointmentChart = null;

Livewire.hook('element.init', ({ component, el }) => {
   loadDashboardData();
   loadPatientDashboardData();
   loadDoctorDashboardData();
})

function loadPatientDashboardData () {
    if (!$('#patientChartData').length) {
        return
    }
    let patientChartData = JSON.parse($('#patientChartData').val());
    let lang = $('.currentLanguage').val();

    let currentDate = new Date();
    let currentMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let currentValue = patientChartData[1][currentMonth];
    $('.patient-month-total-amount').text(currencyIcon +' '+ currentValue);

    currentDate.setMonth(currentDate.getMonth() - 1); // Move one month back
    let previousMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let previousMonthValue = patientChartData[1][previousMonth];
    let performancedataforprogressbabr;
    if(previousMonthValue === 0){
          performancedataforprogressbabr = 100;
     }
     else if(currentValue == 0 && previousMonthValue == 0){
        performancedataforprogressbabr = 0;
    }else{
         performancedataforprogressbabr = ((currentValue - previousMonthValue) / Math.abs(previousMonthValue)) * 100;
     }
     if(performancedataforprogressbabr > 100){
     $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+"<i class='fa fa-arrow-up' aria-hidden='true'></i>");
     $(".bord-earning-card-body-amont").css('color','green');
     }else{
     if(performancedataforprogressbabr < 0){
         $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+'%'+ " <i class='fa fa-arrow-down'></i>");
         $(".dashbord-earning-card-body-amont").removeClass('text-success').addClass('text-danger');
     }else{
         $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+" <i class='fa fa-arrow-up' aria-hidden='true'></i>");
         $(".dashbord-earning-card-body-amont").css('color','green');
     }
 }
     let remainingPercenctageForProgressbar = performancedataforprogressbabr + 100;
     if(remainingPercenctageForProgressbar > 100){
         remainingPercenctageForProgressbar = 100
     }

    $(function () {
        var setRadial = function (percent) {
        $(".patient-js-radial-mask").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".patient-js-radial-fill").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".js-radial-fill_fix").css('transform', 'rotate(' + 3.6 * percent + 'deg)');
        $(".patient-js-radial-percent").html(percent+'%');
        };
        setRadial(Math.abs(remainingPercenctageForProgressbar).toFixed(0));

    })

}

function loadDashboardData () {
    if (!$('#adminChartData').length) {
        return
    }

    let adminChartData = JSON.parse($('#adminChartData').val());
    let lang = $('.currentLanguage').val();

    let currentDate = new Date();

    let currentMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let currentValue = adminChartData[currentMonth];
    $('.total-amount').text(currencyIcon+' '+currentValue)

    currentDate.setMonth(currentDate.getMonth() - 1); // Move one month back
    let previousMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let previousMonthValue = adminChartData[previousMonth];
    let performancedataforprogressbabr;
   if(previousMonthValue == 0 && currentValue!=0){
         performancedataforprogressbabr = 100;
    }else if(currentValue == 0 && previousMonthValue == 0){
        performancedataforprogressbabr = 0;
    }else{
        performancedataforprogressbabr = ((currentValue - previousMonthValue) / Math.abs(previousMonthValue)) * 100;
    }
    if(performancedataforprogressbabr > 100){
    $(".admin-dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+"<i class='fa fa-arrow-up' aria-hidden='true'></i>");
    $(".admin-dashbord-earning-card-body-amont").css('color','green');
    }else{
    if(performancedataforprogressbabr < 0){
        $(".admin-dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+'%'+ " <i class='fa fa-arrow-down'></i>");
        $(".admin-dashbord-earning-card-body-amont").removeClass('text-success').addClass('text-danger');
    }else{
        $(".admin-dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+" <i class='fa fa-arrow-up' aria-hidden='true'></i>");
        $(".admin-dashbord-earning-card-body-amont").css('color','green');
    }
}
    let remainingPercenctageForProgressbar = performancedataforprogressbabr + 100;
    if(remainingPercenctageForProgressbar > 100){
        remainingPercenctageForProgressbar = 100
    }

    $(function () {
        var setRadial = function (percent) {
        $(".js-radial-mask").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".js-radial-fill").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".js-radial-fill_fix").css('transform', 'rotate(' + 3.6 * percent + 'deg)');
        $(".js-radial-percent").html(percent+'%');
        };
        setRadial(Math.abs(remainingPercenctageForProgressbar).toFixed(0));
    })
    month = []
    amount = []
    totalAmount = 0
    $.each(adminChartData, function (key, value) {
        month.push(key)
        amount.push(value)
        totalAmount += value
    })
    $('.totalEarning').text(totalAmount)
    prepareAppointmentReport()
}
function loadDoctorDashboardData () {
    if (!$('#doctorChartData').length) {
        return
    }
    let doctorChartData = JSON.parse($('#doctorChartData').val());
    let lang = $('.currentLanguage').val();

    let currentDate = new Date();
    let currentMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let currentValue = doctorChartData[2][currentMonth];
    // $('.thismontappointment').text(currentValue);
    $('.doctor-month-total-amount').text(currencyIcon +' '+ currentValue);

    currentDate.setMonth(currentDate.getMonth() - 1); // Move one month back
    let previousMonth = currentDate.toLocaleString(lang, { month: 'short' });
    let previousMonthValue = doctorChartData[2][previousMonth];
    let performancedataforprogressbabr;
    if(previousMonthValue == 0 && currentValue != 0 ){
          performancedataforprogressbabr = 100;
     }else if(currentValue == 0 && previousMonthValue == 0){
        performancedataforprogressbabr = 0;
    } else{
         performancedataforprogressbabr = ((currentValue - previousMonthValue) / Math.abs(previousMonthValue)) * 100;
     }
     if(performancedataforprogressbabr > 100){
     $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+"<i class='fa fa-arrow-up' aria-hidden='true'></i>");
     $(".bord-earning-card-body-amont").css('color','green');
     }else{
     if(performancedataforprogressbabr < 0){
         $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+'%'+ " <i class='fa fa-arrow-down'></i>");
         $(".dashbord-earning-card-body-amont").removeClass('text-success').addClass('text-danger');
     }else{
         $(".dashbord-earning-card-body-amont").html(performancedataforprogressbabr.toFixed(2)+"%"+" <i class='fa fa-arrow-up' aria-hidden='true'></i>");
         $(".dashbord-earning-card-body-amont").css('color','green');
     }
 }
     let remainingPercenctageForProgressbar = performancedataforprogressbabr + 100;
     if(remainingPercenctageForProgressbar > 100){
         remainingPercenctageForProgressbar = 100
     }

    $(function () {
        var setRadial = function (percent) {
        $(".doctor-js-radial-mask").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".doctor-js-radial-fill").css('transform', 'rotate(' + 1.8 * percent + 'deg)');
        $(".js-radial-fill_fix").css('transform', 'rotate(' + 3.6 * percent + 'deg)');
        $(".doctor-js-radial-percent").html(percent+'%');
        };
        setRadial(Math.abs(remainingPercenctageForProgressbar).toFixed(0));

    })
    month = []
    amount = []
    appointmentmonth = []
    appointmentvalue = []
    totalAmount = 0
    totalAppointment = 0
    $.each(doctorChartData[0], function (key, value) {
        month.push(key)
        amount.push(value)
        totalAmount += value
    })
    $.each(doctorChartData[1], function (key, value) {
        appointmentmonth.push(key)
        appointmentvalue.push(value)
        totalAppointment += value
    })
    prepareDoctorAppointmentReport()
}

function prepareAppointmentReport () {
    if (!$('#appointmentChartId').length) {
        return
    }

    $('#appointmentChartId').remove()
    $('.appointmentChart').
        append(
            '<div id="appointmentChartId" style="height: 350px" class="card-rounded-bottom"></div>')
    let id = document.getElementById('appointmentChartId'),
        borderColor = '--bs-gray-200'
    id && new ApexCharts(id, {
        series: [
            {
                name: Lang.get('js.amount'),
                type: chartType,
                stacked: !0,
                data: amount,
            }],
        chart: {
            fontFamily: 'inherit',
            stacked: !0,
            type: chartType,
            height: 350,
            toolbar: {show: !1},
            background: dashboardChartBGColor,
        },
        plotOptions: {
            bar: {
                stacked: !0,
                horizontal: !1,
                borderRadius: 4,
                columnWidth: ['12%'],
            },
        },
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        stroke: {
            curve: 'smooth',
            show: !0,
            width: 2,
            colors: ['transparent'],
        },
        xaxis: {
            categories: month,
            axisBorder: {show: !1},
            axisTicks: {show: !1},
            labels: {style: {colors: dashboardChartFontColor, fontSize: '12px'}},
        },
        yaxis: {
            labels: {style: {colors: dashboardChartFontColor, fontSize: '12px'}},
        },
        fill: { opacity: 1 },
        states: {
            normal: { filter: { type: 'none', value: 0 } },
            hover: { filter: { type: 'none', value: 0 } },
            active: {
                allowMultipleDataPointsSelection: !1,
                filter: { type: 'none', value: 0 },
            },
        },
        tooltip: {
            style: { fontSize: '12px' },
            y: {
                formatter: function (e) {
                    return currencyIcon + ' ' + e
                },
            },
        },
        grid: {
            borderColor: borderColor,
            strokeDashArray: 4,
            yaxis: {lines: {show: !0}},
            padding: {top: 0, right: 0, bottom: 0, left: 0},
        },
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false,
                color: '#13151f',
                shadeTo: 'dark',
                shadeIntensity: 0.00
            },
        },
    }).render()
}


function prepareDoctorAppointmentReport () {
    if (!$('#appointmentDoctorChartId').length) {
        return
    }

    $('#appointmentDoctorChartId').remove()
    $('.appointmentDoctorChart').
        append(
            '<div id="appointmentDoctorChartId" style="height: 350px" class="card-rounded-bottom"></div>')
    let id = document.getElementById('appointmentDoctorChartId'),
        borderColor = '--bs-gray-200'
    id && new ApexCharts(id, {
        series: [
            {
                name: 'appointment',
                type: chartType,
                stacked: !0,
                data: appointmentvalue,
            }],
        chart: {
            fontFamily: 'inherit',
            stacked: !0,
            type: chartType,
            height: 350,
            toolbar: {show: !1},
            background: dashboardChartBGColor,
        },
        plotOptions: {
            bar: {
                stacked: !0,
                horizontal: !1,
                borderRadius: 4,
                columnWidth: ['12%'],
            },
        },
        legend: { show: !1 },
        dataLabels: { enabled: !1 },
        stroke: {
            curve: 'smooth',
            show: !0,
            width: 2,
            colors: ['transparent'],
        },
        xaxis: {
            categories: appointmentmonth,
            axisBorder: {show: !1},
            axisTicks: {show: !1},
            labels: {style: {colors: dashboardChartFontColor, fontSize: '12px'}},
        },
        yaxis: {
            labels: {style: {colors: dashboardChartFontColor, fontSize: '12px'}},
        },
        fill: { opacity: 1 },
        states: {
            normal: { filter: { type: 'none', value: 0 } },
            hover: { filter: { type: 'none', value: 0 } },
            active: {
                allowMultipleDataPointsSelection: !1,
                filter: { type: 'none', value: 0 },
            },
        },
        tooltip: {
            style: { fontSize: '12px' },
            y: {
                formatter: function (e) {
                    return ' ' + e
                },
            },
        },
        grid: {
            borderColor: borderColor,
            strokeDashArray: 4,
            yaxis: {lines: {show: !0}},
            padding: {top: 0, right: 0, bottom: 0, left: 0},
        },
        theme: {
            mode: 'dark',
            palette: 'palette1',
            monochrome: {
                enabled: false,
                color: '#13151f',
                shadeTo: 'dark',
                shadeIntensity: 0.00
            },
        },
    }).render()

    // totalAmount = 0;

}

listenClick('#changeChart', function () {
    if (chartType == 'area') {
        chartType = 'bar'
        $('.chart').addClass('fa-chart-area')
        $('.chart').removeClass('fa-chart-bar')
        prepareAppointmentReport()
    } else {
        chartType = 'area'
        $('.chart').removeClass('fa-chart-area')
        $('.chart').addClass('fa-chart-bar')
        prepareAppointmentReport()
    }
})

listenClick('#monthData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('patientData.dashboard'),
        type: 'GET',
        data: { month: 'month' },
        success: function (result) {
            if (result.success) {
                $('#monthlyReport').empty()
                $(document).find('#week').removeClass('show active')
                $(document).find('#day').removeClass('show active')
                $(document).find('#month').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }]
                        $(document).
                            find('#monthlyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data))
                    })
                } else {
                    $(document).find('#monthlyReport').append(`<tr class="text-center">
                                                    <td colspan="5" class="text-muted fw-bold">${noData}</td>
                                                </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenChange('#serviceId', function (e) {
    e.preventDefault()
    let serviceId = $('#serviceId').val()
    let dashboardDoctorId = $('#dashboardDoctorId').val()
    let serviceCategoryId = $('#serviceCategoryId').val()
    $('.totalEarning').text('')
    if($(this).val()!=''){
        $.ajax({
            url: route('admin.dashboard'),
            type: 'GET',
            data: {
                serviceId: serviceId,
                dashboardDoctorId: dashboardDoctorId,
                serviceCategoryId: serviceCategoryId,
            },
            success: function (result) {
                if (result.success) {
                    month = []
                    amount = []
                    totalAmount = 0
                    $.each(result.data, function (key, value) {
                        month.push(key)
                        amount.push(value)
                        totalAmount += value
                    })
                    $('.totalEarning').text(totalAmount)
                    prepareAppointmentReport()
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message)
            },
        })

    }
})

listenClick('#dashboardResetBtn', function () {
    $('.dashboardFilter').val('').trigger('change');
    hideDropdownManually($('#dashboardFilterBtn'), $('.dropdown-menu'));
});

listenChange('#dashboardDoctorId', function (e) {
    e.preventDefault()
    let serviceId = $('#serviceId').val()
    let dashboardDoctorId = $('#dashboardDoctorId').val()
    let serviceCategoryId = $('#serviceCategoryId').val()
    $('.totalEarning').text('')
    $.ajax({
        url: route('admin.dashboard'),
        type: 'GET',
        data: {
            serviceId: serviceId,
            dashboardDoctorId: dashboardDoctorId,
            serviceCategoryId: serviceCategoryId,
        },
        success: function (result) {
            if (result.success) {
                month = []
                amount = []
                totalAmount = 0
                $.each(result.data, function (key, value) {
                    month.push(key)
                    amount.push(value)
                    totalAmount += value
                })
                $('.totalEarning').text(totalAmount)
                prepareAppointmentReport()
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenChange('#serviceCategoryId', function (e) {
    e.preventDefault()
    let serviceId = $('#serviceId').val()
    let dashboardDoctorId = $('#dashboardDoctorId').val()
    let serviceCategoryId = $('#serviceCategoryId').val()
    $('.totalEarning').text('')
    $.ajax({
        url: route('admin.dashboard'),
        type: 'GET',
        data: {
            serviceId: serviceId,
            dashboardDoctorId: dashboardDoctorId,
            serviceCategoryId: serviceCategoryId,
        },
        success: function (result) {
            if (result.success) {
                month = []
                amount = []
                totalAmount = 0
                $.each(result.data, function (key, value) {
                    month.push(key)
                    amount.push(value)
                    totalAmount += value
                })
                $('.totalEarning').text(totalAmount)
                prepareAppointmentReport()
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})




listenClick('#weekData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('patientData.dashboard'),
        type: 'GET',
        data: { week: 'week' },
        success: function (result) {
            if (result.success) {
                $('#weeklyReport').empty()
                $(document).find('#month').removeClass('show active')
                $(document).find('#day').removeClass('show active')
                $(document).find('#week').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }]
                        $(document).
                            find('#weeklyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data))
                    })
                } else {
                    $(document).find('#weeklyReport').append(`<tr class="text-center">
                                                    <td colspan="5" class="text-muted fw-bold">${noData}</td>
                                                </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#dayData', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('patientData.dashboard'),
        type: 'GET',
        data: { day: 'day' },
        success: function (result) {
            if (result.success) {
                $('#dailyReport').empty()
                $(document).find('#month').removeClass('show active')
                $(document).find('#week').removeClass('show active')
                $(document).find('#day').addClass('show active')
                if (result.data.patients.data != '') {
                    $.each(result.data.patients.data, function (index, value) {
                        let data = [
                            {
                                'image': value.profile,
                                'name': value.user.full_name,
                                'email': value.user.email,
                                'patientId': value.patient_unique_id,
                                'registered': moment.parseZone(
                                    value.user.created_at).
                                    format('Do MMM Y hh:mm A'),
                                'appointment_count': value.appointments_count,
                                'route': route('patients.show', value.id),
                            }]
                        $(document).find('#dailyReport').
                            append(
                                prepareTemplateRender('#adminDashboardTemplate',
                                    data))

                    })
                } else {
                    $(document).find('#dailyReport').append(`
                    <tr class="text-center">
                        <td colspan="5" class="text-muted fw-bold"> ${noData}</td>
                    </tr>`)
                }
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.dayData',function(){
    $(this).addClass('text-primary');
    $('.weekData ,.monthData').removeClass('text-primary');
})
listenClick('.weekData',function(){
    $(this).addClass('text-primary');
    $('.dayData ,.monthData').removeClass('text-primary');
})
listenClick('.monthData',function(){
    $(this).addClass('text-primary');
    $('.weekData ,.dayData').removeClass('text-primary');
})
