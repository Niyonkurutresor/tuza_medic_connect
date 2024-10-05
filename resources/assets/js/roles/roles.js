listenClick('.role-delete-btn', function (event) {
    let roleRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('roles.destroy', roleRecordId),  Lang.get('js.roles'))
})
