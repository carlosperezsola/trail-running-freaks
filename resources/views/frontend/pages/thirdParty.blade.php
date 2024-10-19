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
                        <h4>@lang('Third Parties')</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">home</a></li>
                            <li><a href="javascript:;">@lang('Third Parties')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__product_page" class="trf__third_partys">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="row">
                        @foreach ($thirdParties as $thirdParty)
                            <div class="col-xl-6 col-md-6">
                                <div class="trf__third_party_single position-relative">
                                    <div class="w-100 h-100 position-absolute bg-dark " style="opacity: .60"></div>
                                    <img src="{{ asset($thirdParty->banner) }}" alt="third party" class="img-fluid w-100">
                                    <div class="trf__third_party_text">
                                        <div class="trf__third_party_text_center">
                                            <h4>{{ $thirdParty->shop_name }}</h4>
                                            <a href="javascript:;"><i class="far fa-phone-alt"></i>
                                                {{ $thirdParty->phone }}</a>
                                            <a href="javascript:;"><i class="fal fa-envelope"></i>
                                                {{ $thirdParty->email }}</a>
                                            <a href="{{ route('thirdParty.products', $thirdParty->id) }}" class="common_btn">@lang('Visit store')</a>
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
