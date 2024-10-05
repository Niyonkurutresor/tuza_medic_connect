// document.addEventListener('turbo:load', loadHoliday)
var Start = moment().startOf("week");
var End = moment().endOf("week");
Livewire.hook("element.init", () => {
    loadHoliday();
    if (Start != undefined && End != undefined) {
        cb(Start, End);
    }
});

function loadHoliday() {
    if (!$("#holidayDateFilter").length) {
        return;
    }

    // let Start = moment().startOf("week");
    // let End = moment().endOf("week");

    let holidayPcker = $("#holidayDateFilter").daterangepicker(
        {
            startDate: Start,
            endDate: End,
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

    // cb(Start, End);

    holidayPcker.on("apply.daterangepicker", function (ev, picker) {
        let date =
            picker.startDate.format("DD/MM/YYYY") +
            " - " +
            picker.endDate.format("DD/MM/YYYY");
        Livewire.dispatch("changeDateFilter", { date: date });

        Start = picker.startDate;
        End = picker.endDate;
        // Livewire.dispatch("changeDateFilter", { date: $(this).val() });
    });
}
function cb(start, end) {
    $("#holidayDateFilter").val(
        start.format("MM/DD/YYYY") + " - " + end.format("MM/DD/YYYY")
    );
}

listenClick(".holiday-delete-btn", function (event) {
    let holidayRecordId = $(event.currentTarget).attr("data-id");
    deleteItem(
        route("doctors.holiday-destroy", holidayRecordId),
        Lang.get("js.holiday")
    );
});
