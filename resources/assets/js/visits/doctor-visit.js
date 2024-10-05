listenClick('.doctor-visit-delete-btn', function (event) {
    let visitDoctorRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('doctors.visits.destroy', visitDoctorRecordId), Lang.get('js.visits'))
})
