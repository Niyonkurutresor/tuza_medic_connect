listenClick('#changePassword', function () {
    $('#changePasswordForm')[0].reset()
    $('.pass-check-meter div.flex-grow-1').removeClass('active')
    $('#changePasswordModal').modal('show').appendTo('body')
})

listenClick('#changeLanguage', function () {
    $('#changeLanguageModal').modal('show').appendTo('body')
})

listenClick('#passwordChangeBtn', function () {
    $.ajax({
        url: changePasswordUrl,
        type: 'PUT',
        data: $('#changePasswordForm').serialize(),
        success: function (result) {
            $('#changePasswordModal').modal('hide')
            $('#changePasswordForm')[0].reset()
            displaySuccessMessage(result.message)
            setTimeout(function () {
                location.reload()
            }, 1000)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

window.printErrorMessage = function (selector, errorResult) {
    $(selector).show().html('')
    $(selector).text(errorResult.message)
}

listenClick('#emailNotification', function () {
    $('#emailNotificationModal').modal('show').appendTo('body')
    if($('#emailNotificationForm').length){
        $('#emailNotificationForm')[0].reset();
    }
})

listenClick('#emailNotificationChange', function () {
    $.ajax({
        url: route('emailNotification'),
        type: 'PUT',
        data: $('#emailNotificationForm').serialize(),
        success: function (result) {
            $('#emailNotificationModal').modal('hide')
            displaySuccessMessage(result.message)
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#languageChangeBtn', function() {
    $.ajax({
        url: updateLanguageURL,
        type: 'POST',
        data: $('#changeLanguageForm').serialize(),
        success: function (result) {
            $('#changeLanguageModal').modal('hide');
            displaySuccessMessage(result.message);
            Turbo.visit(window.location.href);
        },
        error: function error (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    });
});
