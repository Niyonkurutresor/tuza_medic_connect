document.addEventListener('turbo:load', loadAppointmentFilterDate)

function loadAppointmentFilterDate() {

    $('.patient_select').css('display', 'none');

    if ($('#header_color').length !== 0) {
        let header = $('#header_color').val();
        $('.card-header').css('background-color', header);
    }
    $('.generate_smart_patientcard_patient_select').select2({
        dropdownParent: $('#add_templates_modal')
     });

    $('.select_template').select2({
        dropdownParent: $('#add_templates_modal')
     });



};

listenChange(
    "#card_show_email_switch, #card_show_phone_switch, #card_show_dob_switch, #card_show_blood_group_switch, #card_show_address_switch, #card_show_patient_unique_id_switch, #header_color",
    function () {
        let name = $(this).attr("id");
        let color = $("#header_color").val();

        switch (name) {
            case "header_color":
                $(".card-header").css("background-color", color);
                break;
            case "card_show_email_switch":
                $("#card_show_email").toggleClass("display_show");
                break;
            case "card_show_phone_switch":
                $("#card_show_phone").toggleClass("display_show");
                break;
            case "card_show_address_switch":
                $("#card_show_address").toggleClass("display_show");
                break;
            case "card_show_blood_group_switch":
                $("#card_show_blood_group").toggleClass("display_show");
                break;
            case "card_show_dob_switch":
                $("#card_show_dob").toggleClass("display_show");
                break;
            case "card_show_patient_unique_id_switch":
                $("#card_show_patient_unique_id").toggleClass("display_show");
                break;
        }
    }
);

listenClick('.smart-patient-card-delete-btn', function (event) {
    let templateRecordId = $(event.currentTarget).attr('data-id');
    let templateRecordName = $(event.currentTarget).attr('data-name');
    deleteItem(route(samartCardDelete, templateRecordId), templateRecordName);
})

listenClick('.generate-patient-card-delete-btn', function (event) {
    let smartCardRecordId = $(event.currentTarget).attr('data-id');
    let smartCardRecordName = $(event.currentTarget).attr('data-name');
    deleteItem(route(GeneratePatientCardDelete, smartCardRecordId), smartCardRecordName + " " + Lang.get('js.patient_smart_card_deleted'));
})



//smart card table index page status

