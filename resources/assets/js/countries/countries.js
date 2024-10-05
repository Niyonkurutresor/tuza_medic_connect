listenClick('.country-delete-btn', function (event) {
    let countryRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('countries.destroy', countryRecordId),
        Lang.get('js.country'))
})

listenClick('#addCountry', function () {
    $('#addCountryModal').modal('show').appendTo('body')
})

listenSubmit('#addCountryForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('countries.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addCountryModal').modal('hide')
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.country-edit-btn', function (event) {
    $('#editCountryModal').modal('show').appendTo('body')
    let editCountryId = $(event.currentTarget).attr('data-id')
    $('#editCountryId').val(editCountryId)

    $.ajax({
        url: route('countries.edit', editCountryId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                $('#editCountryName').val(result.data.name)
                $('#editShortCodeName').val(result.data.short_code)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenSubmit('#editCountryForm', function (event) {
    event.preventDefault()
    let updateCountryId = $('#editCountryId').val()

    $.ajax({
        url: route('countries.update', updateCountryId),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editCountryModal').modal('hide')
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('hidden.bs.modal', '#addCountryModal', function (e) {
    $('#addCountryForm')[0].reset()
})
