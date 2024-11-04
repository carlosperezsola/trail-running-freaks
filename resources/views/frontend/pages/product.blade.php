@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || @lang('Product Details')
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>@lang('products')</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li><a href="javascript:;">@lang('product')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__product_page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="trf__sidebar_filter ">
                        <p>@lang('filter')</p>
                        <span class="trf__filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <button class="accordion-button d-block d-lg-none btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
                        @lang('Ver filtros')
                    </button>
                    <div id="collapseZero" class="trf__product_sidebar accordion-collapse collapse d-lg-block">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        @lang('All Categories')
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li><a
                                                        href="{{ route('products.index', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        @lang('Price')
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <form action="{{ url()->current() }}">
                                                @foreach (request()->query() as $key => $value)
                                                    @if ($key != 'range')
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}" />
                                                    @endif
                                                @endforeach
                                                <input type="hidden" id="slider_range" name="range"
                                                    class="flat-slider" />
                                                <button type="submit" class="common_btn">@lang('tracking')filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        @lang('trademark')
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($trademarks as $trademark)
                                                <li><a
                                                        href="{{ route('products.index', ['trademark' => $trademark->slug]) }}">{{ $trademark->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="trf__product_topbar">
                                <div class="trf__product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button
                                            class="nav-link {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'active' : '' }} {{ !session()->has('product_list_style') ? 'active' : '' }} list-view"
                                            data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'active' : '' }}"
                                            data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'show active' : '' }} {{ !session()->has('product_list_style') ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-sm-6 col-md-4">
                                            <div class="trf__product_item">
                                                <span class="trf__new">{{ productType($product->product_type) }}</span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="trf__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                                                @endif
                                                <a class="trf__pro_link"
                                                    href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    <img src="@if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}@else {{ asset($product->thumb_image) }} @endif"
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>
                                                <ul class="trf__single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#product-{{ $product->id }}"><i
                                                            class="far fa-eye"></i></a></li>
                                                </ul>
                                                <div class="trf__product_details">
                                                    <!-- Null check for product category -->
                                                    @if ($product->category)
                                                        <a class="trf__category"
                                                            href="#">{{ $product->category->name }}</a>
                                                    @else
                                                        <a class="trf__category" href="#">@lang('Uncategorized')</a>
                                                    @endif
                                                    <a class="trf__pro_name"
                                                        href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 53) }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="trf__price">
                                                            {{ $settings->currency_icon }}{{ $product->offer_price }}
                                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="trf__price">
                                                            {{ $settings->currency_icon }}{{ $product->price }}</p>
                                                    @endif
                                                    <form class="shopping-cart-form">
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        @foreach ($product->options as $option)
                                                            @if ($option->status != 0)
                                                                <select class="d-none" name="options_items[]">
                                                                    @foreach ($option->productOptionItems as $optionItem)
                                                                        @if ($optionItem->status != 0)
                                                                            <option value="{{ $optionItem->id }}"
                                                                                {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $optionItem->name }}
                                                                                (${{ $optionItem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                        <input class="" name="qty" type="hidden"
                                                            min="1" max="100" value="1" />
                                                        <button class="add_cart" type="submit">@lang('add to cart')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'show active' : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-xl-12">
                                            <div class="trf__product_item trf__list_view">
                                                <span class="trf__new">{{ productType($product->product_type) }}</span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="trf__minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                                                @endif
                                                <a class="trf__pro_link"
                                                    href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    <img src="
                                                @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                                @else
                                                    {{ asset($product->thumb_image) }} @endif
                                                "
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>
                                                <div class="trf__product_details">
                                                    <a class="trf__category"
                                                        href="#">{{ @$product->category->name }} </a>
                                                    <a class="trf__pro_name"
                                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                                    @if (checkDiscount($product))
                                                        <p class="trf__price">
                                                            {{ $settings->currency_icon }}{{ $product->offer_price }}
                                                            <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="trf__price">
                                                            {{ $settings->currency_icon }}{{ $product->price }}</p>
                                                    @endif
                                                    <p class="list_description">{{ $product->{'short_description_' . app()->getLocale()} }}</p>
                                                    <ul class="trf__single_pro_icon">
                                                        <form class="shopping-cart-form">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            @foreach ($product->options as $option)
                                                                @if ($option->status != 0)
                                                                    <select class="d-none" name="options_items[]">
                                                                        @foreach ($option->productOptionItems as $optionItem)
                                                                            @if ($optionItem->status != 0)
                                                                                <option value="{{ $optionItem->id }}"
                                                                                    {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                                                                    {{ $optionItem->name }}
                                                                                    (${{ $optionItem->price }})
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                            <input class="" name="qty" type="hidden"
                                                                min="1" max="100" value="1" />
                                                            <button class="add_cart_two mr-2" type="submit">@lang('add to
                                                                cart')</button>
                                                        </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($products) === 0)
                        <div class="text-center mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2>@lang('Product not found!')</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xl-12 text-center">
                    <div class="mt-5" style="display:flex; justify-content:center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @foreach ($products as $product)
        <section class="product_popup_modal"data-bs-toggle="modal" data-bs-target="product_popup_modal">
            <div class="modal fade" id="product-{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl modal-fullscreen-lg-down">
                    <div class="modal-content">
                        <div class="modal-body @if (count($product->productImageGalleries) === 0)d-flex justify-content-center align-items-center @endif">
                            <button type="button" class="btn-close position-absolute top-0 end-0 mt-2 me-3" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
                            <div class="row justify-content-center align-items-center">
                                @if (count($product->productImageGalleries) === 0)
                                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-6 w-50 d-flex justify-content-center align-items-center mb-3 mb-lg-0">
                                        <div class="trf__quick_view_img">
                                            @if ($product->video_link)
                                                <a class="venobox trf__pro_det_video" data-autoplay="true" data-vbtype="video" href="{{ $product->video_link }}">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            @endif
                                            <div class="modal_slider_img">
                                                <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 display mb-3 mb-lg-0">
                                        <div class="trf__quick_view_img">
                                            @if ($product->video_link)
                                                <a class="venobox trf__pro_det_video" data-autoplay="true" data-vbtype="video" href="{{ $product->video_link }}">
                                                    <i class="fas fa-play"></i>
                                                </a>
                                            @endif                                            
                                            <div class="row modal_slider">
                                                <div class="col-xl-12">
                                                    <div class="modal_slider_img">
                                                        <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid">
                                                    </div>
                                                </div>                                
                                                @foreach ($product->productImageGalleries as $productImage)
                                                    <div class="col-xl-12">
                                                        <div class="modal_slider_img">
                                                            <img src="{{ asset($productImage->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif                                
                                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="trf__pro_details_text col-md-8 col-lg-12 mx-auto text-center text-lg-start">
                                        <p class="fs-5 fw-bold">{{ limitText($product->name, 150) }}</p>
                                        @if ($product->qty > 0)
                                            <p class="trf__stock_area"><span class="in_stock">@lang('in stock')</span>
                                                ({{ $product->qty }}
                                                item)</p>
                                        @elseif ($product->qty === 0)
                                            <p class="trf__stock_area"><span class="in_stock">@lang('stock out')</span>
                                                ({{ $product->qty }}
                                                item)</p>
                                        @endif
                                        @if (checkDiscount($product))
                                            <h4 class="text-center text-lg-start mx-auto d-block">{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->offer_price }}
                                                <del>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}</del>
                                            </h4>
                                        @else
                                            <h4 class="text-center text-lg-start mx-auto d-block">{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}
                                            </h4>
                                        @endif
                                        <p class="description">{!! limitText($product->{'short_description_' . app()->getLocale()}, 200) !!}</p>
                                        <form class="shopping-cart-form">
                                            <div class="trf__selectbox">
                                                <div class="row d-flex justify-content-center justify-content-lg-start">
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    @foreach ($product->options as $option)
                                                        @if ($option->status != 0)
                                                            <div class="col-xl-6 col-sm-6">
                                                                <div>
                                                                    <div class="text-center text-lg-start">
                                                                        <h5 class="mb-2 w-100">{{ $option->name }}: </h5>
                                                                    </div>
                                                                    <select class="select_2" name="options_items[]">
                                                                        @foreach ($option->productOptionItems as $optionItem)
                                                                            @if ($optionItem->status != 0)
                                                                                <option value="{{ $optionItem->id }}"
                                                                                    {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                                                                    {{ $optionItem->name }}
                                                                                    ({{ $optionItem->price }}€)
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="trf__quantity d-flex justify-content-center justify-content-lg-start">
                                                <h5>@lang('Quantity'):</h5>
                                                <div class="select_number">
                                                    <input class="number_area" name="qty" type="text"
                                                        min="1" max="100" value="1" />
                                                </div>
                                            </div>
                                            <ul class="trf__button_area d-flex justify-content-center justify-content-lg-start">
                                                <li><button type="submit" class="add_cart" href="#">@lang('add to cart')</button></li>
                                            </ul>
                                        </form>
                                        <p class="brand_model"><span>@lang('trademark'):</span> {{ $product->trademark->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.list-view').on('click', function() {
                let style = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('change-product-list-view') }}",
                    data: {
                        style: style
                    },
                    success: function(data) {}
                })
            })
        })
        @php
            $maxPrice = \App\Models\Product::max('price') ?? 500;
            
            if (request()->has('range') && request()->range != '') {                
                $price = explode(';', request()->range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = $maxPrice;
            }
        @endphp
            jQuery(function() {
                jQuery("#slider_range").flatslider({
                    min: 0,
                    max: {{ $maxPrice }},
                    step: 5,
                    values: [{{ $from }},
                    {{ $to }}],
                    range: true,
                    einheit: '{{ $settings->currency_icon }}'
                });
            });
    </script>
@endpush
