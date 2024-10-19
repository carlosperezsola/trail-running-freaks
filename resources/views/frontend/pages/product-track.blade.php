@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Track my purchases')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('purchase tracking')purchase tracking</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">@lang('purchase tracking')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__login_register">
        <div class="container">
            <div class="trf__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form class="tack_form" action="{{ route('product-tracking.index') }}" method="GET">
                            <h4 class="text-center">@lang('purchase tracking')</h4>
                            <p class="text-center">@lang('tracking your purchase status')</p>
                            <div class="trf__track_input">
                                <label class="d-block mb-2">@lang('invoice id')*</label>
                                <input type="text" placeholder="H25-21578455" name="tracker"
                                    value="{{ @$purchase->invoice_id }}">
                            </div>
                            <button type="submit" class="common_btn">@lang('track')</button>
                        </form>
                    </div>
                </div>
                @if (isset($purchase))
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="trf__track_header">
                                <div class="trf__track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="trf__track_header_single">
                                                <h5>@lang('purchase date')</h5>
                                                <p>{{ date('d M Y', strtotime(@$purchase->created_at)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="trf__track_header_single">
                                                <h5>@lang('shopping by'):</h5>
                                                <p>{{ @$purchase->user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="trf__track_header_single">
                                                <h5>@lang('status'):</h5>
                                                <p>{{ @$purchase->purchase_status }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="trf__track_header_single border_none">
                                                <h5>@lang('tracking'):</h5>
                                                <p>{{ @$purchase->invoice_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <ul class="progtrckr d-flex justify-content-center" data-progtrckr-steps="4">
                                <li class="progtrckr_done icon_one check_mark">@lang('Pending')</li>
                                @if (@$purchase->purchase_status == 'canceled')
                                    <li class="icon_four red_mark">@lang('Purchase Canceled')</li>
                                @else
                                    <li class="progtrckr_done icon_two
                                    @if (@$purchase->purchase_status == 'processed_and_ready_to_ship' ||
                                        @$purchase->purchase_status == 'dropped_off' ||
                                        @$purchase->purchase_status == 'shipped' ||
                                        @$purchase->purchase_status == 'out_for_delivery' ||
                                        @$purchase->purchase_status == 'delivered') 
                                    check_mark
                                    @endif">@lang('purchase Processing')</li>
                                    <li class="icon_three
                                    @if (
                                        @$purchase->purchase_status == 'out_for_delivery' ||
                                        @$purchase->purchase_status == 'delivered')
                                    check_mark
                                    @endif
                                    ">@lang('on the way')</li>
                                    <li class="icon_four
                                    @if (@$purchase->purchase_status == 'delivered')
                                    check_mark
                                    @endif
                                    ">@lang('delivered')</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-xl-12">
                            <a href="{{ url('/') }}" class="common_btn"><i class="fas fa-chevron-left"></i> @lang('back to home')</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
