listenSubmit('#subscribeForm', function (e) {
    e.preventDefault()
    $.ajax({
        url: route('subscribe.store'),
        type: 'POST',
        data: $(this).serialize(),
        success: function (result) {
            if (result.success) {
                $('.subscribeForm-message').append('' +
                    '<div class="gen alert alert-success">'+Lang.get("js.subscriber_creat")+'</div>').delay(5000)

                setTimeout(function () {
                    $('.subscribeForm-message').empty();
                    $('#subscribeForm')[0].reset()
                }, 3000)


            }
        },
        error: function (error) {
            $('.subscribeForm-message').append('' +
                '<div class="err alert alert-danger">'+Lang.get("js.email_already_exist")+'</div>').delay(5000)

            setTimeout(function () {
                $('.subscribeForm-message').empty();
                $('#subscribeForm')[0].reset()
            }, 3000)

        },
        complete: function () {
        },
    })
})
