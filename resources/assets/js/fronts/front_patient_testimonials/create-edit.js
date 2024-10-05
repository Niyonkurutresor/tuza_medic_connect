document.addEventListener('turbo:load', loadFrontTestimonialData)

function loadFrontTestimonialData () {
    if (!$('#shortDescription').length) {
        return
    }

    $('#shortDescription').on('keyup', function () {
        $('#shortDescription').attr('maxlength', 111)
    })
}
