listenClick('#enquiryResetFilter', function () {
    let allEnquiry = $('#allEnquiry').val();
    $('#enquiriesStatus').val(allEnquiry).trigger('change')
    hideDropdownManually($('#enquiryFilterBtn'), $('.dropdown-menu'));
})

listenChange('#enquiriesStatus', function () {
    Livewire.dispatch('changeStatusFilter', { value: $(this).val(),})
})

listenClick('.enquiry-delete-btn', function () {
    let enquiryRecordId = $(this).attr('data-id')
    deleteItem(route('enquiries.destroy', enquiryRecordId), Lang.get('js.enquiry'))
})

