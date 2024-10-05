const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//copy folder
mix.copyDirectory('resources/assets/images', 'public/assets/image');
mix.copyDirectory('resources/assets/front/vendor/font-awesome/webfonts',
    'public/assets/webfonts');
mix.copyDirectory('public/web/plugins/global/fonts', 'public/assets/css/fonts');
mix.copyDirectory('node_modules/intl-tel-input/build/img', 'public/assets/img');

mix.copy(
    'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
    'public/assets/css/bootstrap-datepicker/bootstrap-datepicker.css');

mix.styles('node_modules/intl-tel-input/build/css/intlTelInput.css', 'public/assets/css/intlTelInput.css');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    'public/assets/js/bootstrap-datepicker/bootstrap-datepicker.js');

// third-party css
mix.styles([
    'resources/theme/css/third-party.css',
    'node_modules/intl-tel-input/build/css/intlTelInput.css',
    'node_modules/quill/dist/quill.snow.css',
    'node_modules/quill/dist/quill.bubble.css',
], 'public/assets/css/third-party.css')

// light theme css
mix.styles('resources/theme/css/style.css', 'public/assets/css/style.css');
mix.styles('resources/theme/css/plugins.css', 'public/css/plugins.css');

// dark theme css
mix.styles('resources/theme/css/style.dark.css', 'public/assets/css/style-dark.css');
mix.styles('resources/theme/css/plugins.dark.css', 'public/css/plugins.dark.css');
mix.sass('resources/assets/scss/custom-pages-dark.scss', 'public/assets/css/custom-pages-dark.css').version()

// page css
mix.sass('resources/assets/scss/pages.scss', 'public/assets/css/pages.css').version()
mix.sass(
    "resources/assets/scss/bill-pdf.scss",
    "public/assets/css/bill-pdf.css"
).version();
mix.sass(
    'resources/assets/scss/prescription-pdf.scss',
    'public/assets/css/prescription-pdf.css'
).version();

mix.copy('node_modules/datatables/media/images', 'public/assets/images');

mix.copyDirectory('resources/assets/front', 'public/assets/front');

//backend third-party js
mix.scripts([
    'resources/theme/js/vendor.js',
    'resources/theme/js/plugins.js',
    'public/messages.js',
    'node_modules/apexcharts/dist/apexcharts.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/quill/dist/quill.js',
], 'public/js/third-party.js')


//backend page js
mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/custom/helper.js',
    'resources/assets/js/custom/custom.js',
    'resources/assets/js/custom/input_price_format.js',
    'resources/assets/js/custom/sidebar_menu.js',
    'resources/assets/js/profile/create-edit.js',
    'resources/assets/js/doctors/doctors.js',
    'resources/assets/js/doctors/create-edit.js',
    'resources/assets/js/doctors/detail.js',
    'resources/assets/js/patients/detail.js',
    'resources/assets/js/patients/doctor-patient-appointment.js',
    'resources/assets/js/users/user-profile.js',
    'resources/assets/js/patients/patients.js',
    'resources/assets/js/patients/create-edit.js',
    'resources/assets/js/countries/countries.js',
    'resources/assets/js/states/states.js',
    'resources/assets/js/cities/cities.js',
    'resources/assets/js/doctor_sessions/doctor_sessions.js',
    'resources/assets/js/doctor_sessions/create-edit.js',
    'resources/assets/js/service_categories/service_categories.js',
    'resources/assets/js/specializations/specializations.js',
    'resources/assets/js/roles/roles.js',
    'resources/assets/js/roles/create-edit.js',
    'resources/assets/js/settings/settings.js',
    'resources/assets/js/services/services.js',
    'resources/assets/js/services/create-edit.js',
    'resources/assets/js/appointments/appointments.js',
    'resources/assets/js/appointments/patient-appointments.js',
    'resources/assets/js/appointments/create-edit.js',
    'resources/assets/js/staff/staff.js',
    'resources/assets/js/smart_patient_cards/smart_patient_cards.js',
    'resources/assets/js/staff/create-edit.js',
    'resources/assets/js/dashboard/dashboard.js',
    'resources/assets/js/dashboard/doctor-dashboard.js',
    'resources/assets/js/doctor_appointments/doctor_appointments.js',
    'resources/assets/js/doctor_appointments/calendar.js',
    'resources/assets/js/appointments/patient-calendar.js',
    'resources/assets/js/appointments/calendar.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/currencies/currencies.js',
    'resources/assets/js/visits/visits.js',
    'resources/assets/js/visits/create-edit.js',
    'resources/assets/js/visits/doctor-visit.js',
    'resources/assets/js/clinic_schedule/create-edit.js',
    'resources/assets/js/visits/show-page.js',
    'resources/assets/js/fronts/sliders/slider.js',
    'resources/assets/js/fronts/sliders/create-edit-slider.js',
    'resources/assets/js/fronts/medical-contact/enquiry.js',
    'resources/assets/js/fronts/subscribers/create.js',
    'resources/assets/js/fronts/faqs/faqs.js',
    'resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js',
    'resources/assets/js/fronts/front_patient_testimonials/create-edit.js',
    'resources/assets/js/fronts/enquiries/enquiry.js',
    'resources/assets/js/fronts/subscribers/subscriber.js',
    'resources/assets/js/fronts/cms/create.js',
    'resources/assets/js/fronts/appointments/book_appointment.js',
    'resources/assets/js/patient_visits/patient-visit.js',
    'resources/assets/js/transactions/transactions.js',
    'resources/assets/js/transactions/patient-transactions.js',
    'resources/assets/js/fronts/front_home/front-home.js',
    'resources/assets/js/google_calendar/google_calendar.js',
    'resources/assets/js/reviews/review.js',
    'resources/assets/front/js/front-language.js',
    'resources/assets/js/custom/create-account.js',
    'resources/assets/js/live_consultations/live_consultations.js',
    'resources/assets/js/doctor_holiday/doctor_holiday.js',
    "resources/assets/js/doctor_holiday/holiday.js",
    "resources/assets/js/doctor_holiday/Create_edit.js",
    'resources/assets/js/category/category.js',
    'resources/assets/js/brands/brands.js',
    'resources/assets/js/medicines/medicines.js',
    'resources/assets/js/purchase-medicine/purchase-medicine.js',
    'resources/assets/js/medicine_bills/medicine_bill.js',
    'resources/assets/js/prescriptions/create-edit.js',
    'resources/assets/js/prescriptions/prescriptions.js',
], 'public/js/pages.js');


