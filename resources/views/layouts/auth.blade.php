<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset(getAppFavicon()) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <!-- General CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/third-party.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/pages.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

    <!-- CSS Libraries -->
    @stack('css')
</head>

<body
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed">
<div class="d-flex flex-column flex-root">
    <div
        class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed authImage">
        @yield('content')
    </div>
</div>

<footer>
    <div class="container-fluid padding-0">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-6">
                <div class="copyright text-center text-muted">
                    {{ __('messages.all_rights_reserved') }} &copy; {{ date('Y') }} <a href="/"
                                                                  class="font-weight-bold ml-1"
                                                                      target="_blank">{{ getAppName() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="{{ asset('backend/js/vendor.js') }}"></script>
    <script src="{{ mix('assets/js/auto_fill/auto_fill.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/3rd-party-custom.js') }}"></script> --}}
    <script src="{{ mix('js/custom-auth.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @stack('scripts')
    <script>
    $(document).ready(function () {
        $('.alert').delay(5000).slideUp(300);
    });
</script>
</body>
</html>

