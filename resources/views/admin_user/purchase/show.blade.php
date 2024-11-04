@php
    $address = json_decode($purchase->purchase_address);
    $shipping = json_decode($purchase->shipping_method);
@endphp

@extends('admin_user.layouts.main')

@section('container')
    <section class="section">
        <div class="section-header">
            <h1>@lang('Purchases')</h1>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2></h2>
                                <div class="invoice-number">@lang('Purchase') #{{ $purchase->invoice_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>@lang('Billed To'):</strong><br>
                                        <b>@lang('Name'):</b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>@lang('Phone'):</b> {{ $address->phone }}<br>
                                        <b>@lang('Address'):</b> {{ $address->address }},<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}<br>
                                        {{ $address->country }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-start">
                                    <address>
                                        <strong>@lang('Billed To'):</strong><br>
                                        <b>@lang('Name'):</b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>@lang('Phone'):</b> {{ $address->phone }}<br>
                                        <b>@lang('Address'):</b> {{ $address->address }},<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}<br>
                                        {{ $address->country }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 ">
                                    <address>
                                        <strong>@lang('Payment Information'):</strong><br>
                                        <b>@lang('Method'):</b> {{ $purchase->payment_method }}<br>
                                        <b>@lang('Transaction') Id: </b>{{ @$purchase->transaction->transaction_id }} <br>
                                        <b>@lang('Status'): </b> {{ $purchase->payment_status === 1 ? 'Complete' : 'Pending' }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-start">
                                    <address>
                                        <strong>@lang('Purchase Date'):</strong><br>
                                        {{ date('d F, Y', strtotime($purchase->created_at)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">@lang('Purchase Summary')</div>
                            <p class="section-lead">@lang('All items here cannot be deleted').</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>@lang('Item')</th>
                                        <th>@lang('Option')</th>
                                        <th>@lang('Third Party Name')</th>
                                        <th class="text-center">@lang('Price')</th>
                                        <th class="text-center">@lang('Quantity')</th>
                                        <th class="text-right">@lang('Totals')</th>
                                    </tr>
                                    @foreach ($purchase->purchaseProducts as $product)
                                        @php
                                            $options = json_decode($product->options);
                                        @endphp
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            @if (isset($product->product->slug))
                                                <td>
                                                    <a target="_blank"
                                                        href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                </td>
                                            @else
                                                <td>{{ $product->product_name }}</td>
                                            @endif
                                            <td>
                                                @foreach ($options as $key => $option)
                                                    <b>{{ $key }}:</b> {{ $option->name }}
                                                    ({{ $settings->currency_icon }}{{ $option->price }})
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($product->thirdParty)
                                                    {{ $product->thirdParty->shop_name }}
                                                @else
                                                    <em>@lang('Shop not available')</em>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                {{ $settings->currency_icon }}{{ $product->unit_price }} </td>
                                            <td class="text-center">{{ $product->qty }}</td>
                                            <td class="text-right">
                                                {{ $settings->currency_icon }}{{ $product->unit_price * $product->qty + $product->option_total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">@lang('Payment status')</label>
                                            <select name="" id="payment_status" class="form-control"
                                                data-id="{{ $purchase->id }}">
                                                <option {{ $purchase->payment_status === 0 ? 'selected' : '' }} value="0">@lang('Pending')</option>
                                                <option {{ $purchase->payment_status === 1 ? 'selected' : '' }} value="1">@lang('Completed')</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">@lang('Purchase Status')</label>
                                            <select name="purchase_status" id="purchase_status" data-id="{{ $purchase->id }}"
                                                class="form-control">
                                                @foreach (config('purchase_status.purchase_status_admin_user') as $key => $purchaseStatus)
                                                    <option {{ $purchase->purchase_status === $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $purchaseStatus['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ $purchase->sub_total }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">@lang('Shipping') (+)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ @$shipping->cost }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">@lang('Total')</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }} {{ $purchase->amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i>@lang('Print')</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#purchase_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin_user.purchase.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        toastr.error('An error occurred while updating the purchase status.');
                    }
                });
            });


            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin_user.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();
                $('body').html(printBody.html());
                window.print();
                $('body').html(originalContents);
            })
        })
    </script>
@endpush
