<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="{{ getAppName() }}" />
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- META ============== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- OG -->
    <meta name="robots" content="index, follow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link
        href="//fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="{{ mix('css/front-third-party.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/front-pages.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/css/bootstrap-datepicker/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/intlTelInput.css') }}">

    <!-- Document Title ===================== -->
    <title>@yield('front-title') | {{ getAppName() }}</title>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ asset('assets/front/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ mix('js/front-third-party.js') }}"></script>
    <script src="{{ mix('js/front-pages.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script data-turbo-eval="false">
        let currencyIcon = '{{ getCurrencyIcon() }}'
        let isSetFirstFocus = false
        let csrfToken = "{{ csrf_token() }}"
        let defaultCountryCodeValue = "{{ getSettingValue('default_country_code') }}"
    </script>
    <script src="//js.stripe.com/v3/"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @routes

    <script data-turbo-eval="false">
        let appointmentStripePaymentUrl = '{{ url('appointment-stripe-charge') }}';
        let stripe = '';
        @if (config('services.stripe.key'))
            stripe = Stripe('{{ config('services.stripe.key') }}');
        @endif
        let manually = "{{ \App\Models\Appointment::MANUALLY }}";
        let paystack = "{{ \App\Models\Appointment::PAYSTACK }}";
        let paypal = "{{ \App\Models\Appointment::PAYPAL }}";
        let stripeMethod = "{{ \App\Models\Appointment::STRIPE }}";
        let razorpayMethod = "{{ \App\Models\Appointment::RAZORPAY }}";
        let authorizeMethod = "{{ \App\Models\Appointment::AUTHORIZE }}";
        let paytmMethod = "{{ \App\Models\Appointment::PAYTM }}";
        let checkLanguageSession = '{{ checkLanguageSession() }}'
            Lang.setLocale(checkLanguageSession);
        let options = {
            'key': "{{ config('payments.razorpay.key') }}",
            'amount': 0, //  100 refers to 1
            'currency': 'INR',
            'name': "{{ getAppName() }}",
            'order_id': '',
            'description': '',
            'image': '{{ asset(getAppLogo()) }}', // logo here
            'callback_url': "{{ route('razorpay.success') }}",
            'prefill': {
                'email': '', // recipient email here
                'name': '', // recipient name here
                'contact': '', // recipient phone here
                'appointmentID': '', // appointmentID here
            },
            'readonly': {
                'name': 'true',
                'email': 'true',
                'contact': 'true',
            },
            'theme': {
                'color': '#4FB281',
            },
            'modal': {
                'ondismiss': function() {
                    $('.book-appointment-message').css('display', 'block');
                    let response =
                        '<div class="gen alert alert-danger">Appointment created successfully and payment not completed.</div>';
                    $('.book-appointment-message').html(response).delay(5000).hide('slow');
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
            },
        }
    </script>
</head>

<body>
    @include('fronts.layouts.header')
    @yield('front-content')
    @include('fronts.layouts.footer')
</body>

</html>
