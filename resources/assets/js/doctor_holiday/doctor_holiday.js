// document.addEventListener('turbo:load', loadDoctorHoliday)

var startDate = moment().startOf("week");
var endDate = moment().endOf("week");
Livewire.hook("element.init", () => {
    loadDoctorHoliday();
    if ($("#doctorHolidayStatus").length) {
        $("#doctorHolidayStatus").select2();
    }
    if (startDate != undefined && endDate != undefined) {
        cb(startDate, endDate);
    }
});

function loadDoctorHoliday() {
    // let lang = $(".currentLanguage").val();
    // $("#doctorHolidayDate").flatpickr({
    //     locale: lang,
    //     minDate: new Date().fp_incr(1),
    //     disableMobile: true,
    // });

    // listenClick(".doctor-holiday-delete-btn", function (event) {
    //     let holidayRecordId = $(event.currentTarget).attr("data-id");
    //     deleteItem(
    //         route("holidays.destroy", holidayRecordId),
    //         Lang.get("js.holiday")
    //     );
    // });

    if (!$("#doctorHolidayDateFilter").length) {
        return;
    }
    // let startDate = moment().startOf("week");
    // let endDate = moment().endOf("week");

    let datePicker = $("#doctorHolidayDateFilter").daterangepicker(
        {
            startDate: startDate,
            endDate: endDate,
            opens: "left",
            showDropdowns: true,
            locale: {
                customRangeLabel: Lang.get("js.custom"),
                applyLabel: Lang.get("js.apply"),
                cancelLabel: Lang.get("js.cancel"),
                fromLabel: Lang.get("js.from"),
                toLabel: Lang.get("js.to"),
                monthNames: [
                    Lang.get("js.jan"),
                    Lang.get("js.feb"),
                    Lang.get("js.mar"),
                    Lang.get("js.apr"),
                    Lang.get("js.may"),
                    Lang.get("js.jun"),
                    Lang.get("js.jul"),
                    Lang.get("js.aug"),
                    Lang.get("js.sep"),
                    Lang.get("js.oct"),
                    Lang.get("js.nov"),
                    Lang.get("js.dec"),
                ],

                daysOfWeek: [
                    Lang.get("js.sun"),
                    Lang.get("js.mon"),
                    Lang.get("js.tue"),
                    Lang.get("js.wed"),
                    Lang.get("js.thu"),
                    Lang.get("js.fri"),
                    Lang.get("js.sat"),
                ],
            },
            ranges: {
                [Lang.get("js.today")]: [moment(), moment()],
                [Lang.get("js.yesterday")]: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                [Lang.get("js.this_week")]: [
                    moment().startOf("week"),
                    moment().endOf("week"),
                ],
                [Lang.get("js.last_30_days")]: [
                    moment().subtract(29, "days"),
                    moment(),
                ],
                [Lang.get("js.this_month")]: [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                [Lang.get("js.last_month")]: [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        }
        // cb
    );
    //cb(startDate, endDate);

    datePicker.on("apply.daterangepicker", function (ev, picker) {
        let date =
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY");
        Livewire.dispatch("changeDateFilter", { date: date });

        startDate = picker.startDate;
        endDate = picker.endDate;
        // Livewire.dispatch("changeDateFilter", { date: $(this).val() });
    });
}
function cb(start, end) {
    $("#doctorHolidayDateFilter").val(
        start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
    );
}
listenChange("#doctorHolidayStatus", function () {
    $("#doctorHolidayStatus").val($(this).val());
    Livewire.dispatch("changeStatusFilter", $(this).val());
});

// listenChange('#holidayDateFilter,#doctorHolidayDateFilter', function () {
//     Livewire.dispatch("changeDateFilter", { date: $(this).val(),});
// })

listenClick(".holiday-delete-btn", function (event) {
    let holidayRecordId = $(event.currentTarget).attr("data-id");
    deleteItem(
        route("doctors.holiday-destroy", holidayRecordId),
        Lang.get("js.holiday")
    );
});

// listenClick('#holidayDateResetFilter', function () {
//     $('#holidayDateFilter').data('daterangepicker').setStartDate(moment().startOf('week').format('DD/MM/YYYY'))
//     $('#holidayDateFilter').data('daterangepicker').setEndDate(moment().endOf('week').format('DD/MM/YYYY'))
//     hideDropdownManually($('#holidayFilterBtn'), $('.dropdown-menu'));
// })

// listenClick('#doctorHolidayResetFilter', function () {
//     $('#doctorHolidayDateFilter').data('daterangepicker').setStartDate(moment().startOf('week').format('DD/MM/YYYY'))
//     $('#doctorHolidayDateFilter').data('daterangepicker').setEndDate(moment().endOf('week').format('DD/MM/YYYY'))
//     hideDropdownManually($('#doctorHolidayFilterBtn'), $('.dropdown-menu'));
// })
