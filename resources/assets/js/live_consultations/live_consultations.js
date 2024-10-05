// document.addEventListener('turbo:load', loadLiveConsultationDate)

Livewire.hook("element.init", () => {
   loadLiveConsultationDate();
   if ($('#doctorLiveConsultantStatus').length) {
      $('#doctorLiveConsultantStatus').select2()
   }
});

function loadLiveConsultationDate () {
    if (!$('#consultationDate').length) {
        return
    }
    let lang = $('.currentLanguage').val()
    $('#consultationDate').flatpickr({
        "locale": lang,
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    })

    if (!$('.edit-consultation-date').length) {
        return
    }

    $('.edit-consultation-date').flatpickr({
        "locale": lang,
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
    })
}

let liveConsultationTableName = '#liveConsultationTable'


listenClick('#addLiveConsultationBtn', function () {
    resetModalForm('#addNewForm')
    $('#addDoctorID').trigger('change')

    let lang = $('.currentLanguage').val();
    $('#patientName').trigger('change')
    $('#consultationDate').flatpickr({
        "locale": lang,
        enableTime: true,
        minDate: new Date(),
        dateFormat: 'Y-m-d H:i',
        disableMobile: 'true',
    })
    $('#addModal').modal('show').appendTo('body')
})

listenSubmit('#addNewForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#btnSave')
    loadingButton.button('loading')
    setAdminBtnLoader(loadingButton)
    $.ajax({
        url: route('doctors.live-consultations.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addModal').modal('hide')
                Livewire.dispatch('refresh')
                setTimeout(function () {
                    loadingButton.button('reset')
                }, 2500)
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            setTimeout(function () {
                loadingButton.button('reset')
            }, 2000)
        },
        complete: function () {
            setAdminBtnLoader(loadingButton)
        },
    })
})

listenClick('#liveConsultationResetFilter', function () {
    $('#statusArr').val(3).trigger('change')
})

listenChange('.doctorLiveConsultantStatus', function () {
    Livewire.dispatch("changeStatusFilter", { value: $(this).val(),});
})

listenSubmit('#editForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#btnEditSave')
    loadingButton.button('loading')
    setAdminBtnLoader(loadingButton)
    let id = $('#liveConsultationId').val()
    $.ajax({
        url: route('doctors.live-consultations.destroy', id),
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#editModal').modal('hide')
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
        complete: function () {
            setAdminBtnLoader(loadingButton)
            loadingButton.button('reset')
        },
    })
})

