document.addEventListener("turbo:load", loadSaleMedicineCreate);
let uniquePrescriptionId = "";

function loadSaleMedicineCreate() {
    if (!$("#medicineUniqueId").length) {
        return;
    }
    $(".medicinePurchaseId").select2({
        width: "100%",
    });
    $(".medicine_bill_date").flatpickr({
        enableTime: true,
        defaultDate: new Date(),
        dateFormat: "Y-m-d H:i",
    });

    $(".edit_medicine_bill_date").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    $(".medicineBillExpiryDate").flatpickr({
        minDate: new Date(),
        dateFormat: "Y-m-d",
    });

    $(".medicine-payment-mode").select2({
        width: "100%",
    });
    $(".medicineBillCategoriesId").select2({
        width: "100%",
    });
}

listenChange(".medicineBillCategoriesId", function () {
    let categoryId = $(this).val();

    let currentRow = $(this).closest("tr");
    let medicineId = currentRow.find('.purchaseMedicineId');
    let medicineAvlQty = currentRow.find('.medicineTotalQuantity');
    let medicineSalePrice = currentRow.find('.medicineBill-sale-price');

    if (categoryId == "") {
        $(medicineId).find("option").remove();
        $(medicineId).append(
            $("<option></option>")
                .attr("placeholder", "")
                .text(Lang.get("js.select_medicine"))
        );
        $(medicineAvlQty).text('0');

        return false;
    }
    $.ajax({
        type: "get",
        url: route("get-medicine-category", categoryId),
        success: function (result) {
            let array = result.data.medicine;
            $(medicineId).find("option").remove();
            $(medicineId).attr("required",true);
            $(medicineId).append($('<option value="">Select Medicine</option>'));
            $.each(array, function (key, value) {
                $(medicineId).append($('<option></option>').attr('value', key).text(value));

            });

            $(medicineAvlQty).text('0');
            $(medicineSalePrice).val('0.00');
        },
    });
});

listenChange(".medicinePurchaseId", function () {
    var currentRow = $(this).closest("tr");
    let medicineId = $(this).val();
    let uniqueId = $(this).attr("data-id");
    let salePriceId =  currentRow.find(".medicineBill-sale-price");
    let QuantityPriceId =  currentRow.find(".medicineTotalQuantity");
    if (medicineId == "" || medicineId == Lang.get("js.select_medicine")) {
        $(salePriceId).val("0.00");
        $(QuantityPriceId).text("0");
        return false;
    }
    $.ajax({
        type: "get",
    url: route("get-medicine", medicineId),
        success: function (result) {
            $(salePriceId).val(result.data.selling_price.toFixed(2));
            let currentqty = currentRow.find(".medicineBill-quantity").val();
            let price = currentRow.find(".medicineBill-sale-price").val();
            let currentamount = parseFloat(price * currentqty);
            currentRow.find(".medicine-bill-amount").val(currentamount.toFixed(2))
            let taxEle = $(".medicineBill-tax");
            let elements = $(".medicine-bill-amount");
            let total = 0.0;
            let totalTax = 0;
            let netAmount = 0;
            let discount = 0;
            let amount = 0;
            for (let i = 0; i < elements.length; i++) {
                total += parseFloat(elements[i].value);
                discount = $(".medicineBill-discount").val();
                if (taxEle[i].value != 0 && taxEle[i].value != "") {
                    totalTax += (elements[i].value * taxEle[i].value) / 100;
                } else {
                    amount += parseFloat(elements[i].value);
                }
            }
            discount = discount == "" ? 0 : discount;
            netAmount = parseFloat(total) + parseFloat(totalTax);
            netAmount = parseFloat(netAmount) - parseFloat(discount);
            if (discount > total && $(this).hasClass("medicineBill-discount")) {
                discount = discount.slice(0, -1);
                displayErrorMessage(
                    Lang.get("js.the_discount_shoul")
                );
                $("#discountAmount").val(discount);
                return false;
            }
            if (discount > total) {
                netAmount = 0;
            }
            $("#total").val(total.toFixed(2));
            $("#medicineTotalTaxId").val(totalTax.toFixed(2));
            $("#netAmount").val(netAmount.toFixed(2));
            $(QuantityPriceId).text(result.data.available_quantity)
        },
    });
});

