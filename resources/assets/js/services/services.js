
listenClick('#serviceResetFilter', function () {
    $('#servicesStatus').val($('#allServices').val()).trigger('change')
})

listenChange('#servicesStatus', function () {
    Livewire.dispatch('changeStatusFilter', $(this).val())
})

listenClick('.service-delete-btn', function (event) {
    let serviceRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('services.destroy', serviceRecordId), Lang.get('js.service'))
})

listenClick('.service-statusbar', function (event) {
    let recordId = $(event.currentTarget).attr('data-id')

    $.ajax({
        type: 'PUT',
        url: route('service.status'),
        data: { id: recordId },
        success: function (result) {
            displaySuccessMessage(result.message)
        },
    })
})

