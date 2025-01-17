@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Login')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('login/register')</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">@lang('login/register')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="trf__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">@lang('login')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">@lang('signup')</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="trf__login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="trf__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="email" type="email" value="{{ old('email') }}" name="email"
                                                placeholder="Email">
                                        </div>
                                        <div class="trf__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="trf__login_save">
                                            <div class="form-check form-switch">
                                                <input id="remember_me" name="remember" class="form-check-input"
                                                    type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">@lang('Remember me')</label>
                                            </div>
                                            <a class="forget_p" href="{{ route('password.request') }}">@lang('forgot password ?')</a>
                                        </div>
                                        <button class="common_btn" type="submit">@lang('login')</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="trf__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="trf__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="name" name="name" value="{{ old('name') }}" type="text"
                                                placeholder="Name">
                                        </div>
                                        <div class="trf__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                                placeholder="Email">
                                        </div>
                                        <div class="trf__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" name="password" type="password" placeholder="Password">
                                        </div>
                                        <div class="trf__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password_confirmation" type="password" name="password_confirmation"
                                                placeholder="Confirm Password">
                                        </div>
                                        <button class="common_btn mt-4" type="submit">@lang('signup')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
