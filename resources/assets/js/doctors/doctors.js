listenClick('#doctorResetFilter', function () {
  let  firstDate = moment(moment().startOf('week'), "MM/DD/YYYY").day(0).format("MM/DD/YYYY");
  let  lastDate =  moment(moment().endOf('week'), "MM/DD/YYYY").day(6).format("MM/DD/YYYY");

    $('#doctorPanelAppointmentDate').val(firstDate + " - " + lastDate).trigger('change')
    $('#doctorPanelPaymentType').val(0).trigger('change')
    $('#doctorPanelAppointmentStatus').val(3).trigger('change')
    $('#doctorStatus').val(2).trigger('change')
    hideDropdownManually($('#doctorFilterBtn'), $('.dropdown-menu'));
})

listenChange('#doctorStatus', function () {
    Livewire.dispatch("changeStatusFilter", { value: $(this).val(),});
})

Livewire.hook("element.init", () => {
   if ($('#doctorStatus').length) {
      $('#doctorStatus').select2()
  }
});

listenClick('.doctor-delete-btn', function () {
    let userId = $(this).attr('data-id')
    let deleteUserUrl = route('doctors.destroy', userId)
    deleteItem(deleteUserUrl, Lang.get('js.doctor'))
})

listenClick('.add-qualification', function () {
    let userId = $(this).attr('data-id')
    $('#qualificationID').val(userId)
    $('#qualificationModal').modal('show')
})

listenSubmit('#qualificationForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('add.qualification'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#year').val(null).trigger('change')
                $('#qualificationModal').modal('hide')
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listen('hidden.bs.modal', '#qualificationModal', function () {
    resetModalForm('#qualificationForm')
    $('#year').val(null).trigger('change')
})

listenClick('.doctor-status', function (event) {
    let doctorRecordId = $(event.currentTarget).attr('data-id')

    $.ajax({
        type: 'PUT',
        url: route('doctor.status'),
        data: { id: doctorRecordId },
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})

listenClick('.doctor-email-verification', function (event) {
    let userId = $(event.currentTarget).attr('data-id')
    $.ajax({
        type: 'POST',
        url: route('resend.email.verification', userId),
        success: function (result) {
            displaySuccessMessage(result.message)
            setTimeout(function () {
                Turbo.visit(window.location.href);
            }, 5000);
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('#qualificationSaveBtn',function(){
    $('#qualificationForm').trigger('submit');
})

listenChange('.doctor-email-verified', function (e) {
    let recordId = $(e.currentTarget).attr('data-id')
    let value = $(this).is(':checked') ? 1 : 0
    $.ajax({
        type: 'POST',
        url: route('emailVerified'),
        data: {
            id: recordId,
            value: value,
        },
        success: function (result) {
            Livewire.dispatch('refresh')
            displaySuccessMessage(result.message)
        },
    })
})
Livewire.hook("element.init", () => {
    if ($('#enquiriesStatus').length) {
       $('#enquiriesStatus').select2()
   }
 });