listenChange('#card_email_status, #card_phone_status ,#card_dob_status, #card_blood_group_status, #card_address_status, #card_patient_unique_id_status', function () {
    let status = $(this).prop('checked') ? 1 : 0;
    let id = $(this).data("id");
    let name = $(this).attr("name");
    $.ajax({
        type: 'PUT',
        url: route(startcardStatusRoute, id),
        data: {
            status: status,
            changefield: name
        },
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})



listenChange('.type_tem', function (event) {
    let status = $(this).val();

    $('#prescriptionPatientId').select2({
        dropdownParent: $('#add_templates_modal')
     });
    if (status == 2) {
        $('.patient_select').css('display', '');
    } else {
        $('.patient_select').css('display', 'none');
    }
})


listenChange('.card_header_color_change', function (event) {
    let status = $(this).val();
    let id = $(this).data('id');
    $.ajax({
        type: 'PUT',
        url: route(startcardStatusRoute, id),
        data: {
            status: status,
            changefield: 'header_color'
        },
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})




listenClick('.add-templates', function () {
    $('#add_templates_modal').modal('show').appendTo('body')
})

function hexToRgb(hex) {
    hex = hex.replace(/^#/, '');
    var bigint = parseInt(hex, 16);
    var r = (bigint >> 16) & 255;
    var g = (bigint >> 8) & 255;
    var b = bigint & 255;

    return [r, g, b];
}

listenClick('.show_patient_card', function () {
    $('#show_card_modal').modal('show').appendTo('body');

    let id = $(this).data('id');
    $.ajax({
        type: 'get',
        url: route(showPatientSmartCard, id),
        success: function (result) {

            var rgb = hexToRgb(result.data.smart_patient_card.header_color);
            var luminance = 0.299 * rgb[0] + 0.587 * rgb[1] + 0.114 * rgb[2];
            if (luminance > 128) {
                $('.clinic_name').addClass('color-black');
                $('.clinic_address').addClass('color-black');
            } else {
                $('.clinic_name').addClass('color-white');
                $('.clinic_address').addClass('color-white');
            }
            $('.patient-card-header').css('background-color', result.data.smart_patient_card.header_color);
            $('.patient-model-download').css('color', result.data.smart_patient_card.header_color);
            $('#card_profilePicture').attr('src',result.img);
            $('.card_name').text(result.data.user.full_name);
            $('.card_name').css('word-break', 'break-word');
            $('.patient_email').text(result.data.user.email);
            $('.patient_unique_id').text(result.data.patient_unique_id);
            $('.clinic_name').text(result.clinic_name);
            $('.clinic_address').text(result.address_one);

            if (result.data.smart_patient_card.show_email == 1) {
                $('#card_show_email').css('display', '');
                $('#card_show_email').css('word-break', 'break-word');
            } else {
                $('#card_show_email').css('display', 'none');
            }

            if (result.data.smart_patient_card.show_phone == 1) {
                $('#patient_card_show_phone').css('display', '');
            } else {
                $('#patient_card_show_phone').css('display', 'none');
            }

            if (result.data.smart_patient_card.show_dob == 1) {
                $('#patient_card_show_dob').css('display', '');
            } else {
                $('#patient_card_show_dob').css('display', 'none');
            }

            if (result.data.smart_patient_card.show_blood_group == 1) {
                $('#patient_card_show_blood_group').css('display', '');
            } else {
                $('#patient_card_show_blood_group').css('display', 'none');
            }

            if (result.data.smart_patient_card.show_address == 1) {
                $('#patient_card_show_address').css('display', '');
            } else {
                $('#patient_card_show_address').css('display', 'none');
            }



            if (result.data.address.address1 == null) {
                $('#patient_card_show_address').css('display', 'none');
            }
            else if(result.data.address.address1 != null && result.data.address.address2 != null)
            {
                $('.card_address').text(result.data.address.address1 + ',' + result.data.address.address2);
            }
            else if(result.data.address.address1 != null){
                $('.card_address').text(result.data.address.address1);
            }


            if (result.data.smart_patient_card.show_patient_unique_id == 1) {
                $('#card_show_patient_unique_id').css('display', '');
            } else {
                $('#card_show_patient_unique_id').css('display', 'none');
            }

            if(result.data.user.blood_group != null){
                $('#patient_card_show_blood_group').removeClass('d-none');
                let bloodKey = result.data.user.blood_group
                let array = JSON.parse(bloodGroupArray);
                $('.patient_blood_group').text(array[bloodKey]);
            }

            if(result.data.user.blood_group == null){
                $('#patient_card_show_blood_group').addClass('d-none');
            }
            if(result.data.user.contact != null){
                $('.patient_contact').text(result.data.user.contact);
            }else{
                $('#patient_card_show_phone').css('display', 'none');
            }

            if(result.data.user.dob != null){
                $('.patient_dob').text(result.data.user.dob);
            }else{
                $('#patient_card_show_dob').css('display', 'none');
            }

        },
    });

    $.ajax({
        type: 'get',
        url: route(smartCardQrCode, id),
        success: function (data) {
            var svgContent = data;
            $('.svgContainer').html(svgContent);
        },
        error: function () {
            alert('Failed to load QR code');
        }
    })
})




listenSubmit('#addtemplateForm', function (event) {
    event.preventDefault();
    var loadingButton = jQuery(this).find('#medicineCategorySave');
    loadingButton.button('loading');

    if ($('.generate_smart_patientcard_status2').prop('checked')) {
        if($('.generate_smart_patientcard_patient_select').val() != ""){
            $(this)[0].submit();
        }else{
            displayErrorMessage(Lang.get('js.please_selest_patient'));
        }
    }else{
        $(this)[0].submit();
    }
});

listenHiddenBsModal("#add_templates_modal", function () {
    resetModalForm("#addtemplateForm");
    $(".select_template").trigger("change");
    $(".generate_smart_patientcard_patient_select").trigger("change");
    $('.patient_select').css('display', 'none');
});


