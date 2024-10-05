listenClick('.staff-delete-btn', function (event) {
    let staffRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('staffs.destroy', staffRecordId), Lang.get('js.staff'))
})

listenChange('.staff-email-verified', function (e) {
    let verifyRecordId = $(e.currentTarget).attr('data-id')
    let value = $(this).is(':checked') ? 1 : 0
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: verifyRecordId,
            value: value,
        },
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.staff-email-verification', function (event) {
    let staffVerifyId = $(event.currentTarget).attr('data-id')
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', staffVerifyId),
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
