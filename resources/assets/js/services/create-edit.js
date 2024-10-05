document.addEventListener('turbo:load', loadServiceData)

function loadServiceData () {

    if (!$('.price-input').length) {
        return
    }
    let price = $('.price-input').val()
    if (price === '') {
        $('.price-input').val('')
    } else {
        if (/[0-9]+(,[0-9]+)*$/.test(price)) {
            $('.price-input').val(getFormattedPrice(price))
            return true
        } else {
            $('.price-input').val(price.replace(/[^0-9 \,]/, ''))
        }
    }

}

listenClick('#createServiceCategory', function () {
    $('#serviceCreateServiceCategoryModal').modal('show').appendTo('body')
})

listenSubmit('#serviceCreateServiceCategoryForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('service-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#serviceCreateServiceCategoryModal').modal('hide')
                let data = {
                    id: result.data.id,
                    name: result.data.name,
                }

                let newOption = new Option(data.name, data.id, false, true)
                $('#serviceCategory').append(newOption).trigger('change')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            processingBtn('#serviceCreateServiceCategoryForm', '#btnSave')
        },
    })
})

listen('hidden.bs.modal', '#serviceCreateServiceCategoryModal', function () {
    resetModalForm('#serviceCreateServiceCategoryForm',
        '#createServiceCategoryValidationErrorsBox')
})
