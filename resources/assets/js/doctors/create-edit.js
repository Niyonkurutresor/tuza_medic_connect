import 'flatpickr/dist/l10n'

document.addEventListener('turbo:load', loadDoctorData)

let isDefault = false
let deletedQualifications = []
let degree
let university
let year
let updateId
let primaryId
let qualification = []
let id = 1
$('.showQualification').hide()

function loadDoctorData () {
    loadDoctorDate()
}

function loadDoctorDate () {
    let doctorDob = '.doctor-dob'
    let lang = $('.currentLanguage').val()
    $('.showQualification').slideUp();

    if (!$(doctorDob).length) {
        return
    }

    $(doctorDob).flatpickr({
        "locale": lang,
        maxDate: new Date(),
        disableMobile: true,
    })

    if (!$('#doctorCountryId').val()) {
        return;
    }
    $('#editDoctorCountryId').val($('#doctorCountryId').val()).trigger('change')

    setTimeout(function () {
        $('#editDoctorStateId').val($('#doctorStateId').val()).trigger('change')
    }, 400)

    setTimeout(function () {
        $('#editDoctorCityId').val($('#doctorCityId').val()).trigger('change')
    }, 7000)
}

listenClick('#addQualification', function () {
    isDefault = false
    $('.degree').val('')
    $('.university').val('')
    $('.year').val('').trigger('change')
    $('.showQualification').slideToggle(500)
})

listenClick('#cancelQualification', function () {
    $('.showQualification').slideUp(500)
})

listenClick('#ResetForm', function (){
   window.location.href =  route('doctors.index')
})

listenClick('#saveQualification', function (e) {
    e.preventDefault()
    degree = $('.degree').val()
    university = $('.university').val()
    year = $('.year').val()
    let existId = $('#doctorQualificationTbl tr:last-child td:first-child').data('value')
    existId++
    if (existId) {
        id = existId
    }
    let prepareData = {
        'id': primaryId,
        'degree': degree,
        'year': year,
        'university': university,
    }
    let data = {
        'id': id,
        'degree': degree,
        'year': year,
        'university': university,
    }
    let emptyDegree = $('.degree').val().trim().replace(/ \r\n\t/g, '') ===
        ''
    let emptyUniversity = $('.university').
        val().
        trim().
        replace(/ \r\n\t/g, '') === ''
    let emptyYear = $('.year').val().trim().replace(/ \r\n\t/g, '') === ''
    if (emptyDegree) {
        displayErrorMessage(Lang.get('js.degree_required'))
        return false
    } else if (emptyUniversity) {
        displayErrorMessage(Lang.get('js.university_required'))
        return false
    } else if (emptyYear) {
        displayErrorMessage(Lang.get('js.year_required'))
        return false
    }
    if (updateId == null) {
        qualification.push(prepareData)
    } else {
        qualification[updateId - 1] = prepareData
    }
    let qualificationHtml = prepareTemplateRender(
        '#qualificationTemplateData', data)
    if (isDefault == false) {
        $('tbody').append(qualificationHtml)
        id++
    } else if (isDefault == true) {
        let data = {
            'id': updateId,
            'degree': degree,
            'year': year,
            'university': university,
        }
        let updateQualificationHtml = prepareTemplateRender(
            '#qualificationTemplateData', data)
        let table = $('table tbody')
        $(table).find('tr').each(function (i, v) {
            i = i + 1
            if (i == updateId) {
                $('tbody').find(v).replaceWith(updateQualificationHtml)
            }
        })
    }
    $('.showQualification').slideUp(500)
    $('.degree').val('')
    $('.university').val('')
    $('.year').val('')
})

listenClick('.delete-btn-qualification', function (event) {
    $('.degree').val('')
    $('.university').val('')
    $('.year').val('').trigger('change')
    qualification.pop([0])
    $('.showQualification').slideUp(500)

    let Ele = $(this)
    let qualificationID = $(this).attr('data-id')
    let header = Lang.get('js.qualification')
    swal({
        title: Lang.get('js.delete') + ' !',
        text: Lang.get('js.are_you_sure') + ' "' + header + '" ?',
        buttons: {
            confirm: Lang.get('js.yes'),
            cancel: Lang.get('js.no'),

        },
        reverseButtons: true,
        icon: 'warning',
    }).then(function (result) {
        if(result == true){
            deletedQualifications.push(qualificationID)
            $('#deletedQualifications').val(deletedQualifications)
            Ele.closest('tr')[0].remove()
            swal({
                icon: 'success',
                title: Lang.get('js.deleted'),
                text: header + Lang.get('js.has_been'),
                timer: 2000,
            })
        }
    });
})

listenClick('.edit-btn-qualification', function () {
    $('.degree').val('')
    $('.university').val('')
    $('.year').val('')
    updateId = $(this).attr('data-id')
    primaryId = $(this).data('primary-id')
    let currentRow = $(this).closest('tr')
    let currentDegree = currentRow.find('td:eq(1)').text()
    let currentCollage = currentRow.find('td:eq(2)').text()
    let currentYear = currentRow.find('td:eq(3)').text()
    $('.degree').val(currentDegree)
    $('.university').val(currentCollage)
    $('.year').val(currentYear).trigger('change')
    isDefault = true
    $('.showQualification').slideToggle(500)
})

