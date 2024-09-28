@extends('frontend.dashboard.layouts.main')

@section('title')
    {{$settings->site_name}} || Dashboard
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <h3>User Dashboard</h3>
                    <br>
                    <div class="dashboard_content">
                        <div class="trf__dashboard">
                            <div class="row">
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item red" href="{{ route('user.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">Total Order</p>
                                        <h4 style="color:#ffff">{{ $totalOrder }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item green" href="dsahboard_download.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">Pending Orders</p>
                                        <h4 style="color:#ffff">{{ $pendingOrder }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item sky" href="dsahboard_review.html">
                                        <i class="fas fa-cart-plus"></i>
                                        <p class="lh-1">Complete Orders</p>
                                        <h4 style="color:#ffff">{{ $completeOrder }}</h4>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4">
                                    <a class="trf__dashboard_item orange" href="{{ route('user.profile') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p class="lh-1">profile</p>
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
