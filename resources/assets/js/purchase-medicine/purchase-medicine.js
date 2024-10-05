document.addEventListener("turbo:load", loadPurchaseMedicineCreate);
let uniquePrescriptionId = "";

function loadPurchaseMedicineCreate() {
    if (!$("#purchaseUniqueId").length) {
        return;
    }
    $(".purchaseMedicineExpiryDate").flatpickr({
        minDate: new Date(),
        dateFormat: "Y-m-d",
    });
    $("#paymentMode,#paymentMode2").select2({
        width: "100%",
    });
}

listenClick(".add-medicine-btn-purchase", function () {
    uniquePrescriptionId = $("#purchaseUniqueId").val();
    let data = {
        medicines: JSON.parse($(".associatePurchaseMedicines").val()),
        uniqueId: uniquePrescriptionId,
    };
    let prescriptionMedicineHtml = prepareTemplateRender(
        "#purchaseMedicineTemplate",
        data
    );
    $(".prescription-medicine-container").append(prescriptionMedicineHtml);
    dropdownToSelecte2(".purchaseMedicineId");
    $(".purchaseMedicineExpiryDate").flatpickr({
        minDate: new Date(),
        dateFormat: "Y-m-d",
    });
    uniquePrescriptionId++;
    $("#purchaseUniqueId").val(uniquePrescriptionId);
});
const dropdownToSelecte2 = (selector) => {
    $(selector).select2({
        placeholder: Lang.get('js.select_medicine'),
        width: "100%",
    });
};

listenChange(".purchaseMedicineId", function () {
    let medicineId = $(this).val();
    let uniqueId = $(this).attr("data-id");
    let salePriceId = "#sale_price" + uniqueId;
    let buyPriceId = "#purchase_price" + uniqueId;
    if (medicineId == "") {
        $(salePriceId).val("0.00");
        $(buyPriceId).val("0.00");

        return false;
    }
    $.ajax({
        type: "get",
        url: route("get-medicine", medicineId),
        success: function (result) {
            $(salePriceId).val(result.data.selling_price.toFixed(2));
            $(buyPriceId).val(result.data.buying_price.toFixed(2));
        },
    });
});

listenKeyup(
    ".purchase-quantity,.purchase-price,purchase-quantity,.purchase-tax,.purchase-discount",
    function () {

        let value = $(this).val();
        $(this).val(value.replace(/[^0-9\.]/g, ""));
        var currentRow = $(this).closest("tr");
        let  currentqty = currentRow.find('.purchase-quantity').val()
        let  price = currentRow.find('.purchase-price').val();
        let  currentamount =  parseFloat(price * currentqty);
        currentRow.find('.purchase-amount').val(currentamount.toFixed(2))
        let taxEle = $('.purchase-tax');
        let elements = $('.purchase-amount');
        let total = 0.00;
        let totalTax = 0;
        let netAmount = 0;
        let discount = 0;
        let amount = 0;
        for (let i=0; i< elements.length; i++){
        total+= parseFloat(elements[i].value);
        discount = $('.purchase-discount').val();
        if(taxEle[i].value!= 0 && taxEle[i].value!='')
        {
            if (taxEle[i].value > 99) {
                let taxAmount = taxEle[i].value.slice(0,-1);
                currentRow.find('.purchase-tax').val(taxAmount);
                displayErrorMessage(
                    Lang.get("js.tax_should_be")
                );
                $("#discountAmount").val(discount);
                return false;
            }
            totalTax += elements[i].value * taxEle[i].value/100;
        }else{
            amount += parseFloat(elements[i].value);
        }
    }
        discount = discount== '' ? 0 : discount;
        netAmount = parseFloat(total) + parseFloat(totalTax);
        netAmount =  parseFloat(netAmount)-parseFloat(discount);
        if(discount > total && $(this).hasClass('purchase-discount')){
            discount = discount.slice(0,-1);
            displayErrorMessage(
                Lang.get("js.the_discount_shoul")
                );
            $("#discountAmount").val(discount);
            return false;
        }
        if(discount > total){
            netAmount = 0;
        }

         $("#total").val(total.toFixed(2));
         $("#purchaseTaxId").val(totalTax.toFixed(2));
         $("#netAmount").val(netAmount.toFixed(2));
        // let value = $(this).val();
        // $(this).val(value.replace(/[^0-9\.]/g, ""));
        // var currentRow = $(this).closest("tr");
        // let currentqty = currentRow.find(".purchase-quantity").val();
        // let price = currentRow.find(".purchase-price").val();
        // let medicineBillTax = currentRow.find(".purchase-tax").val();
        // let currentamount = parseFloat(price * currentqty);
        // currentRow.find(".amount").val(currentamount.toFixed(2));

        // let y = $(".purchaseMedicineId").length;
        // let taxEle = $(".purchase-tax");
        // let elements = $(".amount");
        // let total = 0.0;
        // let totalTax = 0;
        // let netAmount = 0;
        // let discount = 0;
        // let amount = 0;
        // var qty = $(".purchase-quantity");

        // for (let i = 0; i < elements.length; i++) {
        //     total += parseFloat(elements[i].value);
        //     discount = $(".purchase-discount").val();
        //     let taxAmount = $(this).val();
        //     if (taxEle[i].value != 0 && taxEle[i].value != "") {
        //         if (taxEle[i].value > 99) {
        //             let taxAmount = taxEle[i].value.slice(0, -1);
        //             currentRow.find(".purchase-tax").val(taxAmount);
        //             displayErrorMessage(
        //                 Lang.get("Taxes should be less than 100%.")
        //             );
        //             $("#discountAmount").val(discount);
        //             return false;
        //         }
        //         totalTax += (elements[i].value * taxEle[i].value) / 100;
        //         amount += parseFloat(elements[i].value) + parseFloat(totalTax);
        //     } else {
        //         amount += parseFloat(elements[i].value);
        //     }
        // }
        // discount = discount == "" ? 0 : discount;
        // netAmount = parseFloat(amount) - parseFloat(discount);
        // if (discount > total && $(this).hasClass("purchase-discount")) {
        //     discount = discount.slice(0, -1);
        //     displayErrorMessage(
        //         Lang.get("The discount should be less than the total amount.")
        //     );
        //     $("#discountAmount").val(discount);
        //     return false;
        // }
        // if (discount > total) {
        //     netAmount = 0;
        // }
        // $("#total").val(total.toFixed(2));
        // $("#purchaseTaxId").val(totalTax.toFixed(2));
        // $("#netAmount").val(netAmount.toFixed(2));

    });

