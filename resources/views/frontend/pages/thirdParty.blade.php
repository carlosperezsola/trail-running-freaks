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
                        <h4>Third Parties</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="javascript:;">Third Parties</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__product_page" class="trf__vendors">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="row">
                        @foreach ($thirdParties as $thirdParty)
                            <div class="col-xl-6 col-md-6">
                                <div class="trf__vendor_single">
                                    <img src="{{ asset($thirdParty->banner) }}" alt="third party" class="img-fluid w-100">
                                    <div class="trf__vendor_text">
                                        <div class="trf__vendor_text_center">
                                            <h4>{{ $thirdParty->shop_name }}</h4>
                                            <a href="javascript:;"><i class="far fa-phone-alt"></i>
                                                {{ $thirdParty->phone }}</a>
                                            <a href="javascript:;"><i class="fal fa-envelope"></i>
                                                {{ $thirdParty->email }}</a>
                                            <a href="{{ route('thirdParty.products', $thirdParty->id) }}" class="common_btn">Visit store</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-12">
                    <section id="pagination">
                        <div class="mt-5">
                            @if ($thirdParties->hasPages())
                                {{ $thidParties->links() }}
                            @endif
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
