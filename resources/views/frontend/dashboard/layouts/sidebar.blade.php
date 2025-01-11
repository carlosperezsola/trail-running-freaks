@php
    $user = Auth::user();
@endphp

<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="javascript:;" class="dash_logo"><img src="{{ asset($logoSetting->logo) }}" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{setActive(['*.user.dashboard'])}}" href="{{route('user.dashboard')}}"><i class="fas fa-tachometer"></i>@lang('Dashboard')</a></li>
        @if($user->type_user == 'admin')
            <li><a class="" href="{{ url('/admin_user/dashboard') }}" target="_blank"><i class="fas fa-user-shield"></i>@lang('Admin Dashboard')</a></li>
        @elseif ($user->type_user == 'third-party')
            <li><a class="" href="{{ url('/third_party_user/dashboard') }}" target="_blank"><i class="fas fa-user-shield"></i>@lang('Third Party Dashboard')</a></li>
        @endif
        <li><a class="" href="{{ url('/') }}"><i class="fas fa-home"></i> @lang('Go To Home')</a></li>
        <li><a class="{{setActive(['*.user.purchases.*'])}}" href="{{route('user.purchases.index')}}"><i class="fas fa-list-ul"></i> @lang('Purchases')</a></li>
        <li><a class="{{setActive(['*.user.profile'])}}" href="{{route('user.profile')}}"><i class="far fa-user"></i> @lang('My Profile')</a></li>
        <li><a class="{{setActive(['*.user.address.*']) }}" href="{{ route('user.address.index') }}"><i class="fal fa-gift-card"></i> @lang('Addresses')</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="far fa-sign-out-alt"></i> @lang('Log out')</a>
            </form>
        </li>
        <div class="dropdown menu-translation ms-4 mt-4"> 
            <a class="btn btn-dark shadow-none menu-translation dropdown-toggle ms-1 ms-md-0 p-0 rounded-circle" type="button" id="languageDropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . (app()->getLocale() === 'en' ? 'gb' : app()->getLocale()) . '.svg') }}" alt="{{ strtoupper(app()->getLocale()) }}" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end w-auto" aria-labelledby="languageDropdownAdmin">
                @foreach (LocaleConfig::getLocales() as $locale)
                    @if (!App::isLocale($locale))
                        <li>
                            <a class="dropdown-item m-0 px-2" href="{{ Route::localizedUrl($locale) }}">
                                <img class="border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . ($locale === 'en' ? 'gb' : $locale) . '.svg') }}" alt="{{ strtoupper($locale) }}" />
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </ul>
</div>
