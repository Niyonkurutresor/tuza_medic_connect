// document.addEventListener('turbo:load', loadTransactionFilterDate)

var appointmentStart = moment().startOf("week");
var appointmentEnd = moment().endOf("week");

Livewire.hook("element.init", () => {
    loadTransactionFilterDate();
    if ($("#trPaymentMehtod").length) {
        $("#trPaymentMehtod").select2();
    }
    if ($("#transactionStatus").length) {
        $("#transactionStatus").select2();
    }
    if ($("#transactionDoctor").length) {
        $("#transactionDoctor").select2();
    }
    if ($("#transactionServices").length) {
        $("#transactionServices").select2();
    }
    if (appointmentStart != undefined && appointmentEnd != undefined) {
        cb(appointmentStart, appointmentEnd);
    }
});

function loadTransactionFilterDate() {
    if (!$("#transactionDateFilter").length) {
        return;
    }

    // let appointmentStart = moment().startOf('week')
    // let appointmentEnd = moment().endOf('week')

    let transactionDatePicker = $("#transactionDateFilter").daterangepicker(
        {
            startDate: appointmentStart,
            endDate: appointmentEnd,
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

    //cb(appointmentStart, appointmentEnd);

    transactionDatePicker.on("apply.daterangepicker", function (ev, picker) {
        let date =
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY");
        Livewire.dispatch("changeDateFilter", { date: date });

        appointmentStart = picker.startDate;
        appointmentEnd = picker.endDate;
    });

    window.addEventListener("update-item", (event) => {
        let array = event.detail.data;
        console.log(array);
        $("#transactionDoctor").empty();
        $("#transactionDoctor").append(
            $('<option value=""></option>').text(Lang.get("js.select_doctor"))
        );
        $.each(array, function (key, value) {
            $("#transactionDoctor").append(
                $("<option></option>").attr("value", key).text(value)
            );
        });
    });
}

function cb(start, end) {
    $("#transactionDateFilter").val(
        start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
    );
}

listenChange("#trPaymentMehtod", function () {
    Livewire.dispatch("paymentFilter", { pType: $(this).val() });
});

listenChange("#transactionStatus", function () {
    Livewire.dispatch("statusFilter", { statusType: $(this).val() });
});

listenChange("#transactionDoctor", function () {
    Livewire.dispatch("doctorFilter", { doctorType: $(this).val() });
});

listenChange("#transactionServices", function () {
    Livewire.dispatch("serviceFilter", { serviceType: $(this).val() });
});

listenClick("#transactionResetFilter", function () {
    $("#trPaymentMehtod").val("").trigger("change");
    $("#transactionStatus").val("").trigger("change");
    $("#transactionDoctor,#transactionServices").val("").trigger("change");
    hideDropdownManually($("#transactionFilterBtn"), $(".dropdown-menu"));
});
