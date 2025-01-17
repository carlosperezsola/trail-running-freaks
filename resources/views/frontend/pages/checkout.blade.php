@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('checkout')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('checkout')</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">@lang('checkout')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="trf__check_form">
                        <div class="d-flex">
                            <h5>@lang('Shipping Details')</h5>
                            <a href="javascript:;" class="common_btn ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">@lang('add new address')</a>
                        </div>
                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="trf__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                @lang('Select Address')
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>@lang('Name'):</span> {{ $address->name }}</li>
                                            <li><span>@lang('Phone'):</span> {{ $address->phone }}</li>
                                            <li><span>Email :</span> {{ $address->email }}</li>
                                            <li><span>@lang('Country'):</span> {{ $address->country }}</li>
                                            <li><span>@lang('City'):</span> {{ $address->city }}</li>
                                            <li><span>@lang('Zip Code'):</span> {{ $address->zip }}</li>
                                            <li><span>@lang('Address'):</span> {{ $address->address }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="trf__order_details" id="sticky_sidebar">
                        <p class="trf__product">@lang('shipping Methods')</p>
                        @foreach ($shippingMethods as $method)
                            @if ($method->type === 'min_cost' && getCartTotal() >= $method->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $method->id }}" data-id="{{ number_format($method->cost, 2) }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>@lang('cost'): ({{ $settings->currency_icon }}{{ number_format($method->cost, 2) }})</span>
                                    </label>
                                </div>
                            @elseif ($method->type === 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $method->id }}" data-id="{{ number_format($method->cost, 2) }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>@lang('cost'): ({{ $settings->currency_icon }}{{ number_format($method->cost, 2) }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                        <div class="trf__order_details_summery">
                            <p>@lang('subtotal'): <span>{{ $settings->currency_icon }}{{ number_format(getCartTotal(), 2) }}</span></p>
                            <p>@lang('shipping fee')(+): <span id="shipping_fee">{{ $settings->currency_icon }}0.00</span></p>
                            <p><b>@lang('Total'):</b> <span><b id="total_amount"
                                        data-id="{{ number_format(getCartTotal(), 2) }}">{{ $settings->currency_icon }}{{ number_format(getCartTotal(), 2) }}</b></span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree_term" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    @lang('I have read and agree to the website ') 
                                    <a href="{{ url('/terms-and-conditions') }}">@lang('terms and conditions')</a>.
                                </label>                                    
                            </div>
                        </div>
                        <form action="" id="checkOutForm">
                            <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                            <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                        </form>
                        <a href="" id="submitCheckoutForm" class="common_btn">@lang('Place Purchase')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="trf__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('add new address')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="trf__check_form p-3">
                            <form action="{{ route('user.checkout.address.create') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="Name *" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="Phone *" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <input type="email" placeholder="Email *" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="">@lang('Country/Region')*</option>
                                                @foreach (config('settings.country_list') as $key => $country)
                                                    <option {{ $country === old('country') ? 'selected' : '' }}
                                                        value="{{ $country }}">{{ $country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="State *" name="state"
                                                value="{{ old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="Town / City *" name="city"
                                                value="{{ old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="Zip *" name="zip"
                                                value="{{ old('zip') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="trf__check_single_form">
                                            <input type="text" placeholder="Address *" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="trf__check_single_form">
                                            <button type="submit" class="btn btn-primary">@lang('Save changes')</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[type="radio"]').prop('checked', false);
            $('#shipping_method_id').val("");
            $('#shipping_address_id').val("");

            $('.shipping_method').on('click', function() {
                let shippingFee = parseFloat($(this).data('id')).toFixed(2);
                let currentTotalAmount = parseFloat($('#total_amount').data('id')).toFixed(2);
                let totalAmount = (parseFloat(currentTotalAmount) + parseFloat(shippingFee)).toFixed(2);

                $('#shipping_method_id').val($(this).val());
                $('#shipping_fee').text("{{ $settings->currency_icon }}" + shippingFee);

                $('#total_amount').text("{{ $settings->currency_icon }}" + totalAmount);
            });

            $('.shipping_address').on('click', function() {
                $('#shipping_address_id').val($(this).data('id'));
            });

            $('#submitCheckoutForm').on('click', function(e) {
                e.preventDefault();
                if ($('#shipping_method_id').val() == "") {
                    toastr.error('Shipping method is required');
                } else if ($('#shipping_address_id').val() == "") {
                    toastr.error('Shipping address is required');
                } else if (!$('.agree_term').prop('checked')) {
                    toastr.error('You have to agree to the terms and conditions');
                } else {
                    $.ajax({
                        url: "{{ route('user.checkout.form-submit') }}",
                        method: 'POST',
                        data: $('#checkOutForm').serialize(),
                        beforeSend: function() {
                            $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                        },
                        success: function(data) {
                            if (data.status === 'success') {
                                $('#submitCheckoutForm').text('Place Purchase');
                                window.location.href = data.redirect_url;
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        });
    </script>
@endpush