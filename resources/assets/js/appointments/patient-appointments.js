// document.addEventListener('turbo:load',
//     loadPatientPanelAppointmentFilterData)
var patientPanelApptmentStart = moment().startOf("week");
var patientPanelApptmentEnd = moment().endOf("week");

function loadPatientPanelAppointmentFilterData() {
    if (!$("#patientAppointmentDate").length) {
        return;
    }

    // let patientPanelApptmentStart = moment().startOf("week");
    // let patientPanelApptmentEnd = moment().endOf("week");

    let patientDatePicker = $("#patientAppointmentDate").daterangepicker(
        {
            startDate: patientPanelApptmentStart,
            endDate: patientPanelApptmentEnd,
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

    // cb(patientPanelApptmentStart, patientPanelApptmentEnd);
    patientDatePicker.on("apply.daterangepicker", function (ev, picker) {
        let date =
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY");
        Livewire.dispatch("changeDateFilter", { date: date });

        patientPanelApptmentStart = picker.startDate;
        patientPanelApptmentEnd = picker.endDate;

        // Livewire.dispatch("changeDateFilter", { date: $(this).val() });
    });
}
function cb(start, end) {
    $("#patientAppointmentDate").val(
        start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
    );
}

listenClick("#patientPanelApptmentResetFilter", function () {
    Livewire.dispatch("refresh");
    $("#patientPaymentStatus").val(0).trigger("change");
    $("#patientAppointmentStatus").val(1).trigger("change");
    $("#patientAppointmentDate")
        .data("daterangepicker")
        .setStartDate(moment().startOf("week").format("MM/DD/YYYY"));
    $("#patientAppointmentDate")
        .data("daterangepicker")
        .setEndDate(moment().endOf("week").format("MM/DD/YYYY"));
    hideDropdownManually($("#patientPanelApptFilterBtn"), $(".dropdown-menu"));
});

listenChange("#patientPaymentStatus", function () {
    Livewire.dispatch("changeDateFilter", {
        date: $("#patientAppointmentDate").val(),
    });
    Livewire.dispatch("changePaymentTypeFilter", { type: $(this).val() });
});

listenChange("#patientAppointmentStatus", function () {
    Livewire.dispatch("changeDateFilter", {
        date: $("#patientAppointmentDate").val(),
    });
    Livewire.dispatch("changeStatusFilter", { status: $(this).val() });
});

// document.addEventListener('livewire:load', function () {
//     window.livewire.hook('message.processed', () => {
//         if ($('#patientPaymentStatus').length) {
//             $('#patientPaymentStatus').select2()
//         }
//         if ($('#patientAppointmentStatus').length) {
//             $('#patientAppointmentStatus').select2()
//         }
//     })
// })

Livewire.hook("element.init", () => {
    loadPatientPanelAppointmentFilterData();
    if ($("#patientPaymentStatus").length) {
        $("#patientPaymentStatus").select2();
    }
    if ($("#patientAppointmentStatus").length) {
        $("#patientAppointmentStatus").select2();
    }
    if (
        patientPanelApptmentStart != undefined &&
        patientPanelApptmentEnd != undefined
    ) {
        cb(patientPanelApptmentStart, patientPanelApptmentEnd);
    }
});

listenClick(".patient-panel-apptment-delete-btn", function (event) {
    let userRole = $("#userRole").val();
    let patientPanelApptmentRecordId = $(event.currentTarget).attr("data-id");
    let patientPanelApptmentRecordUrl = !isEmpty(userRole)
        ? route("patients.appointments.destroy", patientPanelApptmentRecordId)
        : route("appointments.destroy", patientPanelApptmentRecordId);
    deleteItem(patientPanelApptmentRecordUrl, "Appointment");
});

listenClick(".patient-cancel-appointment", function (event) {
    let appointmentId = $(event.currentTarget).attr("data-id");
    cancelAppointment(
        route("patients.cancel-status"),
        Lang.get("js.appointment"),
        appointmentId
    );
});

window.cancelAppointment = function (url, header, appointmentId) {
    swal({
        title: Lang.get("js.cancelled_appointment"),
        text: Lang.get("js.are_you_sure_cancel") + header + " ?",
        type: "warning",
        icon: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonColor: "#266CB0",
        showLoaderOnConfirm: true,
        buttons: {
            confirm: Lang.get("js.yes"),
            cancel: Lang.get("js.no"),
        },
    }).then(function (result) {
        if (result) {
            deleteItemAjax(url, header, appointmentId);
        }
    });
};

function deleteItemAjax(url, header, appointmentId) {
    $.ajax({
        url: route("patients.cancel-status"),
        type: "POST",
        data: { appointmentId: appointmentId },
        success: function (obj) {
            if (obj.success) {
                Livewire.dispatch("refresh");
            }
            swal({
                title: Lang.get("js.cancelled_appointment"),
                text: header + Lang.get("js.has_cancel"),
                icon: "success",
                confirmButtonColor: "#266CB0",
                timer: 2000,
            });
        },
        error: function (data) {
            swal({
                title: "Error",
                icon: "error",
                text: data.responseJSON.message,
                type: "error",
                confirmButtonColor: "#266CB0",
                timer: 5000,
            });
        },
    });
}

listenClick("#submitBtn", function (event) {
    event.preventDefault();
    let paymentGatewayType = $("#paymentGatewayType").val();
    if (isEmpty(paymentGatewayType)) {
        displayErrorMessage(Lang.get("js.select_payment"));
        return false;
    }
    let stripeMethod = 2;
    let paystackMethod = 3;
    let paypalMethod = 4;
    let razorpayMethod = 5;
    let authorizeMethod = 6;
    let paytmMethod = 7;

    let appointmentId = $("#patientAppointmentId").val();
    let btnSubmitEle = $("#patientPaymentForm").find("#submitBtn");
    setAdminBtnLoader(btnSubmitEle);

    if (paymentGatewayType == stripeMethod) {
        $.ajax({
            url: route("patients.appointment-payment"),
            type: "POST",
            data: { appointmentId: appointmentId },
            success: function (result) {
                let sessionId = result.data.sessionId;
                stripe
                    .redirectToCheckout({
                        sessionId: sessionId,
                    })
                    .then(function (result) {
                        manageAjaxErrors(result);
                    });
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {},
        });
    }

    if (paymentGatewayType == paytmMethod) {
        window.location.replace(
            route("paytm.init", { appointmentId: appointmentId })
        );
    }

    if (paymentGatewayType == paystackMethod) {
        window.location.replace(
            route("paystack.init", { appointmentData: appointmentId })
        );
    }

    if (paymentGatewayType == authorizeMethod) {
        window.location.replace(
            route("authorize.init", { appointmentId: appointmentId })
        );
    }

    if (paymentGatewayType == paypalMethod) {
        $.ajax({
            type: "GET",
            url: route("paypal.init"),
            data: { appointmentId: appointmentId },
            success: function (result) {
                if (result.status == 200) {
                    let redirectTo = "";
                    location.href = result.link;
                    // $.each(result.result.links,
                    //     function (key, val) {
                    //         if (val.rel == 'approve') {
                    //             redirectTo = val.href;
                    //         }
                    //     });
                    // location.href = redirectTo;
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {},
        });
    }

    if (paymentGatewayType == razorpayMethod) {
        $.ajax({
            type: "POST",
            url: route("razorpay.init"),
            data: { appointmentId: appointmentId },
            success: function (result) {
                if (result.success) {
                    let { id, amount, name, email, contact } = result.data;

                    options.amount = amount;
                    options.order_id = id;
                    options.prefill.name = name;
                    options.prefill.email = email;
                    options.prefill.contact = contact;
                    options.prefill.appointmentID = appointmentId;

                    let razorPay = new Razorpay(options);
                    razorPay.open();
                    razorPay.on("payment.failed", storeFailedPayment);
                }
            },
            error: function (result) {
                displayErrorMessage(result.responseJSON.message);
            },
            complete: function () {},
        });
    }

    return false;
});

function storeFailedPayment(response) {
    $.ajax({
        type: "POST",
        url: route("razorpay.failed"),
        data: {
            data: response,
        },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
            }
        },
        error: function () {},
    });
}

listenClick(".payment-btn", function (event) {
    let appointmentId = $(this).attr("data-id");
    $("#paymentGatewayModal").modal("show").appendTo("body");
    $("#patientAppointmentId").val(appointmentId);
});

listen("hidden.bs.modal", "#paymentGatewayModal", function (e) {
    $("#patientPaymentForm")[0].reset();
    $("#paymentGatewayType").val(null).trigger("change");
});