listenClick(".add-medicine-btn-medicine-bill", function () {
    uniquePrescriptionId = $("#medicineUniqueId").val();
    let data = {
        medicinesCategories: JSON.parse(
            $("#showMedicineCategoriesMedicineBill").val()
        ),
        medicines: JSON.parse($(".associatePurchaseMedicines").val()),
        uniqueId: uniquePrescriptionId,
    };
    let prescriptionMedicineHtml = prepareTemplateRender(
        "#medicineBillTemplate",
        data
    );
    $(".medicine-bill-container").append(prescriptionMedicineHtml);
    dropdownToSelecte2(".medicinePurchaseId");
    dropdownToSelecteCategories2(".medicinebillCategories");
    expiryDateFlatePicker(".medicinebillCategories");

    $(".purchaseMedicineExpiryDate").flatpickr({
        minDate: new Date(),
        dateFormat: "Y-m-d",
    });
    uniquePrescriptionId++;
    $("#medicineUniqueId").val(uniquePrescriptionId);
});
const dropdownToSelecte2 = (selector) => {
    $(selector).select2({
        placeholder:  Lang.get('js.select_medicine'),
        width: "100%",
    });
};
const dropdownToSelecteCategories2 = (selector) => {
    $(selector).select2({
        placeholder: Lang.get('js.select_category'),
        width: "100%",
    });
};
const expiryDateFlatePicker = (selector) => {
    $(".medicineBillExpiryDate").flatpickr({
        minDate: new Date(),
        dateFormat: "Y-m-d",
    });
};
listenKeyup(
    ".medicineBill-quantity,.medicineBill-price,.medicineBill-tax,.medicineBill-discount,.medicineBill-sale-price",
    function () {
        let value = $(this).val();
        $(this).val(value.replace(/[^0-9\.]/g, ""));
        var currentRow = $(this).closest("tr");
        let currentqty = currentRow.find(".medicineBill-quantity").val();
        let price = currentRow.find(".medicineBill-sale-price").val();
        let currentamount = parseFloat(price * currentqty);
        currentRow.find(".medicine-bill-amount").val(currentamount.toFixed(2));

        let taxEle = $(".medicineBill-tax");
        let elements = $(".medicine-bill-amount");
        let total = 0.0;
        let totalTax = 0;
        let netAmount = 0;
        let discount = 0;
        let amount = 0;
        var qty = $(".medicineBill-quantity");
        var PreviousQty = $(".previous-quantity");
        for (let i = 0; i < elements.length; i++) {
            total += parseFloat(elements[i].value);
            discount = $(".medicineBill-discount").val();
            if ($("#medicineBillStatus").val() == 1) {
                if (parseInt(qty[i].value) > parseInt(PreviousQty[i].value)) {
                    let qtyRollback = qty[i].value.slice(0, -1);
                    currentRow.find(".medicineBill-quantity").val(qtyRollback);
                    currentqty = currentRow
                        .find(".medicineBill-quantity")
                        .val();
                    price = currentRow.find(".medicineBill-sale-price").val();
                    currentamount = parseFloat(price * currentqty);
                    currentRow
                        .find(".medicine-bill-amount")
                        .val(currentamount.toFixed(2));
                    displayErrorMessage(
                        Lang.get("js.update_quantity")
                    );
                    return false;
                }
            }
            if (taxEle[i].value != 0 && taxEle[i].value != "") {
                if (taxEle[i].value > 99) {
                    let taxAmount = taxEle[i].value.slice(0, -1);
                    currentRow.find(".medicineBill-tax").val(taxAmount);
                    displayErrorMessage(
                        Lang.get("js.tax_should_be")
                        );
                    $("#discountAmount").val(discount);
                    return false;
                }
                totalTax += (elements[i].value * taxEle[i].value) / 100;
            } else {
                amount += parseFloat(elements[i].value);
            }
        }
        discount = discount == "" ? 0 : discount;
        netAmount = parseFloat(total) + parseFloat(totalTax);
        netAmount = parseFloat(netAmount) - parseFloat(discount);
        if (discount > total && $(this).hasClass("medicineBill-discount")) {
            discount = discount.slice(0, -1);
            displayErrorMessage(
                Lang.get("js.the_discount_shoul")
                );
            $("#discountAmount").val(discount);
            return false;
        }
        if (discount > total) {
            netAmount = 0;
        }
        $("#total").val(total.toFixed(2));
        $("#medicineTotalTaxId").val(totalTax.toFixed(2));
        $("#netAmount").val(netAmount.toFixed(2));
    }
);

