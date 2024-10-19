<header>
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-4 col-sm-1 -md-lg-2 d-lg-none">
                <div class="trf__mobile_menu_area">
                    <span class="trf__mobile_menu_icon mt-0"><i class="fal fa-bars"></i></span>
                </div>
            </div>
            <div class="col-4 col-sm-3 col-lg-2 col-xl-2 d-flex align-items-center p-2 p-md-0">
                <div class="trf_logo_area">
                    <a class="trf__header_logo img-fluid" href="{{ url('/') }}">
                        <img src="{{ asset($logoSetting->logo) }}" alt="logo" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="col-6 col-lg-4 col-xl-5 d-none d-sm-block">
                <div class="trf__search">
                    <form>
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-4 col-sm-2 col-lg-6 col-xl-5">
                <div class="trf__call_icon_area ps-0 ps-md-5 d-block d-md-flex">
                    <div class="trf__call_area d-none d-lg-flex">
                        <div class="trf__call">
                            <i class="fas fa-user-headset"></i>
                        </div>
                        <div class="trf__call_text">
                            <p class="text-lowercase">{{ $settings->contact_email }}</p>
                            <p>{{ $settings->contact_phone }}</p>
                        </div>
                    </div>
                    <ul class="trf__icon_area">
                        <li><a class="trf__cart_icon" href="#">
                                <i class="fal fa-shopping-bag"></i><span
                                    id="cart-count">{{ Cart::content()->count() }}</span>
                            </a>
                        </li>
                    </ul>
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
                <a class="common_btn" href="{{route('user.checkout')}}">@lang('checkout')</a>
            </div>
        </div>
    </div>
</header>