listenChange('.consultation-change-status', function (e) {
    e.preventDefault()
    let statusId = $(this).val()
    $.ajax({
        url: route('doctors.live.consultation.change.status'),
        type: 'POST',
        data: { statusId: statusId, id: $(this).attr('data-id') },
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})

listenClick('.start-btn', function (event) {
    let StartLiveConsultationId = $(event.currentTarget).attr('data-id')
    startRenderData(StartLiveConsultationId)
})

listenClick('.live-consultation-edit-btn', function (event) {
    let editLiveConsultationId = $(event.currentTarget).attr('data-id')
    editRenderData(editLiveConsultationId)
})

window.editRenderData = function (id) {
    $.ajax({
        url: route('doctors.live-consultations.edit',id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data
                $('#liveConsultationId').val(liveConsultation.id)
                $('.edit-consultation-title').val(liveConsultation.consultation_title)
                $('.edit-consultation-date').val(moment(liveConsultation.consultation_date).format('YYYY-MM-DD H:mm'))
                $('.edit-consultation-duration-minutes').val(liveConsultation.consultation_duration_minutes)
                $('.edit-patient-name').
                    val(liveConsultation.patient_id).
                    trigger('change')
                $('.edit-doctor-name').
                    val(liveConsultation.doctor_id).
                    trigger('change')
                $('.host-enable,.host-disabled').prop('checked', false)
                if (liveConsultation.host_video == true) {
                    $('.host-enable').
                        prop('checked', true).val(1)
                } else {
                    $('.host-disabled').
                    prop('checked', true).val(1)
                }
                $('.client-enable,.client-disabled').prop('checked', false)
                if (liveConsultation.participant_video == true) {
                    $('.client-enable').
                        prop('checked', true).val(1)
                } else {
                    $('.client-disabled').
                    prop('checked', true).val(1)
                }
                $('.edit-consultation-type').
                    val(liveConsultation.type).
                    trigger('change')
                $('.edit-consultation-type-number').
                    val(liveConsultation.type_number).
                    trigger('change')
                $('.edit-description').val(liveConsultation.description)
                $('#editModal').appendTo('body').modal('show')
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

window.startRenderData = function (id) {
    $.ajax({
        url: $('#doctorRole').val()
            ? route('doctors.live.consultation.get.live.status', id)
            : route('patients.live.consultation.get.live.status', id),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data
                $('#startLiveConsultationId').
                    val(liveConsultation.liveConsultation.id)
                $('.start-modal-title').text(
                    liveConsultation.liveConsultation.consultation_title)
                $('.host-name').
                    text(liveConsultation.liveConsultation.user.full_name)
                $('.date').
                    text(moment(
                        liveConsultation.liveConsultation.consultation_date).
                        format('LT') + ', ' + moment(
                        liveConsultation.liveConsultation.consultation_date).
                        format('Do MMM, Y'))
                $('.minutes').text(
                    liveConsultation.liveConsultation.consultation_duration_minutes)
                $('#startModal').find('.status').append((liveConsultation.zoomLiveData.status ===
                    'started') ? $('.status').text('Started') : $(
                    '.status').text('Awaited'))
                $('.start').attr('href', ($('#patientRole').val())
                    ? liveConsultation.liveConsultation.meta.join_url
                    : ((liveConsultation.zoomLiveData.status ===
                        'started')
                        ? $('.start').addClass('disabled')
                        : liveConsultation.liveConsultation.meta.start_url),
                )
                $('#startModal').appendTo('body').modal('show')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message);
        },
    })
}

listenClick('.live-consultation-delete-btn', function (event) {
    let liveConsultationId = $(event.currentTarget).attr('data-id')
    deleteItem(route('doctors.live-consultations.destroy',liveConsultationId), Lang.get('js.live_consultations'))
})

listenClick('.consultation-show-data', function (event) {
    let consultationId = $(event.currentTarget).attr('data-id')
    $.ajax({
        url: $('#doctorRole').val() ? route('doctors.live-consultations.show',
            consultationId) : route('patients.live-consultations.show',
            consultationId),
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let liveConsultation = result.data.liveConsultation
                let showModal = $('#showModal')
                $('#startLiveConsultationId').val(liveConsultation.id)
                $('#consultationTitle').
                    text(liveConsultation.consultation_title)
                $('#consultationDates').
                    text(moment(liveConsultation.consultation_date).
                            format('LT') + ', ' +
                        moment(liveConsultation.consultation_date).
                            format('Do MMM, Y'))
                $('#consultationDurationMinutes').
                    text(liveConsultation.consultation_duration_minutes)
                $('#consultationPatient').
                    text(liveConsultation.patient.user.full_name)
                $('#consultationDoctor').
                    text(liveConsultation.doctor.user.full_name);
                (liveConsultation.host_video === 0) ? $(
                    '#consultationHostVideo').text('Disable') : $(
                    '#consultationHostVideo').text('Enable');
                (liveConsultation.participant_video === 0) ? $(
                    '#consultationParticipantVideo').text('Disable') : $(
                    '#consultationParticipantVideo').text('Enable')
                isEmpty(liveConsultation.description) ? $(
                    '#consultationDescription').text('N/A') : $(
                    '#consultationDescription').
                    text(liveConsultation.description)
                showModal.modal('show').appendTo('body')
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
})

listenClick('#doctorLiveConsultantResetFilter', function () {
    $('#doctorLiveConsultantStatus').val(3).trigger('change')
    hideDropdownManually($('#doctorLiveConsultantFilterBtn'), $('.dropdown-menu'));
})

listenClick('.add-credential', function () {
    if ($('.ajaxCallIsRunning').val()) {
        return
    }
    ajaxCallInProgress()
    let userId = $('#zoomUserId').val()
    renderUserZoomData(userId)
})

function renderUserZoomData (id) {
    $.ajax({
        url: 'user-zoom-credential/' + id + '/fetch',
        type: 'GET',
        success: function (result) {
            if (result.success) {
                let userZoomData = result.data
                if (!isEmpty(userZoomData)) {
                    $('#zoomApiKey').val(userZoomData.zoom_api_key)
                    $('#zoomApiSecret').val(userZoomData.zoom_api_secret)
                }
                $('#addCredential').modal('show')
                ajaxCallCompleted()
            }
        },
        error: function (result) {
            manageAjaxErrors(result)
        },
    })
}

listenSubmit('#addZoomForm', function (event) {
    event.preventDefault()
    let loadingButton = jQuery(this).find('#btnZoomSave')
    loadingButton.button('loading')
    $.ajax({
        url: $('#zoomCredentialCreateUrl').val(),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addCredential').modal('hide')
                setTimeout(function () {
                    loadingButton.button('reset')
                }, 2500)
                Livewire.dispatch('refresh')
            }
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
        },
    })
})
