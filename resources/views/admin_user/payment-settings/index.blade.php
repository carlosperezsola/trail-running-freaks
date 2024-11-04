@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Settings')</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                            data-toggle="list" href="#list-home" role="tab">@lang('Paypal')</a>
                                        <a class="list-group-item list-group-item-action" id="list-stripe-list"
                                            data-toggle="list" href="#list-stripe" role="tab">@lang('Stripe')</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        @include('admin_user.payment-settings.sections.paypal-setting')
                                        @include('admin_user.payment-settings.sections.stripe-setting')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
