import "flatpickr/dist/l10n";
document.addEventListener('turbo:load', loadPatientData)

function loadPatientData () {
    loadPatientDob()
    loadPatientCountry()
    loadPatientprofileCountry()
}

function loadPatientDob () {
    let patientDob = '.patient-dob'
    let lang = $('.currentLanguage').val()
    if (!$(patientDob).length) {
        return
    }

    $(patientDob).flatpickr({
        "locale": lang,
        maxDate: new Date(),
        disableMobile: true,
    })
}

function loadPatientCountry () {
    if (!$('#editPatientCountryId').length) {
        return
    }

    $('#patientCountryId').val($('#editPatientCountryId').val()).trigger('change')

    setTimeout(function () {
        $('#patientStateId').val($('#editPatientStateId').val()).trigger('change')
    }, 400)

    setTimeout(function () {
        $('#patientCityId').val($('#editPatientCityId').val()).trigger('change')
    }, 700)
}

function loadPatientprofileCountry () {
    if (!$('#editPatientProfileCountryId').length) {
        return
    }

    $('#patientProfileCountryId').val($('#editPatientProfileCountryId').val()).trigger('change')

    setTimeout(function () {
        $('#patientProfileStateId').val($('#editPatientProfileStateId').val()).trigger('change')
    }, 400)

    setTimeout(function () {
        $('#patientProfileCityId').val($('#editPatientProfileCityId').val()).trigger('change')
    }, 700)
}

listenChange('input[type=radio][name=gender]', function () {
    let file = $('#profilePicture').val()
    if (isEmpty(file)) {
        if (this.value == 1) {
            $('.image-input-wrapper').
                attr('style', 'background-image:url(' + manAvatar + ')')
        } else if (this.value == 2) {
            $('.image-input-wrapper').
                attr('style', 'background-image:url(' + womanAvatar + ')')
        }
    }
})

listenChange('#patientCountryId', function () {
    $('#patientStateId').empty()
    $('#patientCityId').empty()
    $.ajax({
        url: route('get-state'),
        type: 'get',
        dataType: 'json',
        data: {data: $(this).val()},
        success: function (data) {
            $('#patientStateId').empty()
            $('#patientCityId').empty()
            $('#patientStateId').append(
                $('<option value=""></option>').text('Select State'))
            $('#patientCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data, function (i, v) {
                $('#patientStateId').append($('<option></option>').attr('value', i).text(v))
            })
        },
    })
})

listenChange('#patientProfileCountryId', function () {
    $('#patientProfileStateId').empty()
    $('#patientProfileCityId').empty()
    $.ajax({
        url: route('get-state'),
        type: 'get',
        dataType: 'json',
        data: {data: $(this).val()},
        success: function (data) {
            $('#patientProfileStateId').empty()
            $('#patientProfileCityId').empty()
            $('#patientProfileStateId').append(
                $('<option value=""></option>').text('Select State'))
            $('#patientProfileCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data, function (i, v) {
                $('#patientProfileStateId').append($('<option></option>').attr('value', i).text(v))
            })
        },
    })
})

listenChange('#patientProfileStateId', function () {
    $('#patientProfileCityId').empty()
    $.ajax({
        url: route('get-city'),
        type: 'get',
        dataType: 'json',
        data: {state: $(this).val()},
        success: function (data) {
            $('#patientProfileCityId').empty()
            $('#patientProfileCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data, function (i, v) {
                $('#patientProfileCityId').append($('<option></option>').attr('value', i).text(v))
            })
            if ($('#patientProfileIsEdit').val() && $('#editPatientProfileCityId').val()) {
                $('#patientProfileCityId').val($('#editPatientProfileCityId').val()).trigger('change')
            }
        },
    })
})

listenChange('#patientStateId', function () {
    $('#patientCityId').empty()
    $.ajax({
        url: route('get-city'),
        type: 'get',
        dataType: 'json',
        data: {state: $(this).val()},
        success: function (data) {
            $('#patientCityId').empty()
            $('#patientCityId').append(
                $('<option value=""></option>').text('Select City'))
            $.each(data.data, function (i, v) {
                $('#patientCityId').append($('<option></option>').attr('value', i).text(v))
            })
            if ($('#patientIsEdit').val() && $('#editPatientCityId').val()) {
                $('#patientCityId').val($('#editPatientCityId').val()).trigger('change')
            }
        },
    })
})

listenSubmit('#createPatientForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})

listenSubmit('#editPatientForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})

listenClick('.removeAvatarIcon', function () {
    let backgroundImg = $('#patientBackgroundImg').val()
    $('#bgImage').css('background-image', '')
    $('#bgImage').css('background-image', 'url(' + backgroundImg + ')')
    $('#removeAvatar').addClass('hide')
    $('#tooltip287851').addClass('hide')
})
