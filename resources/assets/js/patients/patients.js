// document.addEventListener('turbo:load', loadAppointmentFilterDate)

let patientFilterDate = "#patientDateFilter";
var patientStart = moment().subtract(100, "years");
var patientEnd = moment();

Livewire.hook("element.init", () => {
    loadAppointmentFilterDate();
    if (patientStart != undefined && patientEnd != undefined) {
        cb(patientStart, patientEnd);
    }
});

function loadAppointmentFilterDate() {
    if (!$(patientFilterDate).length) {
        return;
    }

    let timeRange = $("#patientDateFilter");
    // let patientStart = moment().subtract(100, "years");
    // let patientEnd = moment();

    timeRange.daterangepicker(
        {
            startDate: patientStart,
            endDate: patientEnd,
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
                [Lang.get("js.all")]: [
                    moment().subtract(100, "years"),
                    moment(),
                ],
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
        //  cb
    );

    // cb(patientStart, patientEnd)

    timeRange.on("apply.daterangepicker", function (ev, picker) {
        let date =
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY");
        Livewire.dispatch("changeDateFilter", { date: date });

        patientStart = picker.startDate;
        patientEnd = picker.endDate;
    });
}

function cb(start, end) {
    $("#patientDateFilter").val(
        start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
    );
}

listenClick(".patient-delete-btn", function () {
    let patientId = $(this).attr("data-id");
    deleteItem(route("patients.destroy", patientId), Lang.get("js.patient"));
});

listenChange(".patient-email-verified", function (e) {
    let patientRecordId = $(e.currentTarget).attr("data-id");
    let value = $(this).is(":checked") ? 1 : 0;
    $.ajax({
        type: "POST",
        url: route("emailVerified"),
        data: {
            id: patientRecordId,
            value: value,
        },
        success: function (result) {
            Livewire.dispatch("refresh");
            displaySuccessMessage(result.message);
        },
    });
});

listenClick(".patient-email-verification", function (event) {
    let userId = $(event.currentTarget).attr("data-id");
    $.ajax({
        type: "POST",
        url: route("resend.email.verification", userId),
        success: function (result) {
            displaySuccessMessage(result.message);
            setTimeout(function () {
                Turbo.visit(window.location.href);
            }, 5000);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
