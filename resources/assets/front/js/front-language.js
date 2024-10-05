listenClick('.languageSelection', function () {
    let languageName = $(this).data('prefix-value')

    $.ajax({
        type: 'POST',
        url: route('front.change.language'),
        data: { '_token': csrfToken, languageName: languageName },
        success: function () {
            location.reload()
        },
    })
})
