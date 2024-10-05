import "flatpickr/dist/l10n";
document.addEventListener('turbo:load', loadVisitData)

function loadVisitData () {
    let visitDate = '.visit-date'

    if (!$(visitDate).length) {
        return
    }
    let lang = $('.currentLanguage').val()
    $(visitDate).flatpickr({
        "locale": lang,
        disableMobile: true,
    })
}

listenSubmit('#saveForm', function (e) {
    e.preventDefault()
    $('#btnSubmit').attr('disabled', true)
    $('#saveForm')[0].submit()
})
