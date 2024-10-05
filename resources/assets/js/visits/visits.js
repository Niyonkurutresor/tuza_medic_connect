listenClick('.visit-delete-btn', function (event) {
    let visitRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('visits.destroy', visitRecordId), Lang.get('js.visits'))
})
