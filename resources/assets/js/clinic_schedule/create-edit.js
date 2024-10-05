listenSubmit('#clinicScheduleSaveForm', function (e) {
    e.preventDefault()
    let data = new FormData($(this)[0])
    $.ajax({
        url: route('checkRecord'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            saveUpdateForm(data)
        },
        error: function (result) {
            swal({
                title: Lang.get('js.deleted'),
                text: result.responseJSON.message,
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                closeOnConfirm: true,
                confirmButtonColor: '#266CB0',
                showLoaderOnConfirm: true,
                cancelButtonText: Lang.get('js.no'),
                confirmButtonText: Lang.get('js.yes_update'),
            }).then(function (result) {
                if (result) {
                    saveUpdateForm(data)
                }
            })
        },
    })
})

function saveUpdateForm (data) {
    $.ajax({
        url: route('clinic-schedules.store'),
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                setTimeout(function () {
                    location.reload()
                }, 1500)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
        },
    })
}

listenChange('select[name^="clinicStartTimes"]', function (e) {
    let selectedIndex = $(this)[0].selectedIndex
    let endTimeOptions = $(this).closest('.weekly-row').find('select[name^="clinicEndTimes"] option')
    endTimeOptions.eq(selectedIndex + 1).prop('selected', true).trigger('change')
    endTimeOptions.each(function (index) {
        if (index <= selectedIndex) {
            $(this).attr('disabled', true)
        } else {
            $(this).attr('disabled', false)
        }
    })
})
