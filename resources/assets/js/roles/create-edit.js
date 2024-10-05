document.addEventListener('turbo:load', loadRoleData)

function loadRoleData () {
    let totalPermissionsCount = parseInt($('#totalPermissions').val() - 1);
    let checkAllLength = $('.permission:checked').length
    let roleIsEdit = $('#roleIsEdit').val();
    if (roleIsEdit == true) {
        if (checkAllLength === totalPermissionsCount) {
            $('#checkAllPermission').prop('checked', true)
        } else {
            $('#checkAllPermission').prop('checked', false)
        }
    }
}

listenClick('#checkAllPermission', function () {
    if ($('#checkAllPermission').is(':checked')) {
        $('.permission').each(function () {
            $(this).prop('checked', true)
        })
    } else {
        $('.permission').each(function () {
            $(this).prop('checked', false)
        })
    }
})

listenClick('.permission', function () {
    let checkAllLength = $('.permission:checked').length
    let totalPermissionsCount = parseInt($('#totalPermissions').val() - 1);
    if (checkAllLength === totalPermissionsCount) {
        $('#checkAllPermission').prop('checked', true)
    } else {
        $('#checkAllPermission').prop('checked', false)
    }
})
