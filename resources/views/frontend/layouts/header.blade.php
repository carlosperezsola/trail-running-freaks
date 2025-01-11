<header>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-4 col-sm-1 -md-lg-2 d-lg-none">
                <div class="trf__mobile_menu_area">
                    <span class="trf__mobile_menu_icon mt-0 bg-transparent"><i
                            class="fal fa-bars text-white fa-2x"></i></span>
                </div>
            </div>
            <div class="col-4 col-sm-3 col-lg-2 col-xl-2 d-flex align-items-center p-2 p-md-0">
                <div class="trf_logo_area">
                    <a class="trf__header_logo img-fluid" href="{{ url('/') }}">
                        <img src="{{ asset($logoSetting->logo) }}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-4 col-lg-4 col-xl-5 d-none d-sm-block">
                <div class="trf__search">
                    <form action="{{ route('products.index') }}">
                        <input type="text" placeholder="Search..." name="search" value="{{ request()->search }}">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-4 col-sm-2 col-lg-6 col-xl-5">
                <div class="trf__call_icon_area ps-0 ps-lg-5 d-block d-md-flex">
                    <div class="trf__call_area d-none d-lg-flex">
                        <div class="trf__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="trf__call_text">
                            <a href="mailto:{{ $settings->contact_email }}">
                                <p class="text-lowercase pb-0">{{ $settings->contact_email }}</p>
                            </a><br />
                            <a href="tel:{{ $settings->contact_phone }}">
                                <p>{{ $settings->contact_phone }}</p>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center">
                        <ul class="trf__icon_area d-block d-lg-none col-6">
                            @if (auth()->check())
                                @if (auth()->user()->type_user === 'regular')
                                    <li class="mx-0 mx-lg-3"><a href="{{ route('user.profile') }}"><i
                                                class="fal fa-user"></i></a></li>
                                @elseif (auth()->user()->type_user === 'third-party')
                                    <li class="mx-0 mx-lg-3"><a href="{{ route('third_party_user.dashboard') }}"><i
                                                class="fal fa-user"></i></a></li>
                                @elseif (auth()->user()->type_user === 'admin')
                                    <li class="mx-0 mx-lg-3"><a href="{{ route('admin_user.dashboard') }}"><i
                                                class="fal fa-user"></i></a>
                                    </li>
                                @endif
                            @else
                                <li class="mx-0 mx-lg-3"><a href="{{ route('login') }}"><i class="fal fa-user"></i></a>
                                </li>
                            @endif
                        </ul>
                        <ul class="trf__icon_area col-6">
                            <li class="mx-0 mx-lg-3">
                                <a class="trf__cart_icon" href="#">
                                    <i class="fal fa-shopping-bag"></i><span
                                        id="cart-count">{{ Cart::content()->count() }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul>
                            @if (Route::isLocalized() || Route::isFallback())
                                <div class="dropdown menu-translation"> 
                                    <a class="btn btn-light menu-translation dropdown-toggle ms-1 ms-md-0 p-0 rounded-circle" type="button" id="languageDropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . (app()->getLocale() === 'en' ? 'gb' : app()->getLocale()) . '.svg') }}" alt="{{ strtoupper(app()->getLocale()) }}" />
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="languageDropdownAdmin">
                                        @foreach (LocaleConfig::getLocales() as $locale)
                                            @if (!App::isLocale($locale))
                                                <li>
                                                    <a class="dropdown-item  mx-2" href="{{ Route::localizedUrl($locale) }}">
                                                        <img class="mx-auto d-block border rounded-circle border border-1 border-white flag" src="{{ asset('vendor/blade-country-flags/1x1-' . ($locale === 'en' ? 'gb' : $locale) . '.svg') }}" alt="{{ strtoupper($locale) }}"/>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="trf__mini_cart">
        <h4>@lang('shopping cart') <span class="trf_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini_cart_wrapper">
            @foreach (Cart::content() as $sidebarProduct)
                <li id="mini_cart_{{ $sidebarProduct->rowId }}">
                    <div class="trf__cart_img">
                        <a href="#"><img src="{{ asset($sidebarProduct->options->image) }}" alt="product"
                                class="img-fluid w-100"></a>
                        <a class="wsis__del_icon remove_sidebar_product" data-id="{{ $sidebarProduct->rowId }}"
                            href="#"><i class="fas fa-minus-circle"></i></a>
                    </div>
                    <div class="trf__cart_text">
                        <a class="trf__cart_title"
                            href="{{ route('product-detail', $sidebarProduct->options->slug) }}">{{ $sidebarProduct->name }}</a>
                        <p>
                            {{ $settings->currency_icon }}{{ $sidebarProduct->price }}
                        </p>
                        <small>@lang('Options total'):
                            {{ $settings->currency_icon }}{{ $sidebarProduct->options->options_total }}</small>
                        <br>
                        <small>@lang('Qty'): {{ $sidebarProduct->qty }}</small>
                    </div>
                </li>
            @endforeach
            @if (Cart::content()->count() === 0)
                <li class="text-center">@lang('Cart Is Empty!'):</li>
            @endif
        </ul>
        <div class="mini_cart_actions {{ Cart::content()->count() === 0 ? 'd-none' : '' }}">
            <h5>sub total <span id="mini_cart_subtotal">{{ $settings->currency_icon }}{{ getCartTotal() }}</span></h5>
            <div class="trf__minicart_btn_area">
                <a class="common_btn" href="{{ route('cart-details') }}">@lang('view cart')</a>
                <a class="common_btn" href="{{ route('user.checkout') }}">@lang('checkout')</a>
            </div>
        </div>
    </div>
</header>
