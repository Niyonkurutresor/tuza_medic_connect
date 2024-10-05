@include('flash::message')
@if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif
    <div class="pb-0">
        <div class="d-flex">
            <ul class="nav nav-tabs mb-sm-7 mb-5 pb-1 overflow-auto flex-nowrap text-nowrap" id="myTab" role="tablist">
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName == 'general') ? 'active' : ''}}"
                       href="{{ route('setting.index',['section' => 'general']) }}">{{ __('messages.setting.general') }}</a>
                </li>
                <li class="nav-item position-relative me-7 mb-3" role="presentation">
                    <a class="nav-link p-0 {{ (isset($sectionName) && $sectionName == 'contact-information') ? 'active' : ''}}"
                       href="{{ route('setting.index',['section' => 'contact-information']) }}">{{ __('messages.setting.contact_information') }}</a>
                </li>
            </ul>
        </div>
    </div>
