listenClick('.faq-delete-btn', function (event) {
    let faqRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('faqs.destroy', faqRecordId), Lang.get('js.faqs'))
})

listenClick('.accordion-button', function (event) {
    let tohide =$(this).attr("data-bs-target");

    if(!$(this).hasClass('custom-class'))
    {
        $(this).addClass('custom-class')
        $(tohide).addClass('show');
        $(tohide).removeClass('hide')
        $(this).attr("aria-expanded","true")


    }else{

        $(this).attr("aria-expanded","false")
        $(this).addClass('collapsed')
        $(tohide).removeClass('show')
        $(tohide).addClass('hide');
        $(this).removeClass('custom-class')
        $(this).css("box-shadow","none")
    }

})