//front third-party js
mix.scripts([
    'resources/theme/js/vendor.js',
    'resources/theme/js/plugins.js',
    'public/messages.js',
    'public/assets/front/vendor/jquery.min.js',
    'public/assets/front/vendor/magnific-popup/jquery.magnific-popup.js',
    'public/assets/front/vendor/bootstrap.bundle.min.js',
    'public/assets/front/vendor/bootstrap-select/js/bootstrap-select.min.js',
    'public/assets/js/bootstrap-datepicker/bootstrap-datepicker.js',
    'public/assets/front/vendor/slick.min.js',
    'public/assets/front/js/contact.js',
    'public/assets/js/custom/helper.js',
    'node_modules/intl-tel-input/build/js/utils.js',
    'node_modules/intl-tel-input/build/js/intlTelInput.js',
    'node_modules/apexcharts/dist/apexcharts.js',
    'node_modules/quill/dist/quill.js',
], 'public/js/front-third-party.js')

mix.scripts(' resources/assets/js/auto_fill/auto_fill.js', 'public/assets/js/auto_fill/auto_fill.js').version()


//front page js
mix.js([
    'resources/assets/js/turbo.js',
    'resources/assets/js/custom/helper.js',
    'resources/assets/js/custom/input_price_format.js',
    'resources/assets/js/fronts/sliders/slider.js',
    'resources/assets/front/js/front-custom.js',
    'resources/assets/js/fronts/sliders/create-edit-slider.js',
    'resources/assets/js/custom/phone-number-country-code.js',
    'resources/assets/js/fronts/medical-contact/enquiry.js',
    'resources/assets/js/fronts/subscribers/create.js',
    'resources/assets/js/fronts/faqs/faqs.js',
    'resources/assets/js/fronts/front_patient_testimonials/front_patient_testimonials.js',
    'resources/assets/js/fronts/front_patient_testimonials/create-edit.js',
    'resources/assets/js/fronts/enquiries/enquiry.js',
    'resources/assets/js/fronts/subscribers/subscriber.js',
    'resources/assets/js/fronts/cms/create.js',
    'resources/assets/js/fronts/appointments/book_appointment.js',
    'resources/assets/js/fronts/front_home/front-home.js',
    'resources/assets/front/js/front-language.js',
], 'public/js/front-pages.js');

// mix.js('resources/assets/js/livewire-turbolinks.js', 'public/assets/js/livewire-turbolinks.js');
mix.js('resources/assets/js/livewire-turbolinks.js',
    'public/assets/js/livewire-turbolinks.js')
// front css

mix.sass('resources/assets/front/scss/front-custom.scss',
    'assets/front/css/front-custom.css')
    .sass('resources/assets/front/scss/about.scss',
        'assets/front/css/about.css')
    .version();

mix.sass('resources/assets/front/scss/main.scss',
    'public/css/front-pages.css'
).version()


// front third party CSS
mix.styles([
    'public/assets/front/vendor/bootstrap.min.css',
    'public/assets/front/vendor/slick.css',
    'public/assets/front/vendor/slick-theme.css',
], 'public/css/front-third-party.css')

//smart card pdf
mix.sass(
    'resources/assets/scss/smart-card-pdf.scss',
    'public/assets/css/smart-card-pdf.css'
).version();


mix.js('resources/assets/js/custom/custom-auth.js', 'public/js/custom-auth.js');