listenSubmit("#CreateMedicineBillForm", function (e) {
    e.preventDefault();
    let netAmount = "#netAmount";

    if ($("#total").val() < $("#discountAmount").val()) {
        displayErrorMessage(
            Lang.get("js.the_discount_shoul")
        );
        return false;
    } else if ($(netAmount).val() == null || $(netAmount).val() == "") {
        displayErrorMessage(
            Lang.get("js.net_amount_not_empty")
        );
        return false;
    } else if ($(netAmount).val() == 0) {
        displayErrorMessage(
            Lang.get("js.net_amount_not_zero")
        );
        return false;
    } else if (
        $(".medicineBill-quantity").val() == 0 ||
        $(".medicineBill-quantity").val() == null ||
        $(".medicineBill-quantity").val() == ""
    ) {
        displayErrorMessage(Lang.get("js.quantity_should"));
        return false;
    }

    $(this)[0].submit();
});

listenClick(".add-patient-modal", function () {
    $("#addPatientModal").appendTo("body").modal("show");
});

listenSubmit("#addPatientForm", function (e) {
    e.preventDefault();
    processingBtn("#addPatientForm", "#patientBtnSave", "loading");
    $("#patientBtnSave").attr("disabled", true);
    $.ajax({
        url: route("store.patient"),
        type: "POST",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $("#prescriptionPatientId").find("option").remove();
                $("#prescriptionPatientId").append(
                    $("<option></option>")
                        .attr("placeholder", "")
                        .text(Lang.get("js.select_patient"))
                );
                $.each(result.data, function (i, v) {
                    $("#prescriptionPatientId").append(
                        $("<option></option>").attr("value", i).text(v)
                    );
                });
                displaySuccessMessage(result.message);
                $("#addPatientModal").modal("hide");
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
        complete: function () {
            $("#patientBtnSave").attr("disabled", false);
            processingBtn("#addPatientForm", "#patientBtnSave");
        },
    });
});

listen('hidden.bs.modal',"#addPatientModal", function () {
    resetModalForm("#addPatientForm", "#patientErrorsBox");
});

listenClick(".medicine-bill-delete-btn", function (event) {
    let id = $(event.currentTarget).attr("data-id");

    deleteItem(
        route("medicine-bills.destroy", id),
        Lang.get("js.medicine_bill")
    );
});

listenSubmit("#MedicinebillForm", function (e) {
    e.preventDefault();

    let netAmount = "#netAmount";
    if (
        parseFloat($("#total").val()) < parseFloat($("#discountAmount").val())
    ) {
        displayErrorMessage(
            Lang.get("js.the_discount_shoul")
        );
        return false;
    } else if ($(netAmount).val() == null || $(netAmount).val() == "") {
        displayErrorMessage(
            Lang.get("js.net_amount_not_empty")
        );
        return false;
    } else if ($(netAmount).val() == 0) {
        displayErrorMessage(
            Lang.get("js.net_amount_not_zero")
        );
        return false;
    } else if (
        $(".medicineBill-quantity").val() == 0 ||
        $(".medicineBill-quantity").val() == null ||
        $(".medicineBill-quantity").val() == ""
    ) {
        displayErrorMessage(Lang.get("js.quantity_should"));
        return false;
    }
    $medicineBillId = $("#medicineBillId").val();
    $.ajax({
        url: route("medicine-bills.update", $medicineBillId),
        type: "post",
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message);
                setTimeout(function () {
                    Turbo.visit(route("medicine-bills.index")); // true
                }, 2000);
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});

listenClick(".delete-medicine-bill-item", function () {
    let currentRow = $(this).closest("tr");
    let currentRowAmount = currentRow.find(".medicine-bill-amount").val();
    let currentRowTax = currentRow.find(".medicineBill-tax").val();
    let currentTaxAmount =
        parseFloat(currentRowAmount) * parseFloat(currentRowTax / 100);
    let updatedTax =
        parseFloat($("#medicineTotalTaxId").val()) -
        parseFloat(currentTaxAmount);

    $("#medicineTotalTaxId").val(updatedTax.toFixed(2));
    let updatedTotalAmount =
        parseFloat($("#total").val()) - parseFloat(currentRowAmount);
    $("#total").val(updatedTotalAmount.toFixed(2));
    let amountSubfromNetAmt =
        parseFloat(currentTaxAmount) + parseFloat(currentRowAmount);

    let updateNetAmount =
        parseFloat($("#netAmount").val()) - parseFloat(amountSubfromNetAmt);
    $("#netAmount").val(updateNetAmount.toFixed(2));

    $(this).parents("tr").remove();
});

