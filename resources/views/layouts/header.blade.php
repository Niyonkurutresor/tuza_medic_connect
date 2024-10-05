<header class='d-flex align-items-center justify-content-between flex-grow-1 header px-3 px-xl-0'>
    <button type="button" class="btn px-0 aside-menu-container__aside-menubar d-block d-xl-none sidebar-btn">
        <i class="fa-solid fa-bars fs-1"></i>
    </button>
    <nav class="navbar navbar-expand-xl navbar-light {{(Auth()->user()->dark_mode) ? 'bg-light' : 'bg-white' }} top-navbar d-xl-flex d-block px-3 px-xl-0 py-4 py-xl-0 "
         id="nav-header">
        <div class="container-fluid">
            <div class="navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @include('layouts.sub_menu')
                </ul>
            </div>
        </div>
    </nav>
    <ul class="nav align-items-center">
        @impersonating
        <li class="px-xxl-3 px-2">
            <span class="text-primary">
                <a data-turbo="false" data-turbo-eval="false" href="{{ route('impersonate.leave') }}">
                    <i class="fas fa-user-check fs-2"></i>
                </a>
            </span>
        </li>
        @endImpersonating
        @if (isRole('patient'))
        @php
        $isholdcard = App\Models\Patient::where('user_id', Auth::user()->id)->whereNotNull('template_id')->exists();
        @endphp
            @if ($isholdcard)
                <a href="javascript:void(0)" class="btn px-5 text-primary fs-3 show_patient_card" data-id="{{getLogInUser()->patient->id}}" data-toggle="modal" data-target="#show_card_modal" data-bs-toggle="tooltip"
                    data-bs-original-title="{{ __('messages.smart_patient_card.smart_card') }}"> <i class="fa-solid fa-id-card fs-1"></i></a>
            @endif
        @endif
        {{-- <li class="px-sm-3 px-2">
            @if(Auth::user()->dark_mode)
                <a href="javascript:void(0)" title="Switch to Light mode"><i
                        class="fa-solid fa-moon text-primary fs-2 apply-dark-mode"></i></a>
            @else
                <a href="javascript:void(0)" title="Switch to Dark mode"><i
                        class="fa-solid fa-sun text-primary fs-2 apply-dark-mode"></i></a>
            @endif
        </li> --}}
        <li class="px-sm-3 px-2">
            @if(Auth::user()->dark_mode)
                <a href="javascript:void(0)" title="Switch to Light mode"><i
                    class="fa-solid fa-sun text-primary fs-2 apply-dark-mode"></i></a>
            @else
                <a href="javascript:void(0)" title="Switch to Dark mode"><i
                    class="fa-solid fa-moon text-primary fs-2 apply-dark-mode"></i></a>
            @endif
        </li>
        @php
                $notifications = getNotification();
            @endphp
            @if(getLogInUser()->hasRole('doctor') || getLogInUser()->hasRole('patient'))
            <li class="px-sm-3 px-2">
                <div class="dropdown custom-dropdown d-flex align-items-center py-4">
                    <button class="btn dropdown-toggle hide-arrow ps-2 pe-0" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell text-primary fs-2"></i>
                        @if(count($notifications) != 0)
                            <span class="badge bg-primary rounded-circle position-absolute d-flex mt-2 notification-counter" id="header-notification-counter">{{ count($notifications) }}</span>
                        @endif
                    </button>
                    <div class="dropdown-menu py-0 my-2" aria-labelledby="dropdownMenuButton1">
                        <div class="text-start border-bottom py-4 px-7">
                            <h3 class="text-gray-900 mb-0">{{ __('messages.notification.notification') }}</h3>
                        </div>
                        <div class="px-7 mt-5 inner-scroll height-270">
                            @if(count($notifications) > 0)
                                @foreach($notifications as $notification)
                                    <a href="javascript:void(0)" data-id="{{ $notification->id }}"
                                       class="readNotification text-decoration-none"
                                       id="readNotification">
                                        <div class="d-flex position-relative mb-5">
                                            <span class="me-5 text-primary fs-2 icon-label"><i class="{{ getNotificationIcon($notification->type) }}"></i></span>
                                            <div>
                                                <h5 class="text-gray-900 fs-6 mb-2">{{ $notification->title }}</h5>
                                                <h6 class="text-gray-600 fs-small fw-light mb-0">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans(null, true)}}</h6>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <div class="empty-state fs-6 text-gray-800 fw-bold text-center mt-5 d-none"
                                     data-height="400">
                                    <h5 class="text-gray-900 fs-6 mb-2">{{ __('messages.notification.you_don`t_have_any_new_notification') }}</h5>
                                </div>
                            @else
                                <div class="empty-state fs-6 text-gray-800 fw-bold text-center mt-5"
                                     data-height="400">
                                    <h5 class="text-gray-900 fs-6 mb-2">{{ __('messages.notification.you_don`t_have_any_new_notification') }}</h5>
                                </div>
                            @endif
                        </div>
                        <div class="text-center border-top p-4 {{ count($notifications) > 0 ? '' : 'd-none' }}" id="readAllNotification">
                            <a href="javascript:void(0)" class="text-decoration-none">
                                <h5 class="text-primary mb-0 fs-5">{{ __('messages.notification.mark_all_as_read') }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @endif

        <li class="px-sm-3 px-2">
            <div class="dropdown d-flex align-items-center py-4">
                <div class="image image-circle image-mini">
                    @if(getLogInUser()->hasRole('patient'))
                        <img class="img-fluid" alt="img-fluid"
                             src="{{ getLogInUser()->patient->profile }}"/>
                    @elseif(getLogInUser()->hasRole('doctor'))
                        <img class="img-fluid" alt="img-fluid"
                             src="{{ getLogInUser()->profile_image }}"/>
                    @else
                        <img class="img-fluid" alt="img-fluid"
                             src="{{ getLogInUser()->profile_image }}"/>
                    @endif
                </div>
                <button class="btn dropdown-toggle ps-2 pe-0" type="button" id="menuDropDown"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                    {{ getLogInUser()->full_name }}
                </button>
                <div class="dropdown-menu py-7 pb-4 my-2" aria-labelledby="menuDropDown">
                    <div class="text-center border-bottom pb-5">
                        <div class="image image-circle image-tiny mb-5">
                            @if(getLogInUser()->hasRole('patient'))
                                <img class="img-fluid" alt="img-fluid"
                                     src="{{ getLogInUser()->patient->profile }}"/>
                            @elseif(getLogInUser()->hasRole('doctor'))
                                <img class="img-fluid" alt="img-fluid"
                                     src="{{ getLogInUser()->profile_image }}"/>
                            @else
                                <img class="img-fluid" alt="img-fluid"
                                     src="{{ getLogInUser()->profile_image }}"/>
                            @endif
                        </div>
                        <h3 class="text-gray-900">{{ getLogInUser()->full_name }}</h3>
                        <h4 class="mb-0 fw-400 fs-6">{{ getLogInUser()->email }}</h4>
                    </div>
                    <ul class="pt-4">
                        <li>
                            <a class="dropdown-item text-gray-900" href="{{ route('profile.setting') }}">
                            <span class="dropdown-icon me-4 text-gray-600">
                                <i class="fa-solid fa-user"></i>
                            </span>
                                {{ __('messages.user.account_setting') }}
                            </a>
                        </li>
                        @if((is_impersonating() === false))
                            <li>
                                <a class="dropdown-item text-gray-900" id="changePassword" href="javascript:void(0)">
                                    <span class="dropdown-icon me-4 text-gray-600">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    {{ __('messages.user.change_password') }}
                                </a>
                            </li>
                        @endif
                        @if(getLogInUser()->hasRole('doctor') || getLogInUser()->hasRole('patient'))
                        <li>
                            <a class="dropdown-item text-gray-900" id="emailNotification" href="javascript:void(0)">
                                    <span class="dropdown-icon me-4 text-gray-600">
                                        <i class="fa-solid fa-bell"></i>
                                    </span>
                                {{ __('messages.user.email_notification') }}
                            </a>
                        </li>
                        @endif
                        @if(session('impersonated_by'))
                        <li>
                            <a class="dropdown-item text-gray-900" href="{{ route('impersonate.leave') }}"
                               data-turbo="false">
                                    <span class="dropdown-icon me-4 text-gray-600">
                                        <i class="fa-solid fa-user-check"></i>
                                    </span>
                                {{ __('messages.user.return_to_admin') }}
                            </a>
                        </li>
                        @endif
                        <li>
                            <a class="dropdown-item text-gray-900" id="changeLanguage" href="javascript:void(0)">
                               <span class="dropdown-icon me-4 text-gray-600">
                                   <i class="fa-solid fa-globe"></i>
                               </span>
                                {{ __('messages.user.change_language') }}
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-gray-900 d-flex" href="javascript:void(0)">
                                <span class="dropdown-icon me-4 text-gray-600">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                <form id="logout-form" action="{{ route('logout')}}" method="post">
                                    @csrf
                                </form>
                                <span onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                    {{ __('messages.user.sign_out') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li>
            <button type="button" class="btn px-0 d-block d-xl-none header-btn pb-2">
                <i class="fa-solid fa-bars fs-1"></i>
            </button>
        </li>
    </ul>
</header>
<div class="bg-overlay" id="nav-overly"></div>
