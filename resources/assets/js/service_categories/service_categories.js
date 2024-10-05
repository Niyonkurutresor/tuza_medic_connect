
listenClick('#createServiceCategory', function () {
    $('#createServiceCategoryPageModal').modal('show').appendTo('body')
})

listen('hidden.bs.modal', '#createServiceCategoryPageModal', function () {
    resetModalForm('#createServiceCategoryForm',
        '#createServiceCategoryValidationErrorsBox')
})

listen('hidden.bs.modal', '#editServiceCategoryModal', function () {
    resetModalForm('#editServiceCategoryForm',
        '#editServiceCategoryValidationErrorsBox')
})

listenClick('.service-category-edit-btn', function (event) {
    let editServiceCategoryId = $(event.currentTarget).attr('data-id')
    renderData(editServiceCategoryId)
})

function renderData (id) {
    $.ajax({
        url: route('service-categories.edit', id),
        type: 'GET',
        success: function (result) {
            $('#serviceCategoryID').val(result.data.id)
            $('#editServiceCategoryName').val(result.data.name)
            $('#editServiceCategoryModal').modal('show')
        },
    })
}

listenSubmit('#createServiceCategoryForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('service-categories.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                Livewire.dispatch('refresh')
                $('#createServiceCategoryPageModal').modal('hide')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenSubmit('#editServiceCategoryForm', function (e) {
    e.preventDefault()
    let updateServiceCategoryId = $('#serviceCategoryID').val()
    $.ajax({
        url: route('service-categories.update', updateServiceCategoryId),
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            $('#editServiceCategoryModal').modal('hide')
            displaySuccessMessage(result.message)
            Livewire.dispatch('refresh')
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.service-category-delete-btn', function (event) {
    let serviceCategoryRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('service-categories.destroy', serviceCategoryRecordId),
        Lang.get('js.service_category'))
})
