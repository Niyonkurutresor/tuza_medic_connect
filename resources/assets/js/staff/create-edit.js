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

listenSubmit('#createStaffForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})

listenSubmit('#editStaffForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus()
        displayErrorMessage(Lang.get('js.contact_number') + $('#error-msg').text())
        return false
    }
})

listenClick('.removeAvatarIcon', function () {
    $('#bgImage').css('background-image', '')
    $('#bgImage').css('background-image', 'url(' + backgroundImg + ')')
    $('#removeAvatar').addClass('hide')
    $('#tooltip287851').addClass('hide')
})