listenSubmit('#editDoctorForm', function (e) {
    let twitterUrl = $('#twitterUrl').val()
    let linkedinUrl = $('#linkedinUrl').val()
    let instagramUrl = $('#instagramUrl').val()
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter.[a-z]{2,3}\/?.*/i)
    let linkedinExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i)
    let instagramExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i)

    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(
        twitterExp) ? true : false))
    if (!twitterCheck) {
        displayErrorMessage(Lang.get('js.valid_twitter'))
        return false
    }

    let linkedInCheck = (linkedinUrl == '' ? true : (linkedinUrl.match(
        linkedinExp) ? true : false))
    if (!linkedInCheck) {
        displayErrorMessage(Lang.get('js.valid_linkedin'))
        return false
    }

    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramExp) ? true : false))
    if (!instagramCheck) {
        displayErrorMessage(Lang.get('js.valid_instagram'))
        return false
    }

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
    e.preventDefault()
    let doctorFormData = new FormData($(this)[0]);
    let editDoctorId = $('#editDoctorId').val();

    doctorFormData.append('qualifications', JSON.stringify(qualification))
    $.ajax({
        url: route('doctors.update', editDoctorId),
        type: 'POST',
        data: doctorFormData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.success) {
                window.location.href = route('doctors.index')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

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

listenChange('#editDoctorCountryId', function () {
    let doctorIsEdit = $('#doctorIsEdit').val();
    $.ajax({
        url: route('get-state'),
        type: 'get',
        dataType: 'json',
        data: {data: $(this).val()},
        success: function (data) {
            $('#editDoctorStateId').empty()
            $('#editDoctorCityId').empty()
            //
            $('#editDoctorStateId').append(
                $('<option value=""></option>').text(Lang.get('js.select_state')))
            $('#editDoctorCityId').append(
                $('<option value=""></option>').text(Lang.get('js.select_city')))
            $.each(data.data, function (i, v) {
                $('#editDoctorStateId').append($('<option></option>').attr('value', i).text(v))
            })
            if (doctorIsEdit && $('#doctorStateId').val()) {
                $('#stateId').val($('#doctorStateId').val()).trigger('change')
            }
        },
    })
})

listenChange('#editDoctorStateId', function () {
    let doctorIsEdit = $('#doctorIsEdit').val();
    $.ajax({
        url: route('get-city'),
        type: 'get',
        dataType: 'json',
        data: {
            state: $(this).val(),
            country: $('#editDoctorCountryId').val(),
        },
        success: function (data) {
            $('#editDoctorCityId').empty()
            $('#editDoctorCityId').append(
                $('<option value=""></option>').text(Lang.get('js.select_city')))
            $.each(data.data, function (i, v) {
                $('#editDoctorCityId').append(
                    $('<option ></option>').attr('value', i).text(v))
            })
            if (doctorIsEdit && $('#doctorCityId').val()) {
                $('#cityId').val($('#doctorCityId').val()).trigger('change')
            }
        },
    })
})

if ($('#doctorIsEdit').val() && $('#doctorCountryId').val()) {
    $('#editDoctorCountryId').val($('#doctorCountryId').val()).trigger('change')
}

listenKeyup('#twitterUrl', function () {
    this.value = this.value.toLowerCase()
})

listenKeyup('#linkedinUrl', function () {
    this.value = this.value.toLowerCase()
})

listenKeyup('#instagramUrl', function () {
    this.value = this.value.toLowerCase()
})

listenSubmit('#createDoctorForm', function () {
    let twitterUrl = $('#twitterUrl').val()
    let linkedinUrl = $('#linkedinUrl').val()
    let instagramUrl = $('#instagramUrl').val()
    let twitterExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)twitter.[a-z]{2,3}\/?.*/i)
    let linkedinExp = new RegExp(
        /^(https?:\/\/)?((w{2,3}\.)?)linkedin\.[a-z]{2,3}\/?.*/i)
    let instagramExp = new RegExp(
        /^(https?:\/\/)?((m{1}\.)?)?((w{2,3}\.)?)instagram.[a-z]{2,3}\/?.*/i)

    let twitterCheck = (twitterUrl == '' ? true : (twitterUrl.match(
        twitterExp) ? true : false))
    if (!twitterCheck) {
        displayErrorMessage(Lang.get('js.valid_twitter'))
        return false
    }

    let linkedInCheck = (linkedinUrl == '' ? true : (linkedinUrl.match(
        linkedinExp) ? true : false))
    if (!linkedInCheck) {
        displayErrorMessage(Lang.get('js.valid_linkedin'))
        return false
    }

    let instagramCheck = (instagramUrl == '' ? true : (instagramUrl.match(
        instagramExp) ? true : false))
    if (!instagramCheck) {
        displayErrorMessage(Lang.get('js.valid_instagram'))
        return false
    }

    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})

listenClick('.removeAvatarIcon', function () {
    $('#bgImage').css('background-image', '')
    $('#bgImage').css('background-image', 'url(' + backgroundImg + ')')
    $('#removeAvatar').remove()
})
