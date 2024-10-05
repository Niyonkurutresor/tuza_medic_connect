<header class="position-relative header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-1 col-4">
                <a href="#!" class="header-logo">
                    <img src="{{ asset(getAppLogo()) }}" alt="Infy Care" class="object-cover front-app-logo" loading="lazy" />
                </a>
            </div>
            <div class="col-lg-11 col-8">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-end py-0">
                    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav align-items-center py-2 py-lg-0">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('/*') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">{{ __('messages.web.home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('medical-doctors*') ? 'active' : '' }}"
                                   href="{{ route('medicalDoctors') }}">{{ __('messages.web.our_team') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('medical-services*') ? 'active' : '' }}"
                                   href="{{ route('medicalServices') }}">{{ __('messages.web.services') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('medical-about-us*') ? 'active' : '' }}"
                                   href="{{ route('medicalAboutUs') }}">{{ __('messages.web.about_us') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('medical-contact*') ? 'active' : '' }}"
                                   href="{{ route('medicalContact') }}"
                                   data-turbo="false">{{ __('messages.web.contact_us') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link" id="dropdownMenuLink"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-language me-1"></i>{{getCurrentLanguageName()}}</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li class="add-menu-left">
                                        <ul>
                                            @foreach(getUserLanguages() as $key => $value)
                                                @foreach(\App\Models\User::LANGUAGES_IMAGE as $imageKey=> $imageValue)
                                                    @if($imageKey == $key)
                                                        <li class="d-flex languageSelection language-padding {{ (getCurrentLanguageName() == $value) ? 'active' : '' }}" data-prefix-value="{{ $key }}">
                                                            <a href="javascript:void(0)" class="text-decoration-none">
                                                                <img class="rounded-1 ms-2 me-2 w-20px"
                                                                     src="{{asset($imageValue)}}" loading="lazy"/>
                                                                <span class="language-color">{{ $value }}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="text-lg-end header-btn-grp ms-xxl-5 ms-lg-3">
                                @if(getLogInUser())
                                    @if(getLogInUser()->hasRole('doctor'))
                                        <a href="{{ route('doctors.dashboard') }}"
                                           class="btn btn-outline-primary me-xxl-3 me-2 mb-3 mb-lg-0" data-turbo="false">{{ __('messages.dashboard') }}</a>
                                    @elseif(getLogInUser()->hasRole('patient'))
                                        <a href="{{ route('patients.dashboard') }}"
                                           class="btn btn-outline-primary me-xxl-3 me-2 mb-3 mb-lg-0" data-turbo="false">{{ __('messages.dashboard') }}</a>
                                    @else
                                        <a href="{{ route('admin.dashboard') }}"
                                           class="btn btn-outline-primary me-xxl-3 me-2 mb-3 mb-lg-0" data-turbo="false">{{ __('messages.dashboard') }}</a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                       class="btn btn-outline-primary me-xxl-3 me-2 mb-3 mb-lg-0" data-turbo="false">{{ __('messages.login') }}</a>
                                @endif

                                    <!-- <a href="{{ route('medicalAppointment') }}" class="btn btn-primary mb-3 mb-lg-0">{{ __('messages.web.book_an_appointment') }}</a> -->
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
