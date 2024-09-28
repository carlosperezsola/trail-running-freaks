@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || Payment
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>payment</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">payment</a></li>
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
                    <h1>Paymet success!</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
