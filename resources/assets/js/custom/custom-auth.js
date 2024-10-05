window.isEmpty = (value) => {
    return value === undefined || value === null || value === '';
};

$(document).on('click', '.change-type', function (e) {
    let inputField = $(this).siblings()
    let oldType = inputField.attr('type')
    let type = !isEmpty(oldType) ? oldType : 'password'
    if (type == 'password') {
        $(this).children().addClass('fa-eye')
        $(this).children().removeClass('fa-eye-slash')
        inputField.attr('type', 'text')
    } else {
        $(this).children().removeClass('fa-eye')
        $(this).children().addClass('fa-eye-slash')
        inputField.attr('type', 'password')
    }
})
