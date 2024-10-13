@extends('frontend.layouts.main')

@section('title')
    {{ $settings->site_name }} || Product Details Section
@endsection

@section('container')
    <section id="trf__breadcrumb">
        <div class="trf_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>products details</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">product</a></li>
                            <li><a href="#">product details</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="trf__product_details">
        <div class="container">
            <div class="trf__details_bg">
                <div class="row">
                    <div class="col-xl-4 col-md-5 col-lg-5" style="z-index:999">
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box">
                                    {{-- @php
                                        dd($product); // Esto mostrará el contenido de $product y detendrá la ejecución.
                                    @endphp --}}
                                    @if ($product->video_link)
                                        <a class="venobox trf__pro_det_video" data-autoplay="true" data-vbtype="video"
                                            href="{{ $product->video_link }}">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    @endif
                                    <ul class='exzoom_img_ul'>
                                        <li>
                                            <img class="zoom ing-fluid w-100" src="{{ asset($product->thumb_image) }}"
                                                alt="product">
                                        </li>
                                        @foreach ($product->productImageGalleries as $productImage)
                                            <li>
                                                <img class="zoom ing-fluid w-100" src="{{ asset($productImage->image) }}"
                                                    alt="product">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i
                                            class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i
                                            class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7 col-lg-7">
                        <div class="trf__pro_details_text">
                            <a class="title" href="javascript:;">{{ $product->name }}</a>
                            @if ($product->qty > 0)
                                <p class="trf__stock_area"><span class="in_stock">in stock</span> ({{ $product->qty }}
                                    item)</p>
                            @elseif ($product->qty === 0)
                                <p class="trf__stock_area"><span class="in_stock">stock out</span> ({{ $product->qty }}
                                    item)</p>
                            @endif
                            @if (checkDiscount($product))
                                <h4>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->offer_price }}
                                    <del>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}</del>
                                </h4>
                            @else
                                <h4>{{ $settings->currency_icon }}{{ $product->currency_icon }}{{ $product->price }}</h4>
                            @endif
                            <p class="description">{!! $product->short_description !!}</p>
                            <form class="shopping-cart-form">
                                <div class="trf__selectbox">
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->options as $option)
                                            @if ($option->status != 0)
                                                <div class="col-xl-6 col-sm-6">
                                                    <h5 class="mb-2">{{ $option->name }}: </h5>
                                                    <select class="select_2" name="options_items[]">
                                                        @foreach ($option->productOptionItems as $optionItem)
                                                            @if ($optionItem->status != 0)
                                                                <option value="{{ $optionItem->id }}"
                                                                    {{ $optionItem->is_default == 1 ? 'selected' : '' }}>
                                                                    {{ $optionItem->name }} (${{ $optionItem->price }})
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="trf__quantity">
                                    <h5>Quantity:</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="qty" type="text" min="1"
                                            max="100" value="1" />
                                    </div>
                                </div>
                                <ul class="trf__button_area">
                                    <li>
                                        <button type="submit" class="add_cart" href="#">add to cart</button>
                                    </li>
                                </ul>
                            </form>
                            <p class="brand_model"><span>trademark :</span> {{ $product->trademark->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="trf__pro_det_description">
                        <div class="trf__details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Third Party Info</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="trf__description_area">
                                                {!! $product->long_description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="trf__pro_det_third_party">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="trf__third_party_img">
                                                    <img src="{{ asset($product->thirdParty->banner) }}" alt="Third Party"
                                                        class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="trf__pro_det_third_party_text">
                                                    <h4>{{ $product->thirdParty->user->name }}</h4>
                                                    <p><span>Store Name:</span> {{ $product->thirdParty->shop_name }}</p>
                                                    <p><span>Address:</span> {{ $product->thirdParty->address }}</p>
                                                    <p><span>Phone:</span> {{ $product->thirdParty->phone }}</p>
                                                    <p><span>E-mail:</span> {{ $product->thirdParty->email }}</p>
                                                    <a href="{{ route('thirdParty.products', $product->thirdParty->id) }}" class="common_btn">Visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="trf__third_party_details">
                                                    {!! $product->thirdParty->description !!}
                                                </div>
                                            </div>
                                        </div>
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
