@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Cart Details')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('Cart Details')</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="#">@lang('product')</a></li>
                            <li><a href="#">@lang('cart view')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="trf__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="trf__pro_img">
                                            @lang('product item')
                                        </th>

                                        <th class="trf__pro_name">
                                            @lang('product details')
                                        </th>

                                        <th class="trf__pro_tk">
                                            @lang('unit price')
                                        </th>

                                        <th class="trf__pro_tk">
                                            @lang('total')
                                        </th>

                                        <th class="trf__pro_select">
                                            @lang('quantity')
                                        </th>
                                        <th class="trf__pro_icon">
                                            <a href="#" class="common_btn clear_cart">@lang('clear cart')</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="trf__pro_img"><img src="{{ asset($item->options->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>
                                            <td class="trf__pro_name">
                                                <p>{!! $item->name !!}</p>
                                                @foreach ($item->options->options as $key => $option)
                                                    <span>{{ $key }}: {{ $option['name'] }}
                                                        ({{ $settings->currency_icon . $option['price'] }})
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td class="trf__pro_tk">
                                                <h6>{{ $settings->currency_icon . $item->price }}</h6>
                                            </td>
                                            <td class="trf__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    {{ $settings->currency_icon . ($item->price + $item->options->options_total) * $item->qty }}
                                                </h6>
                                            </td>
                                            <td class="trf__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement">-</button>
                                                    <input class="product-qty text-center pe-1" data-rowid="{{ $item->rowId }}"
                                                        type="text" min="1" max="100"
                                                        value="{{ $item->qty }}" readonly />
                                                    <button class="btn btn-success product-increment">+</button>
                                                </div>
                                            </td>
                                            <td class="trf__pro_icon">
                                                <a href="{{ route('cart.remove-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex">
                                            <td class="trf__pro_icon" rowspan="2" style="width:100%">
                                                @lang('Cart is empty!')
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="trf__cart_list_footer_button" id="sticky_sidebar">
                        <h6>@lang('total cart')</h6>
                        <p>@lang('subtotal'): <span id="sub_total">{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                        </p>
                        <p class="total">
                            <span>@lang('total'):</span> 
                            <span id="cart_total"></span>
                        </p>
                        <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">@lang('checkout')</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{route('home')}}"><i
                                class="fab fa-shopify"></i> @lang('Keep Shopping')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.product-increment').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total
                            $(productId).text(totalAmount)
                            renderCartSubTotal();
                            toastr.success(data.message)

                        } else if (data.status === 'error') {

                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })
            $('.product-decrement').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                if (quantity < 1) {
                    quantity = 1;
                }

                input.val(quantity);

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount = "{{ $settings->currency_icon }}" + data
                                .product_total
                            $(productId).text(totalAmount)
                            renderCartSubTotal()
                            toastr.success(data.message)

                        } else if (data.status === 'error') {

                            toastr.error(data.message)
                        }
                    },
                    error: function(data) {

                    }
                })
            })
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear.cart') }}",
                            success: function(data) {
                                if (data.status === 'success') {
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })
            
            function renderCartSubTotal(){
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(data) {
                        $('#sub_total').text("{{$settings->currency_icon}}"+data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            }
        })
    </script>
@endpush
