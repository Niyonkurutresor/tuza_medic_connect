listenClick('.front-testimonial-delete-btn', function (event) {
    let testimonialRecordId = $(event.currentTarget).attr('data-id')
    deleteItem(route('front-patient-testimonials.destroy', testimonialRecordId),
        Lang.get('js.front_patient_testimonials'))
})
