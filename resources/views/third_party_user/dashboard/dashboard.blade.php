@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Dashboard')
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="trf__dashboard">
                            <div class="row">
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('third_party_user.purchases.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Today\'s Purchases')</p>
                                        <h4 style="color:#ffff">{{ $todaysPurchase }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('third_party_user.purchases.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Td\'s Pending Purchases')</p>
                                        <h4 style="color:#ffff">{{ $todaysPendingPurchase }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('third_party_user.purchases.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Total Purchases')</p>
                                        <h4 style="color:#ffff">{{ $totalPurchase }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('third_party_user.purchases.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Total Pending Purchases')</p>
                                        <h4 style="color:#ffff">{{ $totalPendingPurchase }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('third_party_user.purchases.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Completed Purchases')</p>
                                        <h4 style="color:#ffff">{{ $totalCompletePurchase }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red"
                                        href="{{ route('third_party_user.products.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Total Products')</p>
                                        <h4 style="color:#ffff">{{ $totalProducts }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Todays Earnings')</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $todaysEarnings }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('This Months Earnings')</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $monthEarnings }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('This Year Earnings')</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $yearEarnings }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">@lang('Total Earnings')</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $toalEarnings }}</h4>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red"
                                        href="{{ route('third_party_user.shop-profile.index') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p class="lh-1">@lang('shop profile')</p>
                                        <h4 style="color:#ffff">-</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
