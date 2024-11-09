    @extends('frontend.layouts.main')

    @section('title')
        {{ $settings->site_name }} || @lang('Password Forgotten')
    @endsection

    @section('container')
        <section id="trf__breadcrumb">
            <div class="trf_breadcrumb_overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4>@lang('forgot password')</h4>
                            <ul>
                                <li><a href="{{ route('login') }}">@lang('login')</a></li>
                                <li><a href="javascript:;">@lang('forgot password')</a></li>
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
                        <div class="trf__forget_area">
                            <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                            <h4>@lang('forgot password?')</h4>
                            <p>@lang('enter the email address to register with <span>Trail Running Freaks</span>')</p>
                            <div class="trf__login">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="trf__login_input">
                                        <i class="fal fa-envelope"></i>
                                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Your Email">
                                    </div>
                                    <button class="common_btn" type="submit">@lang('send')</button>
                                </form>
                            </div>
                            <a class="see_btn mt-4" href="{{ route('login') }}">@lang('go to login')</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
