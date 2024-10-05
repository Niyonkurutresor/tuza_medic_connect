document.addEventListener("turbo:load", loadDoctorData);

function loadDoctorData() {
    loadDoctorDate();
}

function loadDoctorDate() {
    let lang = $(".currentLanguage").val();
    $("#doctorHolidayDate").flatpickr({
        locale: lang,
        minDate: new Date().fp_incr(1),
        disableMobile: true,
    });

    listenClick(".doctor-holiday-delete-btn", function (event) {
        let holidayRecordId = $(event.currentTarget).attr("data-id");
        deleteItem(
            route("holidays.destroy", holidayRecordId),
            Lang.get("js.holiday")
        );
    });
}
