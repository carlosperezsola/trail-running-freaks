<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{ $settings->site_name }}</a>
        </div>
        <ul class="sidebar-menu">
            <div class="dropdown menu-translation ml-4"> 
                <a class="btn btn-dark shadow-none menu-translation dropdown-toggle ms-1 ms-md-0 p-0 rounded-circle" type="button" id="languageDropdownAdmin" data-toggle="dropdown" aria-expanded="false">
                    <img class="border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . (app()->getLocale() === 'en' ? 'gb' : app()->getLocale()) . '.svg') }}" alt="{{ strtoupper(app()->getLocale()) }}" />
                </a>
                <ul class="dropdown-menu dropdown-menu-end w-auto" aria-labelledby="languageDropdownAdmin">
                    @foreach (LocaleConfig::getLocales() as $locale)
                        @if (!App::isLocale($locale))
                            <li>
                                <a class="dropdown-item m-0 px-2" href="{{ Route::localizedUrl($locale) }}">
                                    <img class="mx-auto d-block border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . ($locale === 'en' ? 'gb' : $locale) . '.svg') }}" alt="{{ strtoupper($locale) }}" />
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>            
            <li class="menu-header">@lang('Dashboard')</li>
            <li class="dropdown {{ setActive([
                    '*.admin_user.*',
                    '*.user.dashboard.*',
                ]) }}">
                <a href="{{ route('admin_user.dashboard') }}" class="nav-link line-height-menu"><i
                        class="fas fa-fire line-height-menu"></i><span>@lang('Dashboard')</span></a>
            </li>
            <li class="dropdown">
                <a href="{{ route('user.dashboard') }}" class="nav-link line-height-menu" target="_blank"><i
                        class="fas fa-user line-height-menu"></i><span>@lang('User Dashboard')</span></a>
            </li>
            <li class="menu-header">Ecommerce</li>
            <li
                class="dropdown {{ setActive(['*.admin_user.category.*', '*.admin_user.sub-category.*', '*.admin_user.child-category.*']) }}">
                <a href="#" class="nav-link line-height-menu has-dropdown line-height-menu" data-toggle="dropdown"><i class="fas fa-list"></i>
                    <span>@lang('Manage Categories')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['*.admin_user.category.*']) }}"><a class="nav-link line-height-menu my-2 line-height-menu"
                            href="{{ route('admin_user.category.index') }}">@lang('Category')</a></li>
                    <li class="{{ setActive(['*.admin_user.sub-category.*']) }}"><a class="nav-link line-height-menu my-2 line-height-menu"
                            href="{{ route('admin_user.sub-category.index') }}">Sub @lang('Category')</a></li>
                    <li class="{{ setActive(['*.admin_user.child-category.*']) }}"> <a class="nav-link line-height-menu my-2 line-height-menu"
                            href="{{ route('admin_user.child-category.index') }}">@lang('Child Category')</a></li>
                </ul>
            </li>
            <li
                class="dropdown {{ setActive([
                    '*.admin_user.trademark.*',
                    '*.admin_user.products.*',
                    '*.admin_user.products-image-gallery.*',
                    '*.admin_user.products-option.*',
                    '*.admin_user.products-option-item.*',
                    '*.admin_user.seller-products.*',
                    '*.admin_user.seller-pending-products.*',
                ]) }}">
                <a href="#" class="nav-link line-height-menu has-dropdown line-height-menu" data-toggle="dropdown"><i class="fas fa-box"></i>
                    <span>@lang('Manage Products')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['*.admin_user.trademark.*']) }}"><a class="nav-link line-height-menu my-2 line-height-menu"
                            href="{{ route('admin_user.trademark.index') }}">Trademarks</a></li>
                    <li
                        class="{{ setActive([
                            '*.admin_user.products.*',
                            '*.admin_user.products-image-gallery.*',
                            '*.admin_user.products-option.*',
                            '*.admin_user.products-option-item.*',
                            '*.admin_user.payment-settings.*',
                        ]) }}">
                        <a class="nav-link line-height-menu my-2 line-height-menu" href="{{ route('admin_user.products.index') }}">@lang('My Products')</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.seller-products.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.seller-products.index') }}">@lang('Seller Products')</a></li>
                    <li class="{{ setActive(['*.admin_user.seller-pending-products.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.seller-pending-products.index') }}">@lang('Seller Pending Products')</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ setActive(['*.admin_user.count-down.*', '*.admin_user.shipping-rule.*', '*.admin_user.third-party-profile.*', '*.admin_user.payment-settings.*']) }}">
                <a href="#" class="nav-link line-height-menu has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i><span>Ecommerce</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['*.admin_user.count-down.*']) }}"><a class="nav-link line-height-menu my-2" href="{{ route('admin_user.count-down.index') }}">@lang('Count Down')</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.shipping-rule.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.shipping-rule.index') }}">@lang('Shipping Rule')</a></li>
                    <li class="{{ setActive(['*.admin_user.third-party-profile.*']) }}">
                        <a class="nav-link line-height-menu my-2" href="{{ route('admin_user.third-party-profile.index') }}">@lang('Third Party Profile')</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.payment-settings.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.payment-settings.index') }}">@lang('Payment Settings')</a>
                    </li>
                </ul>
            </li>
            <li class="{{ setActive(['*.admin_user.purchase.*']) }}">
                <a class="nav-link line-height-menu" href="{{ route('admin_user.purchase.index') }}">
                    <i class="fas fa-cart-plus"></i><span>@lang('Purchases')</span>
                </a>
            </li>
            <li
                class="dropdown {{ setActive(['*.admin_user.slider.*', '*.admin_user.home-page-setting.*', '*.admin_user.who-we-are.*', '*.admin_user.terms-and-conditions.*']) }}">
                <a href="#" class="nav-link line-height-menu has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i>
                    <span>@lang('Manage Website')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['*.admin_user.slider.*']) }}">
                        <a class="nav-link line-height-menu my-2" href="{{ route('admin_user.slider.index') }}">Slider</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.home-page-setting.*']) }}">
                        <a class="nav-link line-height-menu my-2" href="{{ route('admin_user.home-page-setting.index') }}">@lang('Popular Categories')</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.who-we-are.index']) }}">
                        <a class="nav-link line-height-menu my-2" href="{{ route('admin_user.who-we-are.index') }}">@lang('Who We Are Page')</a>
                    </li>
                    <li class="{{ setActive(['*.admin_user.terms-and-conditions.index']) }}">
                        <a class="nav-link line-height-menu my-2" href="{{ route('admin_user.terms-and-conditions.index') }}">@lang('Terms & Conditions Page')</a>
                    </li>
                </ul>
            </li>
            <li class="{{ setActive(['*.admin_user.promo.*']) }}">
                <a class="nav-link line-height-menu"
                    href="{{ route('admin_user.promo.index') }}">
                    <i class="fas fa-ad"></i> <span>@lang('Promos')</span>
                </a>
            </li>
            <li class="menu-header">@lang('More features')</li>
            <li
                class="dropdown {{ setActive(['*.admin_user.footer-info.index', '*.admin_user.footer-socials.*', '*.admin_user.footer-grid.*']) }}">
                <a href="#" class="nav-link line-height-menu has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-th-large"></i><span>@lang('Footer')</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['*.admin_user.footer-info.index']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.footer-info.index') }}">@lang('Footer Info')</a></li>
                    <li class="{{ setActive(['*.admin_user.footer-socials.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.footer-socials.index') }}">@lang('Footer Socials')</a></li>
                    <li class="{{ setActive(['*.admin_user.footer-grid.*']) }}"><a class="nav-link line-height-menu my-2"
                            href="{{ route('admin_user.footer-grid.index') }}">@lang('Footer General Info')</a></li>
                </ul>
            </li>
            <li class="{{ setActive(['*.admin_user.subscribers.*']) }}">
                <a class="nav-link line-height-menu" href="{{ route('admin_user.subscribers.index') }}">
                    <i class="fas fa-envelope-open-text"></i><span>@lang('Subscribers')</span>
                </a>
            </li>
            @if (app()->getLocale() == config('app.fallback_locale'))
                <li class="{{ setActive(['*.admin_user.manage-translations.*']) }}">
                    <a class="nav-link line-height-menu {{ setActive(['*.admin_user/manage-translations*']) }}"
                    href="{{ route('admin_user.manage-translations.index') }}"
                    data-remote="false" target="_blank">
                        <i class="fas fa-language"></i><span>@lang('Translations')</span>
                    </a>
                </li>
            @endif        
            <li class="{{ setActive(['*.admin_user.settings.*']) }} pb-5">
                <a class="nav-link line-height-menu" href="{{ route('admin_user.settings.index') }}">
                    <i class="fas fa-wrench"></i><span>@lang('Settings')</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
