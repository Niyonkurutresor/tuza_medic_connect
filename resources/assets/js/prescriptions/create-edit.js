document.addEventListener('turbo:load', loadPrescriptionCreate)

let uniquePrescriptionId = 1;

function loadPrescriptionCreate() {
    if (!$('#prescriptionPatientId').length && !$('#editPrescriptionPatientId').length) {
        return
    }
    $('#prescriptionPatientId,#editPrescriptionPatientId,#filter_status,#prescriptionDoctorId,#editPrescriptionDoctorId,#prescriptionTime,#prescriptionMedicineCategoryId,#prescriptionMedicineBrandId,.prescriptionMedicineId,.prescriptionMedicineMealId,#editPrescriptionTime').select2({
        width: '100%',
    });

    $('#prescriptionMedicineBrandId, #prescriptionMedicineBrandId').select2({
        width: '100%',
        dropdownParent: $('#add_new_medicine')
    })

    $('#prescriptionPatientId,#editPrescriptionPatientId').first().focus();

};

listenSubmit('#createPrescription, #editPrescription', function () {
    $('.btnPrescriptionSave').attr('disabled', true);
});

listenClick(".add-medicine", function () {
    $("#add_new_medicine").appendTo("body").modal("show");
});

listenSubmit('#createMedicineFromPrescription', function (e) {
    e.preventDefault();
    $.ajax({
        url: route('prescription.medicine.store'),
        method: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            displaySuccessMessage(result.message);
            $('#add_new_medicine').modal('hide');
            $(".medicineTable").load(location.href + " .medicineTable");
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        }
    })
})

listen('hidden.bs.modal', '#add_new_medicine', function () {
    resetModalForm('#createMedicineFromPrescription', '#medicinePrescriptionErrorBox');
})

const dropdownToSelecte2 = (selector) => {
    $(selector).select2({
        placeholder: Lang.get('js.select_medicine'),
        width: '100%',
    })
}
const dropdownToSelecteDuration2 = (selector) => {
    $(selector).select2({
        placeholder: Lang.get('js.select_duration'),
        width: '100%',
    })
}
const dropdownToSelecteInterVal = (selector) => {
    $(selector).select2({
        placeholder: Lang.get('js.dose_interval'),
        width: '100%',
    })
}

listenClick('.delete-prescription-medicine-item', function () {
    $(this).parents('tr').remove();
    // resetPrescriptionMedicineItemIndex()
})

listenClick('.add-medicine-btn', function () {
    uniquePrescriptionId++;
    $('#prescriptionUniqueId').val(uniquePrescriptionId);

    let data = {
        'medicines': JSON.parse($('.associatePrescriptionMedicines').val()),
        'meals': JSON.parse($('.associatePrescriptionMeals').val()),
        'doseDuration': JSON.parse($('.DoseDurationId').val()),
        'doseInterVal': JSON.parse($('.DoseInterValId').val()),
        'uniqueId': uniquePrescriptionId
    }
    let prescriptionMedicineHtml = prepareTemplateRender('#prescriptionMedicineTemplate', data)
    $('.prescription-medicine-container').append(prescriptionMedicineHtml)
    dropdownToSelecte2('.prescriptionMedicineId')
    dropdownToSelecte2('.prescriptionMedicineMealId')
    dropdownToSelecteDuration2('.DoseDurationIdTemplate')
    dropdownToSelecteInterVal('.DoseInterValIdTemplate')


})

const resetPrescriptionMedicineItemIndex = () => {
    let index = 1
    if (index - 1 == 0) {
        let data = {
            'medicines': JSON.parse($('.associatePrescriptionMedicines').val()),
            'meals': JSON.parse($('.associatePrescriptionMeals').val()),
            'doseDuration': JSON.parse($('.DoseDurationId').val()),
            'doseInterVal': JSON.parse($('.DoseInterValId').val()),
            'uniqueId': uniquePrescriptionId
        }
        let packageServiceItemHtml = prepareTemplateRender('#prescriptionMedicineTemplate', data)
        $('.prescription-medicine-container').append(packageServiceItemHtml)
        dropdownToSelecte2('.prescriptionMedicineId')
        dropdownToSelecte2('.prescriptionMedicineMealId')
        dropdownToSelecteDuration2('.DoseDurationIdTemplate')
        dropdownToSelecteInterVal('.DoseInterValIdTemplate')
        uniquePrescriptionId++
    }
}

listenChange('.quantityget', function () {
    let medicineId = $(this).val();
    let currentRow = $(this).closest("tr");
    let uniqueId = $(this).attr("data-id");
    let salePriceId = currentRow.find('.quantityshow');
    let totalPriceId = currentRow.find('.totalqty');
    if (medicineId == "" || medicineId == Lang.get("js.select_medicine")) {
        $(totalPriceId).addClass("d-none");
        $(salePriceId).addClass("d-none");

        return false;
    }
    $.ajax({
        type: "get",
        url: route("get-medicine", medicineId),
        success: function (result) {
            $(totalPriceId).removeClass("d-none");
            $(salePriceId).removeClass("d-none");
            $(totalPriceId).attr("class", "text-success totalqty");

            $('#quantityshow'+uniqueId).text(result.data.available_quantity)
            if ($(salePriceId).text() == null) {
                $(totalPriceId).attr("class", "text-success totalqty d-none");
            }
            if ($(salePriceId).text() != null) {
                $(totalPriceId).attr("class", "text-success totalqty");
                $(".extra-margin-tr").css("margin-top", "21px");
                $(".extrm").css("margin-top", "21px");
            }
        },
    });
})
