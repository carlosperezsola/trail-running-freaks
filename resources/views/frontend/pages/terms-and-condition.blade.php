@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || Terms & conditions
@endsection

@section('container')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Terms & conditions</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">terms & conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="card">
                        <div class="cart-body p-5">
                            {!! @$terms->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
