@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Reset Password')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('Reset Password')</h4>
                        <ul>
                            <li><a href="{{ route('login') }}">login</a></li>
                            <li><a href="javascript:;">@lang('Reset Password')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <div class="trf__change_password">
                            <h4>@lang('Reset Password')</h4>
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="trf__single_pass">
                                <label>Email</label>
                                <input id="email" type="email" name="email"
                                    value="{{ old('email', $request->email) }}" placeholder="Email">
                            </div>
                            <div class="trf__single_pass">
                                <label>@lang('New password')</label>
                                <input id="password" type="password" name="password" placeholder="New Password">
                            </div>
                            <div class="trf__single_pass">
                                <label>@lang('Confirm password')</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Confirm Password">
                            </div>
                            <button class="common_btn" type="submit">@lang('submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
