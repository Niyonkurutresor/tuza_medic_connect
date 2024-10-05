// document.addEventListener('turbo:load', loadPatientShowAppointmentDate)

let patientShowApptmentFilterDate = $("#patientShowPageAppointmentDate");

var patientShowApptmentStart = moment().startOf("week");
var patientShowApptmentEnd = moment().endOf("week");

Livewire.hook("element.init", () => {
    loadPatientShowAppointmentDate();
    if ($("#patientShowPageAppointmentStatus").length) {
        $("#patientShowPageAppointmentStatus").select2();
    }
    if ($(".patient-show-apptment-status-change").length) {
        $(".patient-show-apptment-status-change").select2();
    }

    if (
        patientShowApptmentStart != undefined &&
        patientShowApptmentEnd != undefined
    ) {
        cb(patientShowApptmentStart, patientShowApptmentEnd);
    }
});

function loadPatientShowAppointmentDate() {
    if (!$("#patientShowPageAppointmentDate").length) {
        return;
    }

    // let patientShowApptmentStart = moment().startOf("week");
    // let patientShowApptmentEnd = moment().endOf("week");

    $("#patientShowPageAppointmentDate").daterangepicker(
        {
            startDate: patientShowApptmentStart,
            endDate: patientShowApptmentEnd,
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
        //cb
    );

    // cb(patientShowApptmentStart, patientShowApptmentEnd);
}
function cb(start, end) {
    $("#patientShowPageAppointmentDate").val(
        start.format("YYYY-MM-DD") + " - " + end.format("YYYY-MM-DD")
    );
}
listenClick(".patient-show-apptment-delete-btn", function (event) {
    let patientShowApptmentRecordId = $(event.currentTarget).attr("data-id");
    let patientShowApptmentUrl = !isEmpty($("#patientRolePatientDetail").val())
        ? route("patients.appointments.destroy", patientShowApptmentRecordId)
        : route("appointments.destroy", patientShowApptmentRecordId);
    deleteItem(patientShowApptmentUrl, "Appointment");
});

listenChange(".patient-show-apptment-status-change", function () {
    let patientShowAppointmentStatus = $(this).val();
    let patientShowAppointmentId = $(this).attr("data-id");
    let currentData = $(this);

    $.ajax({
        url: route("change-status", patientShowAppointmentId),
        type: "POST",
        data: {
            appointmentId: patientShowAppointmentId,
            appointmentStatus: patientShowAppointmentStatus,
        },
        success: function (result) {
            $(currentData).children("option.booked").addClass("hide");
            Livewire.dispatch("refresh");
            displaySuccessMessage(result.message);
        },
    });
});

listenClick("#patientAppointmentResetFilter", function () {
    $("#patientShowPageAppointmentStatus").val(1).trigger("change");
    $("#patientShowPageAppointmentDate")
        .val(
            moment().startOf("week").format("MM/DD/YYYY") +
                " - " +
                moment().endOf("week").format("MM/DD/YYYY")
        )
        .trigger("change");
});

listenChange("#patientShowPageAppointmentDate", function () {
    Livewire.dispatch("changeDateFilter", { date: $(this).val() });
});

listenChange("#patientShowPageAppointmentStatus", function () {
    // Livewire.dispatch('changeDateFilter',
    //     $('#patientShowPageAppointmentDate').val())
    Livewire.dispatch("changeStatusFilter", { status: $(this).val() });
});

// document.addEventListener('livewire:load', function () {
//     window.livewire.hook('message.processed', () => {
//         if ($('#patientShowPageAppointmentStatus').length) {
//             $('#patientShowPageAppointmentStatus').select2()
//         }
//         if ($('.patient-show-apptment-status-change').length) {
//             $('.patient-show-apptment-status-change').select2()
//         }
//     })
// })
