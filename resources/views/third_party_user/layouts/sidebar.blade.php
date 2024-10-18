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
        <li><a class="{{ setActive(['third_party_user.dashboard']) }}" href="{{ route('third_party_user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{setActive(['user.dashboard'])}}" href="{{route('user.dashboard')}}" target="_blank"><i class="fas fa-user"></i>User Dashboard</a></li>
        <li><a class="" href="{{ route('home') }}"><i class="fas fa-home"></i>Go To Home</a></li>
        <li><a class="{{ setActive(['third_party_user.purchases.*']) }}" href="{{ route('third_party_user.purchases.index') }}"><i class="fas fa-box"></i> Purchases</a></li>
        <li><a class="{{ setActive(['third_party_user.products.*']) }}" href="{{ route('third_party_user.products.index') }}"><i class="fas fa-cart-plus"></i> My Products</a></li>
        <li><a class="{{ setActive(['third_party_user.shop-profile.index']) }}" href="{{ route('third_party_user.shop-profile.index') }}"><i class="far fa-user"></i> Shop Profile</a></li>
        <li><a class="{{ setActive(['third_party_user.profile']) }}" href="{{ route('third_party_user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a>
            </form>
        </li>
    </ul>
</div>
