@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Payment')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('Payment')</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">@lang('Payment')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__cart_view">
        <div class="container">
            <div class="trf__pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="trf__payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-paypal" type="button" role="tab"
                                    aria-controls="v-pills-paypal" aria-selected="true">Paypal</button>
                                <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-stripe" type="button" role="tab"
                                    aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                            <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="trf__payment_area">
                                            <a class="nav-link common_btn text-center"
                                                href="{{ route('user.paypal.payment') }}">@lang('Pay with Paypal')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('frontend.pages.payment-gateway.stripe')
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="trf__pay_booking_summary" id="sticky_sidebar2">
                            <h5>@lang('Purchase Summary')</h5>
                            <p>@lang('subtotal'): <span>{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                            <p>@lang('shipping fee')(+): <span>{{ $settings->currency_icon }}{{ getShippingFee() }}</span></p>
                            <h6>@lang('total'): <span>{{ $settings->currency_icon }}{{ getFinalPayableAmount() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
