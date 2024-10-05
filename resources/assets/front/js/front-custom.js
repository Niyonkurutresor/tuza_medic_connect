document.addEventListener('turbo:load', loadFrontData)

function loadFrontData () {
    frontAlertInitialize()
    loadFrontSlider()
    loadScroll()

}

function frontAlertInitialize () {
    $('.alert').delay(5000).slideUp(300)
}

function loadFrontSlider () {

    $('.services-carousel').slick({
        dots: false,
        centerPadding: '0',
        slidesToShow: 1,
        slidesToScroll: 1,
    })
    $('.testimonial-carousel').slick({
        dots: true,
        centerPadding: '0',
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                },
            },
        ],
    })
}
function loadScroll () {
    $(window).scroll(function(){
        var sticky = $('.header'),
            scroll = $(window).scrollTop();
        if (scroll >= 50) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });
}
