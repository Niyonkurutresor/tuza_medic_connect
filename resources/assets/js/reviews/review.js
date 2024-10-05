document.addEventListener('turbo:load', loadReviewData)

function loadReviewData () {
    let star_rating_width = $('.fill-ratings span').width()
    $('.star-ratings').width(star_rating_width)
}

listenClick('.addReviewBtn', function () {
    let reviewDoctorId = $(this).attr('data-id')
    $('#reviewDoctorId').val(reviewDoctorId)
})

listenSubmit('#addReviewForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('patients.reviews.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                $('#addReviewModal').modal('hide')
                setTimeout(function () {
                    location.reload()
                }, 1200)
            }
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
    })
})

listenClick('.editReviewBtn', function () {
    let reviewId = $(this).attr('data-id')
    $.ajax({
        url: route('patients.reviews.edit', reviewId),
        type: 'GET',
        success: function (result) {
            $('#editReviewModal').modal('show').appendTo('body')
            $('#editDoctorId').val(result.data.doctor_id)
            $('#editReviewId').val(result.data.id)
            $('#editReview').val(result.data.review)
            $('#editRating-' + result.data.rating).
                attr('checked', true)
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
    })
})

listenSubmit('#editReviewForm', function (e) {
    e.preventDefault()
    let reviewId = $('#editReviewId').val()
    $.ajax({
        url: route('patients.reviews.update', reviewId),
        type: 'PUT',
        data: $(this).serialize(),
        success: function (result) {
            displaySuccessMessage(result.message)
            $('#editReviewModal').modal('hide')
            setTimeout(function () {
                location.reload()
            }, 1200)
        },
        error: function (error) {
            displayErrorMessage(error.responseJSON.message)
        },
    })
})

listenClick('.addReviewBtn', function () {
    $('#addReviewModal').modal('show').appendTo('body')
})

listen('hidden.bs.modal', '#addReviewModal', function () {
    $('#reviewDoctorId').val('')
    resetModalForm('#addReviewForm')
})

listen('hidden.bs.modal', '#editReviewModal', function () {
    $('#editDoctorId').val('')
    resetModalForm('#editReviewForm')
})
