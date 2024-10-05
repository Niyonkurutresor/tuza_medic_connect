// document.addEventListener('turbo:load', loadAppointmentFilterDate)

let appointmentFilterDate = $("#appointmentDateFilter");

var appointmentStart = moment().startOf("week");
var appointmentEnd = moment().endOf("week");

Livewire.hook("element.init", () => {
    loadAppointmentFilterDate();
    if ($("#paymentStatus").length) {
        $("#paymentStatus").select2();
    }
    if ($("#doctorApptPaymentStatus").length) {
        $("#doctorApptPaymentStatus").select2();
    }
    if ($("#appointmentStatus").length) {
        $("#appointmentStatus").select2();
    }
    if (appointmentStart != undefined && appointmentEnd != undefined) {
        cb(appointmentStart, appointmentEnd);
    }
});

function loadAppointmentFilterDate() {
    if (!$("#appointmentDateFilter").length) {
        return;
    }

    // let appointmentStart = moment().startOf("week");
    // let appointmentEnd = moment().endOf("week");

    $("#appointmentDateFilter").daterangepicker(
        {
            startDate: appointmentStart,
            endDate: appointmentEnd,
            opens: "left",
            showDropdowns: true,
            locale: {
                format: "DD/MM/YYYY",
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

    // cb(appointmentStart, appointmentEnd);

    $("#appointmentDateFilter").on(
        "apply.daterangepicker",
        function (ev, picker) {
            let date =
                picker.startDate.format("DD/MM/YYYY") +
                " - " +
                picker.endDate.format("DD/MM/YYYY");
            Livewire.dispatch("changeDateFilter", { date: date });
            Livewire.dispatch("changeStatusFilter", {
                status: $("#appointmentStatus").val(),
            });
            Livewire.dispatch("changePaymentTypeFilter", {
                type: $("#paymentStatus").val(),
            });
            appointmentStart = picker.startDate;
            appointmentEnd = picker.endDate;
        }
    );
}

function cb(start, end) {
    $("#appointmentDateFilter").val(
        start.format("DD/MM/YYYY") + " - " + end.format("DD/MM/YYYY")
    );
}

listenClick("#appointmentResetFilter", function () {
    $("#paymentStatus").val(0).trigger("change");
    $("#appointmentStatus").val(1).trigger("change");
    let date =
        moment().startOf("week").format("DD/MM/YYYY") +
        " - " +
        moment().endOf("week").format("DD/MM/YYYY");
    $("#appointmentDateFilter").val(date);
    Livewire.dispatch("changeDateFilter", { date: date });
    hideDropdownManually($("#apptmentFilterBtn"), $(".dropdown-menu"));
});

listenClick("#doctorApptResetFilter", function () {
    $("#doctorApptPaymentStatus").val(1).trigger("change");
    let date =
        moment().startOf("week").format("DD/MM/YYYY") +
        " - " +
        moment().endOf("week").format("DD/MM/YYYY");
    $("#appointmentDateFilter").val(date);
    Livewire.dispatch("changeDateFilter", { date: date });
    hideDropdownManually($("#doctorAptFilterBtn"), $(".dropdown-menu"));
});

listenClick(".appointment-delete-btn", function (event) {
    let recordId = $(event.currentTarget).attr("data-id");
    deleteItem(
        route("appointments.destroy", recordId),
        Lang.get("js.appointment")
    );
});

listenChange(".appointment-status-change", function () {
    let appointmentStatus = $(this).val();
    let appointmentId = $(this).attr("data-id");
    let currentData = $(this);

    $.ajax({
        url: route("change-status", appointmentId),
        type: "POST",
        data: {
            appointmentId: appointmentId,
            appointmentStatus: appointmentStatus,
        },
        success: function (result) {
            $(currentData).children("option.booked").addClass("hide");
            Turbo.visit(window.location.href);
            displaySuccessMessage(result.message);
        },
    });
});

listenChange(".appointment-change-payment-status", function () {
    let paymentStatus = $(this).val();
    let appointmentId = $(this).attr("data-id");

    $("#paymentStatusModal").modal("show").appendTo("body");

    $("#paymentStatus").val(paymentStatus);
    $("#appointmentId").val(appointmentId);
});

listenChange("#paymentStatus", function () {
    Livewire.dispatch("changeDateFilter", {
        date: $("#appointmentDateFilter").val(),
    });
    Livewire.dispatch("changeStatusFilter", {
        status: $("#appointmentStatus").val(),
    });
    Livewire.dispatch("changePaymentTypeFilter", { type: $(this).val() });
});

listenChange("#doctorApptPaymentStatus", function () {
    Livewire.dispatch("changeDateFilter", {
        date: $("#appointmentDateFilter").val(),
    });
    Livewire.dispatch("changeDoctorStatusFilter", { status: $(this).val() });
});

listenChange("#appointmentStatus", function () {
    Livewire.dispatch("changeDateFilter", {
        date: $("#appointmentDateFilter").val(),
    });
    Livewire.dispatch("changeStatusFilter", { status: $(this).val() });
    Livewire.dispatch("changePaymentTypeFilter", {
        type: $("#paymentStatus").val(),
    });
});

listenSubmit("#appointmentPaymentStatusForm", function (event) {
    event.preventDefault();
    let paymentStatus = $("#paymentStatus").val();
    let appointmentId = $("#appointmentId").val();
    let paymentMethod = $("#paymentType").val();

    $.ajax({
        url: route("change-payment-status", appointmentId),
        type: "POST",
        data: {
            appointmentId: appointmentId,
            paymentStatus: paymentStatus,
            paymentMethod: paymentMethod,
            loginUserId: currentLoginUserId,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#paymentStatusModal").modal("hide");
                location.reload();
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