listenClick(".delete-purchase-medicine-item", function () {

    let currentRow = $(this).closest("tr");
    let  currentRowAmount = currentRow.find('.purchase-amount').val()
    let  currentRowTax = currentRow.find('.purchase-tax').val()
    let  currentTaxAmount = parseFloat(currentRowAmount)*parseFloat(currentRowTax/100);
    let updatedTax= parseFloat($('#purchaseTaxId').val())-parseFloat(currentTaxAmount)

    $('#purchaseTaxId').val(updatedTax.toFixed(2));
    let updatedTotalAmount  = parseFloat($('#total').val())-parseFloat(currentRowAmount);
    $('#total').val(updatedTotalAmount.toFixed(2))
    let amountSubfromNetAmt = parseFloat(currentTaxAmount) + parseFloat(currentRowAmount);


    let updateNetAmount =  parseFloat($('#netAmount').val())- parseFloat(amountSubfromNetAmt);
    $('#netAmount').val(updateNetAmount.toFixed(2));
    $(this).parents("tr").remove();
});

listenSubmit("#purchaseMedicineFormId", function (e) {
    e.preventDefault();

    let y = $("#purchaseUniqueId").val() - 1;
    let tx = 1;
    for (let i = 1; i <= y; i++) {
        let medicinID = "#medicineChooseId" + i;
        let taxId = "tax" + i;

        if (typeof $(taxId).val() != "undefined") {
            if ($(taxId).val() == null || $(taxId).val() == "") {
                tx = 0;
            }
        }
        if (typeof $(medicinID).val() != "undefined") {
            if ($(medicinID).val() == null || $(medicinID).val() == "") {
                displayErrorMessage(Lang.get('js.enter_lot_number'));
                return false;
            }
        }
        let lotNum = "#lot_no" + i;
        if (typeof $(lotNum).val() != "undefined") {
            if ($(lotNum).val() == null || $(lotNum).val() == "") {
                displayErrorMessage(Lang.get('js.enter_lot_number'));
                return false;
            }
        }

        let salePrice = "#sale_price" + i;
        if (typeof $(salePrice).val() != "undefined") {
            if ($(salePrice).val() == null || $(salePrice).val() == "") {
                displayErrorMessage(Lang.get('js.enter_sale_price'));
                return false;
            }
        }

        let purchasePrice = "#purchase_price" + i;
        if (typeof $(purchasePrice).val() != "undefined") {
            if (
                $(purchasePrice).val() == null ||
                $(purchasePrice).val() == ""
            ) {
                displayErrorMessage("Enter purchase price.");
                return false;
            } else if ($(purchasePrice).val() == 0) {
                displayErrorMessage(Lang.get('js.quantity_should'));
                return false;
            }
        }
        let quantityID = "#quantity" + i;
        if (typeof $(quantityID).val() != "undefined") {
            if ($(quantityID).val() == null || $(quantityID).val() == "") {
                displayErrorMessage("Enter quantity.");
                return false;
            } else if ($(quantityID).val() == 0) {
                displayErrorMessage(Lang.get('js.quantity_should'));
                return false;
            }
        }
    }

    let netAmount = "#netAmount";
    if ($(netAmount).val() == null || $(netAmount).val() == "") {
        displayErrorMessage(
            Lang.get("js.net_amount_not_empty")
        );        return false;
    } else if ($(netAmount).val() == 0) {
        displayErrorMessage(
            Lang.get("js.net_amount_not_zero")
        );
       return false;
    }

    if (
        tx == 0 &&
        ($("#purchaseTaxId").val() == null || $("#purchaseTaxId").val() == "")
    ) {
        displayErrorMessage(Lang.get("js.tax_cannot_be_zero_empty"));
        return false;
    }

    $(this)[0].submit();
});

listenClick(".purchaseMedicineDelete", function (event) {
    let id = $(event.currentTarget).attr("data-id");
    deleteItem(
        route("medicine-purchase.destroy", id),
        Lang.get("js.purchase_medicine")
    );
});
