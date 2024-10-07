@php
    $address = json_decode($purchase->purchase_address);
@endphp

@extends('third_party_user.layouts.main')

@section('title')
    {{ $settings->site_name }} || Product
@endsection

@section('container')
    <section id="trf__dashboard">
        <div class="container-fluid">
            @include('third_party_user.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Purchase Details</h3>
                        <div class="trf__dashboard_profile">
                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="trf__invoice_area">
                                        <div class="trf__invoice_header">
                                            <div class="trf__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="trf__invoice_single">
                                                            <h5>Billing Information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="trf__invoice_single text-md-start">
                                                            <h5>shipping information</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="trf__invoice_single text-md-start">
                                                            <h5>Purchase id: #{{ $purchase->invoice_id }}</h5>
                                                            <h6>Purchase status: {{ config('purchase_status.purchase_status_admin_user')[$purchase->purchase_status]['status'] }}
                                                            </h6>
                                                            <p>Payment Method: {{ $purchase->payment_method }}</p>
                                                            <p>Payment Status: {{ $purchase->payment_status }}</p>
                                                            <p>Transaction id: {{ $purchase->transaction->transaction_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="trf__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                product
                                                            </th>
                                                            <th class="amount">
                                                                Third Party
                                                            </th>
                                                            <th class="amount">
                                                                amount
                                                            </th>
                                                            <th class="quantity">
                                                                quantity
                                                            </th>
                                                            <th class="total">
                                                                total
                                                            </th>
                                                        </tr>
                                                        @foreach ($purchase->purchaseProducts as $product)
                                                            @if ($product->thirdParty_id === Auth::user()->thirdParty->id)
                                                                @php
                                                                    $options = json_decode($product->options);
                                                                    $total = 0;
                                                                    $total += $product->unit_price * $product->qty;
                                                                @endphp
                                                                <tr>
                                                                    <td class="name">
                                                                        <p>{{ $product->product_name }}</p>
                                                                        @foreach ($options as $key => $item)
                                                                            <span>{{ $key }} :
                                                                                {{ $item->name }}(
                                                                                {{ $settings->currency_icon }}{{ $item->price }}
                                                                                )</span>
                                                                        @endforeach
                                                                    </td>
                                                                    <td class="amount">
                                                                        {{ $product->thirdParty->shop_name }}
                                                                    </td>
                                                                    <td class="amount">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->unit_price }}
                                                                    </td>

                                                                    <td class="quantity">
                                                                        {{ $product->qty }}
                                                                    </td>
                                                                    <td class="total">
                                                                        {{ $settings->currency_icon }}
                                                                        {{ $product->unit_price * $product->qty }}
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="trf__invoice_footer">
                                            <p><span>Total Amount:</span> {{ $settings->currency_icon }}
                                                {{ $total }} </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="row">
                                <div class="col-md-4">
                                    <form action="{{ route('third_party_user.purchases.status', $purchase->id) }}">
                                        <div class="form-group mt-5">
                                            <label for="" class="mb-2">Purchase Status</label>
                                            <select name="status" id="" class="form-control">
                                                @foreach (config('purchase_status.purchase_status_thirdParty') as $key => $status)
                                                    <option {{ $key === $purchase->purchase_status ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $status['status'] }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-primary mt-3" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="mt-5 float-end">
                                        <button class="btn btn-warning print_invoice">Print</button>
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

@push('scripts')
    <script>
        $('.print_invoice').on('click', function() {
            let printBody = $('.invoice-print');
            let originalContents = $('body').html();

            $('body').html(printBody.html());

            window.print();

            $('body').html(originalContents);

        })
    </script>
@endpush
