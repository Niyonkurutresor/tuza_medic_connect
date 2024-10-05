listenClick("#createCity", function () {
    $("#createCityModal").modal("show").appendTo("body");

    $("#stateCity").select2({
        dropdownParent: $("#createCityModal"),
    });
});


listen("hidden.bs.modal", "#createCityModal", function () {
    resetModalForm("#createCityForm", "#createCityValidationErrorsBox");
    $("#stateCity").val(null).trigger("change");
});

listen("hidden.bs.modal", "#editCityModal", function () {
    resetModalForm("#editCityForm", "#editCityValidationErrorsBox");
});

listenClick(".city-edit-btn", function (event) {
    let editCityId = $(event.currentTarget).attr("data-id");
    renderData(editCityId);

    $("#editCityStateId").select2({
        dropdownParent: $("#editCityModal"),
    });
});

function renderData(id) {
    $.ajax({
        url: route("cities.edit", id),
        type: "GET",
        success: function (result) {
            $("#cityID").val(result.data.id);
            $("#editCityName").val(result.data.name);
            $("#editCityStateId").val(result.data.state_id).trigger("change");
            $("#editCityModal").modal("show");
        },
    });
}

listenSubmit("#createCityForm", function (e) {
    e.preventDefault();
    $.ajax({
        url: route("cities.store"),
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                $("#createCityModal").modal("hide");
                Livewire.dispatch("refresh");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenSubmit("#editCityForm", function (e) {
    e.preventDefault();
    let updateCityId = $("#cityID").val();
    $.ajax({
        url: route("cities.update", updateCityId),
        type: "PUT",
        data: $(this).serialize(),
        success: function (result) {
            $("#editCityModal").modal("hide");
            displaySuccessMessage(result.message);
            Livewire.dispatch("refresh");
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".city-delete-btn", function (event) {
    let cityRecordId = $(event.currentTarget).attr("data-id");
    deleteItem(
        route("cities.destroy", cityRecordId),
        Lang.get("js.city")
    );
});
