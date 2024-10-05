'use strict'

listenClick( '.brand-delete-btn', function (event) {
    let brandId = $(event.currentTarget).attr('data-id');
    deleteItem(route('brands.destroy', brandId), Lang.get('js.brand'));
});

listenSubmit('#createBrandForm, #editBrandForm', function () {
    if ($('#error-msg').text() !== '') {
        $('#phoneNumber').focus();
        return false;
    }
});
